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

        $password_hash = password_hash($password1, PASSWORD_DEFAULT);
} 

// checkbox validate 

// After succeded validation
// if (!$everything_OK) header('Location: ../registration.php');
header('Location: ../registration.php');

echo $login."</br>";
echo $email."</br>";
echo $term_is_accepted."</br>";


?>