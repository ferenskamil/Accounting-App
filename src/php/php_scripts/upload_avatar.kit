<?php
session_start();

// echo "<b>File name: </b>".$_FILES['upload-img-btn']['name']."<br>";
// echo "<b>Type: </b>".$_FILES['upload-img-btn']['type']."<br>";
// echo "<b>Size: </b>".$_FILES['upload-img-btn']['size']." B<br>";
// echo "<b>Tmp name: </b>".$_FILES['upload-img-btn']['tmp_name']."<br>"; 
// echo "<b>Error: </b>".$_FILES['upload-img-btn']['error']."<br>";
// echo "<b>Full path: </b>".$_FILES['upload-img-btn']['full_path']."<br>";

// $test = fopen("localhost/accountingApp/test.txt", "w");
// unlink("../test.txt");

if (isset($_FILES['upload-img-btn']['name'])) {
        $image_name = $_FILES['upload-img-btn']['name'];
        $image_size = $_FILES['upload-img-btn']['size'];
        $tmp_name = $_FILES['upload-img-btn']['tmp_name'];
        
        // image validation
        $valid_img_extension = ['jpg', 'jpeg', 'png'];
        $img_extension = explode('.', $image_name);
        $img_extension = strtolower(end($img_extension));

        if (!in_array($img_extension, $valid_img_extension)) {
                $_SESSION['e_upload'] = "File must be .jpg, .jpeg, .png";
                
        } elseif ($image_size > 25165824 ) {
                $_SESSION['e_upload'] = "Maximum photo size is 3mb";
        } else {
                $new_img_name = $_SESSION['login']."_avatar_".date("Y-m-d").".".$img_extension;
                
                // connect with database
                require_once 'db_database.php';
                
                // delete old file from server 
                $db_user = $db->prepare("SELECT * FROM users WHERE login = :login");
                $db_user->bindvalue(':login', $_SESSION['login'], PDO::PARAM_STR);
                $db_user->execute();
                $db_user_arr = $db_user->fetch(PDO::FETCH_ASSOC);
                $old_img_name = $db_user_arr['avatar_file_img'];

                if ($old_img_name !== 'default_avatar.png') {
                        unlink('../dist/img/avatars/'.$old_img_name);
                }

                // save new file in server 
                if (move_uploaded_file($tmp_name, "../dist/img/avatars/".$new_img_name)) {

                        // Set new file name (with extension) in db 
                        $db_update_user_img_name = $db->prepare("UPDATE users SET avatar_file_img = :file_name WHERE login = :login");
                        $db_update_user_img_name->bindvalue(':file_name', $new_img_name, PDO::PARAM_STR);
                        $db_update_user_img_name->bindvalue(':login', $_SESSION['login'], PDO::PARAM_STR);
                        $db_update_user_img_name->execute();

                        // Set session variables
                        $_SESSION['avatar_img'] = $new_img_name;
                        $_SESSION['e_upload'] = "";
                } else {
                        $_SESSION['e_upload'] = "Failure to save file";
                }
        }

        header('Location: ../settings.php');
        exit();
}

?>