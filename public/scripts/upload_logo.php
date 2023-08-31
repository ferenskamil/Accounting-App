<?php
session_start();

// Get user data to $user assoc array
if (isset($_SESSION['user'])) $user = $_SESSION['user'];

// Create instance of Image class
require '../../class/image.class.php';
$avatar = new Image($user , $_FILES['change-logo-btn']);

try
{
        // Change img in db
        $avatar->upload_img('logo');

        // Update avatar name in $user array
        $user['logo'] = $avatar->get_file_name();

        // Unset error message after successfull upload
        unset($_SESSION['e_upload_logo']);

} catch (Exception $e)
{
        // Assign error message to session variable
        $_SESSION['e_upload_logo'] = $e;
}

header('Location: ../settings.php');
exit();
?>