<?php 

session_start();

if (isset($_FILES['change-logo-btn']['name'])) {
        $image_name = $_FILES['change-logo-btn']['name'];
        $image_size = $_FILES['change-logo-btn']['size'];
        $tmp_name = $_FILES['change-logo-btn']['tmp_name'];
        
        // image validation
        $valid_img_extension = ['jpg', 'jpeg', 'png'];
        $img_extension = explode('.', $image_name);
        $img_extension = strtolower(end($img_extension));

        if (!in_array($img_extension, $valid_img_extension)) {
                $_SESSION['e_upload_logo'] = "File must be .jpg, .jpeg, .png";
                
        } elseif ($image_size > 25165824 ) {
                $_SESSION['e_upload_logo'] = "Maximum photo size is 3mb";
        } else {
                $new_img_name = $_SESSION['login']."_logo_".date("Y-m-d").".".$img_extension;
                
                // connect with database
                require_once 'db_database.php';
                
                // delete old file from server 
                $db_user = $db->prepare("SELECT * FROM users WHERE login = :login");
                $db_user->bindvalue(':login', $_SESSION['login'], PDO::PARAM_STR);
                $db_user->execute();
                $db_user_arr = $db_user->fetch(PDO::FETCH_ASSOC);
                $old_img_name = $db_user_arr['company_logo_file_path'];

                if ($old_img_name !== 'default_logo.png') {
                        unlink('../dist/img/logos/'.$old_img_name);
                }

                // save new file in server 
                if (move_uploaded_file($tmp_name, "../dist/img/logos/".$new_img_name)) {

                        // Set new file name (with extension) in db 
                        $db_update_user_img_name = $db->prepare("UPDATE users 
                                SET company_logo_file_path = :file_name 
                                WHERE login = :login");
                        $db_update_user_img_name->bindvalue(':file_name', $new_img_name, PDO::PARAM_STR);
                        $db_update_user_img_name->bindvalue(':login', $_SESSION['login'], PDO::PARAM_STR);
                        $db_update_user_img_name->execute();

                        // Set session variables
                        $_SESSION['logo_img'] = $new_img_name;
                        $_SESSION['e_upload_logo'] = "";
                } else {
                        $_SESSION['e_upload_logo'] = "Failure to save file";
                }
        }

        header('Location: ../settings.php');
        exit();
}

?>