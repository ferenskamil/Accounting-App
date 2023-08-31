<?php

require_once __DIR__ . '/./file.class.php';

class Image extends File
{
        public function validate(int $maxFileSize) : bool {

                $img_size = $this->fileinfo['size'];
                $img_name = $this->fileinfo['name'];
                $img_extension = self::get_file_extension($img_name);

                // image validation
                $accepted_extensions = ['jpg', 'jpeg', 'png'];

                if (!in_array($img_extension, $accepted_extensions))
                {
                        throw new Exception("File must have type .jpg, .jpeg, .png");
                        return false;
                }
                elseif ($img_size > $maxFileSize )
                {
                        $maxSizeMb = ($maxFileSize / 1024) / 1024;
                        throw new Exception("Maximum photo size is " . $maxSizeMb . "mb");
                        return false;
                }

                return true;
        }

        public function upload_img(string $param = 'avatar' | 'logo' , int $maxFileSize  = 3 * 1024 * 1024) : bool
        {
                $tmp_name = $this->fileinfo['tmp_name'];
                $old_server_filename = $this->user['avatar'];
                $img_extension = self::get_file_extension($this->fileinfo['name']);

                $new_sever_filename = $this->user['login']."_" . $param . "_".date("Y-m-d").".".$img_extension;
                $old_server_filename = match ($param)
                {
                        'avatar' => 'default_avatar.png',
                        'logo' => 'logo.png',
                        default => null,
                };


                $folder_path = match ($param)
                {
                        'avatar' => '/../assets/user_img/avatars/',
                        'logo' => '/../assets/user_img/logos/',
                        default => null,
                };

                // validate img
                try {
                        self::validate($maxFileSize);
                }
                catch (Exception $e)
                {
                        throw new Exception($e);
                        return false;
                }
                echo "<br>";
                print_r($old_server_filename);
                echo "<br>";

                // Delete img if it isn't default img
                if ($old_server_filename !== 'default_avatar.png') {
                        unlink(__DIR__ . $folder_path . $old_server_filename );
                }

                try {
                        // save new file
                        if (move_uploaded_file($tmp_name, __DIR__ . $folder_path . $new_sever_filename))
                        {
                                // update filename in DB
                                $db_update_user_img_name = $this->db->prepare("UPDATE users
                                        SET avatar_file_img = :file_name
                                        WHERE login = :login");
                                $db_update_user_img_name->bindvalue(':file_name', $new_sever_filename, PDO::PARAM_STR);
                                $db_update_user_img_name->bindvalue(':login', $this->user['login'], PDO::PARAM_STR);
                                $db_update_user_img_name->execute();
                        }
                }
                catch(Exception $e)
                {
                        throw new Exception("File upload failed");
                        return false;
                }

                return true;
        }
}