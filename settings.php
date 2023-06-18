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
                        <a href="#" class="nav__item">
                                <span class="nav__item-icon"><i class="fa-solid fa-lock-open"></i></span>
                                <span class="nav__item-title"> Lorem ipsum</span>
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
                <img src="./dist/img/avatars/mrkaam_avatar.jpg" alt="Kamil Ferens photo">
        </div>
        <div class="shadow"></div>
</div>
        <main class="main settings">
                <h1 class="settings__title">Settings</h1>
                <p class="settings__description">Here you can set default information for all invoices you will issue in
                        the future. Later, too, you will be able to edit them from within a single invoice</p>
                <form action="" method="post" class="settings__form">
                        <div class="settings__form-box">
                                <h2>Company info</h2>
                                <label for="settings-company-name">Nazwa firmy: </label>
                                <input type="text" id="settings-company-name" name="settings-company-name">
                                <label for="settings-company-address1">Adres: </label>
                                <input type="text" id="settings-company-address1" name="settings-company-address1">
                                <label for="settings-company-address2">Adres cz.2: </label>
                                <input type="text" id="settings-company-address2" name="settings-company-address2">
                                <label for="settings-company-number">NIP: </label>
                                <input type="text" id="settings-company-number" name="settings-company-number">
                        </div>
                        <div class="settings__form-box">
                                <h2>Invoice default info</h2>
                                <label for="settings-invoice-city">Miejscowość: </label>
                                <input type="text" id="settings-invoice-city" name="settings-invoice-city">
                                <label for="settings-invoice-bank">Bank: </label>
                                <input type="text" id="settings-invoice-bank" name="settings-invoice-bank">
                                <label for="settings-invoice-account-no">Nr konta: </label>
                                <input type="text" id="settings-invoice-account-no" name="settings-invoice-account-no">
                        </div>
                        <div class="settings__form-box settings__form-box-additional-info">
                                <h2>Additional info</h2>
                                <p>*Fill in if the following applies to the good (service).
                                        subject exemptions from tax</p>
                                <textarea name="settings-additional-info" id="settings-additional-info" cols="30"
                                        rows="10">Zwolnienie podmiotowe art. 113 ust. o podatku dochodowym Lorem ipsum</textarea>
                        </div>
                        <div class="settings__form-submit-btn-box">
                                <button type="submit"><i class="fa-solid fa-floppy-disk "></i>Save</button>
                        </div>
                </form>



        </main>
        <script src="./dist/js/index.min.js"></script>
</body>

</html>