<?php
session_start();

// Check if the user tried to log in. The data should be forwarded
// by the POST method from the "login_form.php" form, which is located
// in the "public" directory. If it is not, redirect to the login form.
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
if (strpos($referer, 'public/login_form.php') !== false &&
        $_SERVER["REQUEST_METHOD"] == "POST")
{
        // Create an instance of the User class.
        require_once '../../class/user.class.php';
        $user_obj = new User();

        // Use the 'login' method to try to log in and assign the returned
        // value (an array) to the $login_result variable.
        $login_result = $user_obj->login($_POST['login'] , $_POST['password1']);

        // If errors occurred during login, assign appropriate error messages to session variables.
        // Such messages will be displayed to the user when he returns to the login form.
        if (array_key_exists('e_login' , $login_result))
        {
                // Assign the entered login to a session variable to display to the user.
                $_SESSION['login'] = $_POST['login'];

                // Assign error message and redirect to login form.
                $_SESSION['e_login'] = 'User not found.';
                header('Location: ../login_form.php');
                exit();
        }
        elseif(array_key_exists('e_pass' , $login_result))
        {
                // Assign the entered login to a session variable to display to the user in the form.
                $_SESSION['login'] = $_POST['login'];

                // Assign error message and redirect to login form.
                $_SESSION['e_pass'] = 'Invalid password';
                header('Location: ../login_form.php');
                exit();
        }
        // If the login was successful, an array of user information should be returned.
        else
        {
                // Assign above array to a session variable.
                $_SESSION['user'] = $login_result;

                // Redirection to app
                header('Location: ../dashboard.php');
                exit();
        }
}
// If variables passed by the POST method are not detected, it may mean that 
// the user did not fill out the form and ran the script in another way. 
else
{
        header('Location: ../login_form.php');
        exit();
}
?>