<?php

/* CLASS USER - HOW TO USE
 *
 * Write after implement to App! 
 *  1) Import the class using 'require_once'
 *  2) Create an instance of an object (At this point you will connect to DB)
 *  3) Use the method of your choice
 *  4) Use the returned values in your application
 */ 

class User
{
        // The variable used in the constructor. An instance of the PDO object will be assigned to it. 
        private $db;

        /* CONSTRUCTOR
         * In the constructor there is a connection to the BD, which can later be used in methods. */
        public function __construct()
        {
                // Connect to database
                // Assign the returned $db object (PDO instance) to the $this->db variable)
                $this->db = require_once __DIR__ . '/../config/database/db_database.php';;
        }

        /* GET USER FROM DATABASE 
         *
         * It takes the user id as a parameter. 
         * 
         * It connects to the DB, retrieves user information, and 
         * returns an associative array with that information. 
         * 
         * The returned array can then be stored in a session variable and transferred between pages. */
        public function get_user(int $id) : array 
        {
                // Search user in BD
                $user_query = $this->db->prepare("SELECT * FROM users
                WHERE id = :id");
                $user_query->bindValue(':id', $id, PDO::PARAM_INT);
                $user_query->execute();
                $user = $user_query->fetchAll(PDO::FETCH_ASSOC);
                // Return an associative array with user data
                return [
                        // Flag whether user is logged in
                        'is_logged' => true,
                
                        // Basic information about account 
                        'id' => $user[0]['id'],
                        'login'=> $user[0]['login'],
                        'email'=> $user[0]['email'],
                
                        // Information about users's company. Will be insert to new invoice as default.
                        'company'=> $user[0]['company_name'],
                        'address1'=> $user[0]['address1'],
                        'address2'=> $user[0]['address2'],
                        'company_code'=> $user[0]['company_number'],
                        'city'=> $user[0]['default_invoice_city'],
                        'bank'=> $user[0]['default_invoice_bank_name'],
                        'account_no'=> $user[0]['default_invoice_bank_account_no'],
                        'additional_info'=> $user[0]['default_invoice_additional_info'],
                
                        // Information about the file names of a specific user 
                        'avatar' => $user[0]['avatar_file_img'],
                        'logo' => $user[0]['company_logo_file_path'],
                ];
        }

        /* UPDATE INFORMATION ABOUT USER AND ITS COMPANY
         *
         * It takes array with user's information as parameter 
         * (same array that the get_user method returns).
         * 
         * It connects to the DB and updates user information. 
         * 
         * It returns nothing, if you want to download user information back 
         * to the application, you should use the get_user() method. */ 
        public function update_company_info(array $user) : void 
        {
                // sql query changing user data
                $update_query = $this->db->prepare("UPDATE users SET 
                                company_name = :company_name,
                                address1 = :address1,
                                address2 = :address2,
                                company_number = :company_number,
                                default_invoice_city = :city,
                                default_invoice_bank_name = :bank_name,
                                default_invoice_bank_account_no = :account_no,
                                default_invoice_additional_info = :additional_info
                         WHERE 
                                id = :user_id");
                $update_query->bindvalue(':company_name', $user['company'], PDO::PARAM_STR);
                $update_query->bindvalue(':address1', $user['address1'], PDO::PARAM_STR);
                $update_query->bindvalue(':address2', $user['address2'], PDO::PARAM_STR);
                $update_query->bindvalue(':company_number', $user['company_code'], PDO::PARAM_STR);
                $update_query->bindvalue(':city', $user['city'], PDO::PARAM_STR);
                $update_query->bindvalue(':bank_name', $user['bank'], PDO::PARAM_STR);
                $update_query->bindvalue(':account_no', $user['account_no'], PDO::PARAM_STR);
                $update_query->bindvalue(':additional_info', $user['additional_info'], PDO::PARAM_STR);
                $update_query->bindvalue(':user_id', $user['id'], PDO::PARAM_INT);
                $update_query->execute();
        }

        /* LOG USER IN 
         *
         * It takes a login and password as parameters, which will probably 
         * be passed via the POST method from the login form. 
         * 
         * If logging fails - it will return an array with one element - an error message, 
         * depending on the stage of the function break. Possible returns: 
         *      a) [e_login] => 'User not found' ; 
         *      b) [e_pass] => 'Invalid password'
         * 
         * If logging succeed - It will return an array with basic information about the user (use get_user() public method). 
         * The returned array can then be stored in a session variable and transferred between pages.*/ 
        public function login (string $login , string $pass) : array
        {
                // Search BD for users with the specified index
                $user_query = $this->db->prepare("SELECT * FROM users
                WHERE login = :login");
                $user_query->bindValue(':login' , $login , PDO::PARAM_STR);
                $user_query->execute();
                $users = $user_query->fetchAll(PDO::FETCH_ASSOC);

                // If no user with the specified login is found in DB, or more are found (a potential error), return an error message. 
                if (count($users) !== 1)
                {
                        return ['e_login'  => 'User not found'];
                }
                // If the password provided during login does not match the password in DB return an error message. 
                elseif (!password_verify($pass, $users[0]['password']))
                {
                        return ['e_pass' => 'Invalid password'];
                }
                // If everything ok, log the user in and return an associative array with user's information
                else
                {
                        return self::get_user($users[0]['id']);
                }
        }

        /* VALIDATE DATA DURING REGISTRATION 
         * 
         * This method checks that the user has entered the correct data 
         * into the registration form (it does not connect to the DB). 
         * 
         * It takes as parameters the data will probably be forwarded by the POST method from the
         * regisration form. 
         * 
         * Eventually it is used in register_user public method. 
         * 
         * Returns an array with one element - an error message,
         * which is forwarded to the method register_user(); */
        private function validate_before_registration(string $login , string $email , string $pass1 , string $pass2 , bool $regulations) : mixed 
        {
                // Login must consist of 5-15 letters and numbers
                if (strlen($login) < 5 || strlen($login) > 15) 
                {
                        return ['e_login' => "Login must consist of 5-15 letters and numbers" ];
                }
        
                // Login can only contain letters and numbers
                if(ctype_alnum($login) === false) 
                {
                        return ['e_login' => "Login can only contain letters and numbers" ];
                }

                // Check that the email is correct
                $email_sanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
                if(!filter_var($email_sanitized, FILTER_VALIDATE_EMAIL) || $email_sanitized !== $email) 
                {
                        return ['e_email' => "Invalid email" ];
                }
                
                // Password must contain a special character?
                if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/' 
                , $pass1)) 
                {
                        return ['e_pass1' => "The password must consist, of 8-20 characters and at least one letter and onenumber." ];
                }
        
                // Two given password must be idenical
                if ($pass1 !== $pass2) 
                {
                       return ['e_pass2' => "Passwords must be identical" ];
                } 
         
                // The regulations checkbox must be accepted
                if (!$regulations) 
                {
                        return ['e_regulations' => "Accept term of services." ];
                } 

                return true;
        }

        /* REGISTER NEW USER   
         * This method allows registering a new user in the database.   
         *
         * It takes as parameters the data will probably be forwarded by the POST method from the
         * regisration form. 
         * 
         * It uses the method to validate data before entering it into the DB.
         * 
         * If the registration succeed - it will return an array with one element 
         * 'successfull_registration' with the value true (or 1). 
         * As below:
         *       a) [successfull_registration] => 1 .
         * 
         * If the registration fails - it will return an array with one element - an error message, 
         * which the next one can be used in the application script. 
         * Possible messages depending on the stage of function interruption. 
         * Possible returns depending on the stage at which registration failed:
         *    1) All from validate_before_registration():
         *        a) [e_login] => "Login must consist of 5-15 letters and numbers" ; 
         *        b) [e_login] => "Login can only contain letters and numbers" ; 
         *        c) [e_email] => "Invalid email" ; 
         *        d) [e_pass1] => "The password must consist, of 8-20 characters and at least one letter and onenumber." ;
         *        e) [e_pass2] => "Passwords must be identical" ; 
         *        f) [e_regulations] => "Accept term of services."
         *    2) Directly from register_user():
         *        g) [e_login] => "Login already exist" ; 
         *        h) [e_email] => "Email already exist" ; */
        public function register(string $login , string $email , string $pass1 , string $pass2 , bool $regulations) : array
        {
                // If, any of the properties does not pass validation, return an error message (returned from method). 
                if (self::validate_before_registration($login, $email, $pass1, $pass2, $regulations) !== true)
                {
                       return self::validate_before_registration($login, $email, $pass1, $pass2, $regulations);
                }
                // If the entered properties passed validation, enter the new user into DB
                else 
                {
                        // Create password hash
                        $password_hash = password_hash($pass1, PASSWORD_DEFAULT); 

                        /* Check if, a user with the given properties already exists 
                         */ 
                        

                        // LOGIN - login must be unique in database */
                        // Get all given logins from database
                        $logins_query = $this->db->prepare("SELECT * FROM `users` WHERE login = :login");
                        $logins_query->bindvalue(':login', $login, PDO::PARAM_STR);
                        $logins_query->execute();

                        // Check if there is only one given login in BD
                        if ($logins_query->rowCount() !== 0) 
                        {
                                return ['e_login' => "Login already exist" ];
                        } 

                        // EMAIL - email must be unique in database */
                        // Get all given logins from database
                        $emails_query = $this->db->prepare("SELECT * FROM `users` WHERE email = :email");
                        $emails_query->bindvalue(':email', $email, PDO::PARAM_STR);
                        $emails_query->execute();

                        // Check if there is only one given email in BD
                        if ($emails_query->rowCount() !== 0)
                        {
                                return ['e_email' => "Email already exist" ];
                        }

                        // If the user does not exist in the database, we add him to the database
                        $insert_query = $this->db->prepare("INSERT INTO `users`(
                                login,
                                password,
                                email,
                                avatar_file_img,
                                company_logo_file_path )
                            VALUES(
                                :login,
                                :pass,
                                :email,
                                :avatar_img,
                                :company_logo )");
                        $insert_query->bindvalue(':login', $login, PDO::PARAM_STR);
                        $insert_query->bindvalue(':pass', $password_hash, PDO::PARAM_STR);
                        $insert_query->bindvalue(':email', $email, PDO::PARAM_STR);
                        $insert_query->bindvalue(':avatar_img', 'default_avatar.png', PDO::PARAM_STR);
                        $insert_query->bindvalue(':company_logo', 'default_logo.png', PDO::PARAM_STR);
                        $insert_query->execute();

                        return ['successfull_registration' => true];       
                }
        }

        /* GET ALL INVOICES
         * This method returns basic information about all invoices assigned
         * to a user in the form of an associative array. */
        public function get_all_invoices(int $id) : array
        {
                // Get all invoices from DB
                $invoices_query = $this->db->prepare("SELECT * FROM invoices
                        WHERE user_id = :user_id");
                $invoices_query->bindValue(':user_id' , $id , PDO::PARAM_INT);
                $invoices_query->execute();

                // Return invoices as associative array
                return $invoices_query->fetchAll(PDO::FETCH_ASSOC);
        }
}
?>