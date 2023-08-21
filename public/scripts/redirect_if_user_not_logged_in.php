<?php 

function redirect_if_user_not_logged_in ($file_directory) {
        if (!isset($_SESSION['user'])) {
                header('Location: '.$file_directory);
                exit();
        }
}


