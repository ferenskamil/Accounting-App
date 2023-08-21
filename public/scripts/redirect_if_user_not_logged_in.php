<?php 

function redirect_if_user_not_logged_in ($page_directory) {
        if (!isset($_SESSION['user'])) {
                header('Location: '.$page_directory);
                exit();
        }
}


