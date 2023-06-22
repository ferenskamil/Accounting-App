<?php 
session_start();

$login = $_POST['login'];
$email = $_POST['email'];
if (isset($_POST['term-of-services'])) {
        $term_is_accepted =  true;
} else {
        $term_is_accepted =  false;
};



// Sava data as session variables
$_SESSION['login'] = $login;
$_SESSION['email'] = $email;
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
} 

// email validate

// password validate

// checkbox validate 

// After succeded validation
// if (!$everything_OK) header('Location: ../registration.php');
header('Location: ../registration.php');

echo $login."</br>";
echo $email."</br>";
echo $term_is_accepted."</br>";


?>