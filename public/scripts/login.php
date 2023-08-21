<?php
session_start();

// data from login form
$login = $_POST['login'];
$password = $_POST['password1'];

// database connection
require_once '../../config/database/db_database.php';

$user_query = $db->prepare("SELECT * FROM users
        WHERE login = :login");
$user_query->bindValue(':login', $login, PDO::PARAM_STR);
$user_query->execute();
$users = $user_query->fetchAll(PDO::FETCH_ASSOC);

// If on user was found in database, we can proceed to login
if (count($users) === 1) {
        unset($_SESSION['log_error_login']);



        // Check that the password entered by the user matches the password in the database 
        $db_password = $users[0]['password'];
        if (password_verify($_POST['password1'], $db_password)) {
                // Session variables to unset after successful login
                unset($_SESSION['log_error_pass']);
                unset($_SESSION['login']);

                // Create assoc array with all basic information about user 
                $user = [
                        // Flag whether user is logged in
                        'is_logged' => true,
        
                        // Basic information about account 
                        'id' => $users[0]['id'],
                        'login'=> $users[0]['login'],
                        'email'=> $users[0]['email'],
        
                        // Information about users's company. Will be insert to new invoice as default.
                        'company'=> $users[0]['company_name'],
                        'address1'=> $users[0]['address1'],
                        'address2'=> $users[0]['address2'],
                        'company_code'=> $users[0]['company_number'],
                        'city'=> $users[0]['default_invoice_city'],
                        'bank'=> $users[0]['default_invoice_bank_name'],
                        'account_no'=> $users[0]['default_invoice_bank_account_no'],
                        'additional_info'=> $users[0]['default_invoice_additional_info'],
        
                        // Information about the file names of a specific user 
                        'avatar' => $users[0]['avatar_file_img'],
                        'logo' => $users[0]['company_logo_file_path'],
                ];

                // Put the $user assoc array in a session variable 
                $_SESSION['user'] = $user;

                // Redirection to app
                header('Location: ../dashboard.php');
        } else {
                $_SESSION['login'] = $login;
                $_SESSION['log_error_pass'] = 'Invalid password';
                header('Location: ../login_form.php');
        }
} else {
        $_SESSION['log_error_login'] = 'User not found';
        header('Location: ../login_form.php');
}
?>