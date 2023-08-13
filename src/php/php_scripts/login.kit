<?php
session_start();

// data from login form
$login = $_POST['login'];
$password = $_POST['password1'];

// database connection
require_once 'db_database.php';

$user_query = $db->prepare("SELECT * FROM users
        WHERE login = :login");
$user_query->bindValue(':login', $login , PDO::PARAM_STR);
$user_query->execute();
$users = $user_query->fetchAll(PDO::FETCH_ASSOC);

// If on user was found in database, we can proceed to login
if (count($users) === 1) {
        unset($_SESSION['log_error_login']);

        // Index 0 is array with user data
        $user = $users[0];

        // Check that the password entered by the user matches the password in the database 
        if (password_verify($_POST['password1'], $user['password'])) {
                unset($_SESSION['log_error_pass']);

                $_SESSION['is_logged'] = true;
                $_SESSION['login'] = $login;
                $_SESSION['id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['avatar_img'] = $user['avatar_file_img'];
                $_SESSION['logo_img'] = $user['company_logo_file_path'];

                $_SESSION['company_name'] = $user['company_name'];
                $_SESSION['address1'] = $user['address1'];
                $_SESSION['address2'] = $user['address2'];
                $_SESSION['company_number'] = $user['company_number'];
                $_SESSION['default_invoice_city'] = $user['default_invoice_city'];
                $_SESSION['default_invoice_bank_name'] = $user['default_invoice_bank_name'];
                $_SESSION['default_invoice_bank_account_no'] = $user['default_invoice_bank_account_no'];
                $_SESSION['default_invoice_additional_info'] = $user['default_invoice_additional_info'];

                header('Location: ../dashboard.php');
        } else {
                $_SESSION['login'] = $login;
                $_SESSION['log_error_pass'] = 'Invalid password';
                header('Location: ../loginform.php');
        }
} else {
        $_SESSION['log_error_login'] = 'User not found';
        header('Location: ../loginform.php');
}
?>