<?php 
session_start(); 

require_once './php_scripts/redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./dist/css/main.min.css">

        <!-- FontAwesome Kit -->
<script src="https://kit.fontawesome.com/63681c7143.js" crossorigin="anonymous"></script>

<!-- Poppins - GoogleFonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <title>Settings</title>
</head>

<body>
        <?php
        if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
        }
?>
<div class="nav">
        <ul class="nav__list">
                <li>
                        <a href="./index.php" class="nav__item">
                                <div class="nav__item-icon"><i class="fa-brands fa-apple"></i></div>
                                <div class="nav__item-title">
                                        <h2>AccountingApp</h2>
                                </div>
                        </a>
                </li>
                <li>
                        <a href="./dashboard.php" class="nav__item">
                                <span class="nav__item-icon"><i class="fa-sharp fa-solid fa-house"></i></span>
                                <span class="nav__item-title">Dashboard</span>
                        </a>
                </li>
                <li>
                        <a href="./invoice.php" class="nav__item">
                                <span class="nav__item-icon"><i class="fa-solid fa-message"></i></span>
                                <span class="nav__item-title">Invoice</span>
                        </a>
                </li>
                <li>
                        <a href="./invoice_list.php" class="nav__item">
                                <span class="nav__item-icon"><i class="fa-solid fa-users"></i></span>
                                <span class="nav__item-title">Invoice list</span>
                        </a>
                </li>
                <li>
                        <a href="./settings.php" class=" nav__item">
                                <span class="nav__item-icon"><i class="fa-sharp fa-solid fa-gear"></i></span>
                                <span class="nav__item-title">Settings</span>
                        </a>
                </li>
                <li>
                        <a href="./php_scripts/logout.php" class="nav__item">
                                <span class="nav__item-icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                                <span class="nav__item-title">Logout</span>
                        </a>
                </li>
        </ul>
</div>
<div class="topbar">
        <div class="burger-btn-container">
                <button class="burger-btn"><i class="fa-sharp fa-solid fa-bars"></i></button>
        </div>
        <div class="topbar__search">
                <input class="topbar__search-input" type="text" placeholder="Search here">
                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
        </div>
        <div class="topbar__avatar">
                <img src="./dist/img/avatars/<?php echo $_SESSION['avatar_img'] ?>" alt="user photo">
        </div>
        <div class="shadow"></div>
</div>
        <main class="main settings">
                <h1 class="settings__title">Settings</h1>
                <p class="settings__description">Here you can set default information for all invoices you will issue in
                        the future. Later, too, you will be able to edit them from within a single invoice</p>
                <form action="./php_scripts/upload_avatar.php" method="post" enctype="multipart/form-data"class="settings__form-change-avatar">
                        <h2>User photo</h2>
                        <div>
                                <img src="./dist/img/avatars/<?php echo $_SESSION['avatar_img'] ?>" alt="user photo">
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
                <form action="./php_scripts/upload_logo.php" method="post" enctype="multipart/form-data"class="settings__form-change-company-logo">
                        <h2>Company logo</h2>
                        <div>
                                <img src="./dist/img/logos/<?php echo $_SESSION['logo_img'] ?>" alt="company logo">
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
                <form action="./php_scripts/change_company_data.php" method="post" class="settings__form">
                        <div class="settings__form-box">
                                <h2>Company info</h2>
                                <label for="settings-company-name">Name: </label>
                                <input type="text" id="settings-company-name" name="settings-company-name" value="<?php 
                                        if (isset($_SESSION['company_name'])) echo $_SESSION['company_name'];
                                ?>">
                                <label for="settings-company-address1">Address: </label>
                                <input type="text" id="settings-company-address1" name="settings-company-address1" value="<?php 
                                        if (isset($_SESSION['address1'])) echo $_SESSION['address1'];
                                ?>">
                                <label for="settings-company-address2">Address 2: </label>
                                <input type="text" id="settings-company-address2" name="settings-company-address2" value="<?php 
                                        if (isset($_SESSION['address2'])) echo $_SESSION['address2'];
                                ?>">
                                <label for="settings-company-number">Company no.: </label>
                                <input type="text" id="settings-company-number" name="settings-company-number" value="<?php 
                                        if (isset($_SESSION['company_number'])) echo $_SESSION['company_number'];
                                ?>">
                        </div>
                        <div class="settings__form-box">
                                <h2>Invoice default info</h2>
                                <label for="settings-invoice-city">City: </label>
                                <input type="text" id="settings-invoice-city" name="settings-invoice-city" value="<?php 
                                        if (isset($_SESSION['default_invoice_city'])) echo $_SESSION['default_invoice_city'];
                                ?>">
                                <label for="settings-invoice-bank">Bank: </label>
                                <input type="text" id="settings-invoice-bank" name="settings-invoice-bank" value="<?php 
                                        if (isset($_SESSION['default_invoice_bank_name'])) echo $_SESSION['default_invoice_bank_name'];
                                ?>">
                                <label for="settings-invoice-account-no">Account no.: </label>
                                <input type="text" id="settings-invoice-account-no" name="settings-invoice-account-no" value="<?php 
                                        if (isset($_SESSION['default_invoice_bank_account_no'])) echo $_SESSION['default_invoice_bank_account_no'];
                                ?>">
                        </div>
                        <div class="settings__form-box settings__form-box-additional-info">
                                <h2>Additional info</h2>
                                <p>*Fill in if the following applies to the good (service). For example, subject exemptions from tax.</p>
                                <textarea name="settings-additional-info" id="settings-additional-info" cols="30"
                                        rows="10"><?php 
                                        if (isset($_SESSION['default_invoice_additional_info'])) echo $_SESSION['default_invoice_additional_info'];
                                        ?></textarea>
                        </div>
                        <div class="settings__form-submit-btn-box">
                                <button type="submit"><i class="fa-solid fa-floppy-disk "></i>Save</button>
                        </div>
                </form>

        </main>
        <script src="./dist/js/index.min.js"></script>
        <script src="./dist/js/settings.min.js"></script>
</body>

</html>