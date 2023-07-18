<?php
session_start();

// database connection
require_once('db_connect.php');
$db_conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// data from login form
$login = $_POST['login'];
$password = $_POST['password1'];

// prevent sql injection
$login = htmlentities($login, ENT_QUOTES, 'UTF-8');
$sql = sprintf("SELECT * FROM users WHERE login = '%s'", mysqli_real_escape_string($db_conn, $login));

// login
if ($result_query = $db_conn->query($sql)) {
        $returned_users = $result_query->num_rows;

        if ($returned_users === 1) {
                unset($_SESSION['log_error_login']);
                $user_data = $result_query->fetch_assoc();

                if (password_verify($password, $user_data['password'])) {
                        unset($_SESSION['log_error_pass']);
                                              
                        $_SESSION['is_logged'] = true;
                        $_SESSION['login'] = $login;
                        $_SESSION['id'] = $user_data['id'];
                        $_SESSION['user_email'] = $user_data['email'];
                        $_SESSION['avatar_img'] = $user_data['avatar_file_img'];
                        $_SESSION['logo_img'] = $user_data['company_logo_file_path'];

                        $_SESSION['company_name'] = $user_data['company_name'];
                        $_SESSION['address1'] = $user_data['address1'];
                        $_SESSION['address2'] = $user_data['address2'];
                        $_SESSION['company_number'] = $user_data['company_number'];
                        $_SESSION['default_invoice_city'] = $user_data['default_invoice_city'];
                        $_SESSION['default_invoice_bank_name'] = $user_data['default_invoice_bank_name'];
                        $_SESSION['default_invoice_bank_account_no'] = $user_data['default_invoice_bank_account_no'];
                        $_SESSION['default_invoice_additional_info'] = $user_data['default_invoice_additional_info'];

                        $result_query->close();
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
}
?>









