<?php 
session_start();

$login = $_POST['login'];
$email = $_POST['email'];
$pass1 = $_POST['password1'];
$pass2 = $_POST['password2'];
if (isset($_POST['term-of-services'])) {
        $term_is_accepted =  true;
} else {
        $term_is_accepted =  false;
};

// Sava data as session variables
$_SESSION['login'] = $login;
$_SESSION['email'] = $email;
$_SESSION['pass1'] = $pass1;
$_SESSION['term-of-services'] = $term_is_accepted;

// validation
if (isset($_POST['login'])) {
        $everything_OK = true;

        // LOGIN - login length
        if (strlen($login) >=5 && strlen($login) <= 15) {
                $_SESSION['e_login'] = "";
        } else {
                $everything_OK = false;
                $_SESSION['e_login'] = "Login must consist of 5-15 letters and numbers";
        }

        // LOGIN - are every characters alphanumeric?
        if(ctype_alnum($login) === false) {
                $everything_OK = false;
                $_SESSION['e_login'] = "Login can only contain letters and numbers";
        }

        // EMAIL - is email correct?
        $email_sanitized = filter_var($email, FILTER_SANITIZE_EMAIL);

        if(filter_var($email_sanitized, FILTER_VALIDATE_EMAIL) && $email_sanitized === $email) {
                $_SESSION['e_email'] = "";
        } else {
                $everything_OK = false;
                $_SESSION['e_email'] = "Invalid email";
        }
        
        // PASSWORD - is password contain special character?
        if (preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/' 
        , $pass1)) {
                $_SESSION['e_pass1'] = "";
        } else {
                $_SESSION['e_pass1'] = "The password must consist, of 8-20 characters and at least one letter and one number";
        }

        // PASSWORD - are two passwords the same?
        if ($pass1 !== $pass2) {
                $everything_OK = false;
                $_SESSION['e_pass2'] = "Passwords must be identical";
        } else {
                $_SESSION['e_pass2'] = "";
        }

        $password_hash = password_hash($pass1, PASSWORD_DEFAULT);

        // CHECKBOX - is input "term of services" accepted?
        if (!$term_is_accepted) {
                $everything_OK = false;
                $_SESSION['e_term_of_services'] = "Accept term of services";
        } else {
                $_SESSION['e_term_of_services'] = "";
        }
} 

// After succeded validation
if ($everything_OK) {
        require_once 'db_database.php';

        // A flag that checks whether the user is located, already in the database
        $user_already_exist = false;

        // LOGIN - does the login exist in the database?
        $how_many_logins = $db->prepare("SELECT * FROM `users` WHERE login = :login");
        $how_many_logins->bindvalue(':login', $login, PDO::PARAM_STR);
        $how_many_logins->execute();

        if ($how_many_logins->rowCount() !== 0) {
                $user_already_exist = true;
                $_SESSION['e_login'] = "Login already exist";
                header('Location: ../registration.php');
                exit();
        } 

        // EMAIL - does the email exist in database?
        $how_many_emails = $db->prepare("SELECT * FROM `users` WHERE email = :email");
        $how_many_emails->bindvalue(':email', $email_sanitized, PDO::PARAM_STR);
        $how_many_emails->execute();

        if ($how_many_emails->rowCount() !== 0) {
                $user_already_exist = true;
                $_SESSION['e_email'] = "Email already exist";
                header('Location: ../registration.php');
                exit();
        } 

        // If the user does not exist in the database, we add him to the database
        if (!$user_already_exist) {
        $query = $db->prepare('INSERT INTO users VALUES (NULL, :login, :pass, :email, :avatar_file)');
        $query->bindvalue(':login', $login, PDO::PARAM_STR);
        $query->bindvalue(':pass', $password_hash, PDO::PARAM_STR);
        $query->bindvalue(':email', $email_sanitized, PDO::PARAM_STR);
        $query->bindvalue(':avatar_file', 'default_avatar.png', PDO::PARAM_STR);
        $query->execute();
        
        echo 'Successfull registration';
        } 
} else {
        header('Location: ../registration.php');
        exit();
}

