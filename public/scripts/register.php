<?php 
session_start();

// Assign a value to the $regulations_checkbox variable depending on whether the regulations have been accepted.
$regulations_checkbox = isset($_POST['regulations']) && $_POST['regulations'] === 'on' ? true : false;

// Check if the user tried to register. The data should be forwarded 
// by the POST method from the "registration_form.php" form, which is located 
// in the "public" directory. If it is not, redirect to the registration form.
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
if (strpos($referer, 'public/registration_form.php') !== false &&
        $_SERVER["REQUEST_METHOD"] == "POST")
{
        // Create an instance of the User class.
        require_once '../../class/user.class.php';
        $user_obj = new User();

        // Use the 'register' method to try to register and assign the returned 
        // value (an array) to the $registration_result variable.
        $registration_result = $user_obj->register($_POST['login'] , $_POST['email'] , $_POST['password1'] , $_POST['password2'] , $regulations_checkbox);
        
        // If the registry is successful, $registration_result should contain an array with one element 'successfull_registration' with a value of 1 or 'true'.
        if (array_key_exists('successfull_registration', $registration_result))
        {
                // Redirect to the welcome page
                $_SESSION['registration_success'] = true;
                header('Location: ../welcome.php');
                exit();
        }
        // If the registration was not successful, $registration_result should contain a one-element array with an error message.
        else
        {
                // Assign appropriate message to the session variable
                $key = array_key_first($registration_result);
                $value = $registration_result[$key];
                $_SESSION[$key] = $value;

                // Assign the entered login to a session variable to display to the user in the form.
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password1'] = $_POST['password1'];
                $_SESSION['password2'] = $_POST['password2'];
                $_SESSION['regulations'] = $regulations_checkbox;

                // Redirect to the registration form, where the appropriate message will be displayed.
                header('Location: ../registration_form.php');
                exit();
        }
}
// If variables passed by the POST method are not detected, it may mean that
// the user did not fill out the form and ran the script in another way.
else 
{
        header('Location: ../registration_form.php');
        exit();
}
?>

