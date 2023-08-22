<?php

session_start();

// Check if the user tried to change the data. The data should be passed from the 'settings.php' page using the 'POST' method.
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
if (strpos($referer, 'public/settings.php') !== false &&
        $_SERVER["REQUEST_METHOD"] == "POST")
{
        // Get user data to $user assoc array
        if (isset($_SESSION['user'])) $user = $_SESSION['user'];

        // Change data in local $user array
        $user['company'] = $_POST['company'];
        $user['address1'] = $_POST['address1'];
        $user['address2'] = $_POST['address2'];
        $user['company_code'] = $_POST['company_code'];
        $user['city'] = $_POST['city'];
        $user['bank'] = $_POST['bank'];
        $user['account_no'] = $_POST['account_no'];
        $user['additional_info'] = $_POST['additional_info'];

        // Create an instance of the User class.
        require_once '../../class/user.class.php';
        $user_obj = new User();

        // Update information about user in DB.
        $user_obj->update_company_info($user);

        // Get updated information from DB.
        $_SESSION['user'] = $user_obj->get_user($user['id']);
}

// Redirect to settings.php
header('Location: ../settings.php');
exit();
?>