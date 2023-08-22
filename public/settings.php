<?php 
session_start(); 

require_once './scripts/redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');

// Get user data to $user assoc array
if (isset($_SESSION['user'])) $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../templates/head_links.php'; ?>
        <title>Settings</title>
</head>

<body>
<?php require_once '../templates/nav_topbar.php'; ?>
        <main class="main settings">
                <h1 class="settings__title">Settings</h1>
                <p class="settings__description">Here you can set default information for all invoices you will issue in
                        the future. Later, too, you will be able to edit them from within a single invoice</p>
                <form action="./scripts/upload_avatar.php" method="post" enctype="multipart/form-data"class="settings__form-change-avatar">
                        <h2>User photo</h2>
                        <div>
                                <img src="./assets/img/avatars/<?php echo $user['avatar'] ?>" alt="user photo">
                                <label for="change-avatar-btn" class="change-avatar-btn-label">
                                        <input type="file" id="change-avatar-btn" name="change-avatar-btn" accept=".jpg, .jpeg, .png">
                                        <!-- <input type="submit" value="Send File" /> -->
                                        <i class="fa-sharp fa-solid fa-camera"></i>Change avatar
                                </label>
                                <p class="error"><?php 
                                        if (isset($_SESSION['e_upload_avatar'])) echo $_SESSION['e_upload_avatar'];
                                ?></p>
                        </div>
                </form>
                <form action="./scripts/upload_logo.php" method="post" enctype="multipart/form-data"class="settings__form-change-company-logo">
                        <h2>Company logo</h2>
                        <div>
                                <img src="./assets/img/logos/<?php echo $user['logo'] ?>" alt="company logo">
                                <label for="change-logo-btn" class="change-logo-btn-label">
                                        <input type="file" id="change-logo-btn" name="change-logo-btn" accept=".jpg, .jpeg, .png">
                                        <!-- <input type="submit" value="Send File" /> -->
                                        <i class="fa-sharp fa-solid fa-camera"></i>Change logo
                                </label>
                                <p class="error"><?php 
                                        if (isset($_SESSION['e_upload_logo'])) echo $_SESSION['e_upload_logo'];
                                        ?></p>
                        </div>
                </form>
                <form action="./scripts/change_company_data.php" method="post" class="settings__form">
                        <div class="settings__form-box">
                                <h2>Company info</h2>
                                <label for="company">Name: </label>
                                <input type="text" id="company" name="company" value="<?php
                                        if (isset($user['company'])) echo $user['company'];
                                ?>">
                                <label for="address1">Address: </label>
                                <input type="text" id="address1" name="address1" value="<?php
                                        if (isset($user['address1'])) echo $user['address1'];
                                ?>">
                                <label for="address2">Address 2: </label>
                                <input type="text" id="address2" name="address2" value="<?php
                                        if (isset($user['address2'])) echo $user['address2'];
                                ?>">
                                <label for="company_code">Company code: </label>
                                <input type="text" id="company_code" name="company_code" value="<?php
                                        if (isset($user['company_code'])) echo $user['company_code'];
                                ?>">
                        </div>
                        <div class="settings__form-box">
                                <h2>Invoice default info</h2>
                                <label for="city">City: </label>
                                <input type="text" id="city" name="city" value="<?php
                                        if (isset($user['city'])) echo $user['city'];
                                ?>">
                                <label for="bank">Bank: </label>
                                <input type="text" id="bank" name="bank" value="<?php
                                        if (isset($user['bank'])) echo $user['bank'];
                                ?>">
                                <label for="account-no">Account no.: </label>
                                <input type="text" id="account-no" name="account_no" value="<?php
                                        if (isset($user['account_no'])) echo $user['account_no'];
                                ?>">
                        </div>
                        <div class="settings__form-box settings__form-box-additional-info">
                                <h2>Additional info</h2>
                                <p>*Fill in if the following applies to the good (service). For example, subject exemptions from tax.</p>
                                <textarea name="additional_info" id="additional_info" cols="30"
                                        rows="10"><?php 
                                        if (isset($user['additional_info'])) echo $user['additional_info'];
                                        ?></textarea>
                        </div>
                        <div class="settings__form-submit-btn-box">
                                <button type="submit"><i class="fa-solid fa-floppy-disk "></i>Save</button>
                        </div>
                </form>

        </main>
        <script src="../assets/js/index.min.js"></script>
        <script src="../assets/js/settings.min.js"></script>
        <script src="../assets/js/invoice/sanitize_account_number.min.js"></script>
</body>

</html>