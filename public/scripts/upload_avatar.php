<?php
session_start();

// echo "<b>File name: </b>".$_FILES['change-avatar-btn']['name']."<br>";
// echo "<b>Type: </b>".$_FILES['change-avatar-btn']['type']."<br>";
// echo "<b>Size: </b>".$_FILES['change-avatar-btn']['size']." B<br>";
// echo "<b>Tmp name: </b>".$_FILES['change-avatar-btn']['tmp_name']."<br>"; 
// echo "<b>Error: </b>".$_FILES['change-avatar-btn']['error']."<br>";
// echo "<b>Full path: </b>".$_FILES['change-avatar-btn']['full_path']."<br>";

// Get user data to $user assoc array
if (isset($_SESSION['user'])) $user = $_SESSION['user'];

if (isset($_FILES['change-avatar-btn']['name'])) {
        $image_name = $_FILES['change-avatar-btn']['name'];
        $image_size = $_FILES['change-avatar-btn']['size'];
        $tmp_name = $_FILES['change-avatar-btn']['tmp_name'];
        
        // image validation
        $valid_img_extension = ['jpg', 'jpeg', 'png'];
        $img_extension = explode('.', $image_name);
        $img_extension = strtolower(end($img_extension));

        if (!in_array($img_extension, $valid_img_extension)) {
                $_SESSION['e_upload_avatar'] = "File must be .jpg, .jpeg, .png";
                
        } elseif ($image_size > 25165824 ) {
                $_SESSION['e_upload_avatar'] = "Maximum photo size is 3mb";
        } else {
                $new_img_name = $user['login']."_avatar_".date("Y-m-d").".".$img_extension;
                
                // connect with database
                require_once '../../config/database/db_database.php';
                
                // delete old file from server 
                $db_user = $db->prepare("SELECT * FROM users WHERE login = :login");
                $db_user->bindvalue(':login', $user['login'], PDO::PARAM_STR);
                $db_user->execute();
                $db_user_arr = $db_user->fetch(PDO::FETCH_ASSOC);
                $old_img_name = $db_user_arr['avatar_file_img'];

                if ($old_img_name !== 'default_avatar.png') {
                        unlink('../assets/img/avatars/'.$old_img_name);
                }

                // save new file in server 
                if (move_uploaded_file($tmp_name, "../assets/img/avatars/".$new_img_name)) {

                        // Set new file name (with extension) in db 
                        $db_update_user_img_name = $db->prepare("UPDATE users 
                                SET avatar_file_img = :file_name 
                                WHERE login = :login");
                        $db_update_user_img_name->bindvalue(':file_name', $new_img_name, PDO::PARAM_STR);
                        $db_update_user_img_name->bindvalue(':login', $user['login'], PDO::PARAM_STR);
                        $db_update_user_img_name->execute();

                        // update $_SESSION['user']
                        $user['avatar'] = $new_img_name;
                        $_SESSION['user'] = $user;

                        $_SESSION['e_upload_avatar'] = "";
                } else {
                        $_SESSION['e_upload_avatar'] = "Failure to save file";
                }
        }

        header('Location: ../settings.php');
        exit();
}

?>