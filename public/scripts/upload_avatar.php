<?php
session_start();

// Get user data to $user assoc array
if (isset($_SESSION['user'])) $user = $_SESSION['user'];

// Create instance of Image class
require '../../class/image.class.php';
$avatar = new Image($user , $_FILES['change-avatar-btn']);

try
{
        // Change img in db
        $avatar->upload_img('avatar');

        // Update avatar name in $user array
        $user['avatar'] = $avatar->get_file_name();
        $_SESSION['user'] = $user;

        // Unset error message after successfull upload
        unset($_SESSION['e_upload_avatar']);

} catch (Exception $e)
{
        // Assign error message to session variable
        $_SESSION['e_upload_avatar'] = $e;
}

header('Location: ../settings.php');
exit();
?>