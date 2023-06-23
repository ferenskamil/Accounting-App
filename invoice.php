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
        <title>Invoice (test)</title>
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
                <img src="./dist/img/avatars/<?php echo $_SESSION['avatar_img'] ?>" alt="user photo">
        </div>
        <div class="shadow"></div>
</div>
        <main class="main invoice">
                <div class="invoice__settings">
                        <button><i class="fa-solid fa-paper-plane"></i>Send</button>
                        <button class="invoice__settings-edit"><i class="fa-solid fa-pen-to-square"></i>Edit</button>
                        <button><i class="fa-solid fa-trash"></i>Delete</button>
                        <button><i class="fa-solid fa-download"></i>Download</button>
                </div>
                <div class="invoice__container">
                        <div class="invoice__paper">
                                <img class="invoice__paper-logo" src="./dist/img/logo/test_logo.png"
                                        alt="logo firmy wystawiającej fakturę">
                                <h2 class="invoice__paper-title">Faktura VAT nr<span id="invoice-no-view"></span></h2>
                                <div class="invoice__paper-content invoice-info">
                                        <p><Strong>Data wystawienia: </Strong><span id="date-view"></span></p>
                                        <p><Strong>Miejscowość: </Strong><span id="city-view"></span></p>
                                        <p><Strong>Bank: </Strong><span id="bank-view"></span></p>
                                        <p><Strong>Nr konta: </Strong><span id="account-no-view"></span></p>
                                        <p><Strong>Termin zapłaty: </Strong><span id="term-view"></span></p>
                                </div>
                                <div class="invoice__paper-content invoice-seller">
                                        <h3>Sprzedawca</h3>
                                        <p><span id="seller-name-view"></span></p>
                                        <p><span id="seller-address1-view"></span></p>
                                        <p><span id="seller-address2-view"></span></p>
                                        <p><span id="seller-NIP-view"></span></p>
                                </div>
                                <div class="invoice__paper-content invoice-customer">
                                        <h3>Nabywca</h3>
                                        <p><span id="customer-name-view"></span></p>
                                        <p><span id="customer-address1-view"></span></p>
                                        <p><span id="customer-address2-view"></span></p>
                                        <p><span id="customer-NIP-view"></span></p>
                                </div>
                                <div class="invoice__paper-content invoice__paper-services">
                                        <table>
                                                <thead>
                                                        <tr>
                                                                <th>L.p.</th>
                                                                <th>Nazwa towaru / usługi</th>
                                                                <th>Kod PKWiU</th>
                                                                <th>Ilość</th>
                                                                <th>Cena netto</th>
                                                                <th>Stawka VAT</th>
                                                                <th>Wartość netto</th>
                                                                <th>Wartość brutto</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                        <tr>
                                                                <td colspan="4"></td>
                                                                <td>RAZEM:</td>
                                                                <td></td>
                                                                <td class="preview-total-net">0 zł</td>
                                                                <td class="preview-total-gross">0 zł</td>
                                                        </tr>
                                                </tfoot>
                                        </table>
                                </div>
                                <div class="invoice__paper-content invoice-sum">
                                        <p><Strong>Do zapłaty: </Strong><span id="invoice__sum-numeric"></span>
                                                zł
                                        </p>
                                        <p><Strong>Słownie: </Strong><span id="invoice__sum-verbal"></span></p>
                                </div>
                                <div class="invoice__paper-content invoice-comments">
                                        <h3>Informacje dodatkowe</h3>
                                        <p class="comment"><span id="comment-view"></span></p>
                                        <p class="footnote">*Wypełnia się w przypadku, gdy do towaru (usługi) stosuje
                                                się zwolnienia przedmiotowe z podatku</p>
                                </div>
                                <div class="invoice__paper-content invoice-sign">
                                        <div class="line"></div>
                                        <p>Podpis osoby upoważnionej do wystawienia faktury</p>
                                </div>
                        </div>
                </div>
                <!-- shadow? -->
                <div class="invoice__edit">
                        <button class="invoice__edit-back"><i
                                        class="fa-sharp fa-solid fa-arrow-rotate-left"></i>Return</button>
                        <form action="" method="post" class="invoice__edit-form">
                                <div class="invoice__edit-form-box invoice__edit-form-box-details ">
                                        <h2>Szczegóły</h2>
                                        <label for="invoice-no-edit">Nr faktury</label>
                                        <input type="text" name="invoice-no" id="invoice-no-edit" value="01/01/2023">
                                        <label for="date-edit">Data wystawienia: </label>
                                        <input class="test" type="date" name="date" id="date-edit" value="2024-05-18">
                                        <label for="city-edit">Miejscowość: </label>
                                        <input type="text" name="city" id="city-edit" value="Wrocław">
                                        <label for="bank-edit">Bank: </label>
                                        <input type="text" name="bank" id="bank-edit" value="mBank">
                                        <label for="account-no-edit">Nr konta: </label>
                                        <input type="text" name="account-no" id="account-no-edit"
                                                value="99 0000 1111 2222 3333 4444 5555">
                                        <label for="term-edit">Termin zapłaty: </label>
                                        <select name="term" id="term-edit">
                                                <option value="7 dni">7 dni</option>
                                                <option value="14 dni" selected>14 dni</option>
                                        </select>
                                </div>
                                <div class="invoice__edit-form-box invoice__edit-form-box-seller">
                                        <h2>Twoje dane</h2>
                                        <label for="seller-name-edit">Nazwa: </label>
                                        <input type="text" name="seller-name" id="seller-name-edit"
                                                value="Pizzeria Roma">
                                        <label for="seller-address1-edit">Adres: </label>
                                        <input type="text" name="seller-address1" id="seller-address1-edit"
                                                value="ul.Warszawska 14/3">
                                        <label for="seller-address2-edit">Adres cz.2: </label>
                                        <input type="text" name="seller-address2" id="seller-address2-edit"
                                                value="54-123 Wrocław">
                                        <label for="seller-NIP-edit">NIP: </label>
                                        <input type="text" name="seller-NIP" id="seller-NIP-edit" value="1234432112"
                                                placeholder="jeżeli brak wpisz '---'">
                                </div>
                                <div class="invoice__edit-form-box invoice__edit-form-box-customer">
                                        <h2>Dane nabywcy</h2>
                                        <label for="customer-name-edit">Nazwa: </label>
                                        <input type="text" name="customer-name" id="customer-name-edit"
                                                value="Jan Kowalski">
                                        <label for="customer-address1-edit">Adres: </label>
                                        <input type="text" name="customer-address1" id="customer-address1-edit"
                                                value="ul.Słoneczna 12c">
                                        <label for="customer-address2-edit">Adres cz.2: </label>
                                        <input type="text" name="customer-address2" id="customer-address2-edit"
                                                value="54-123 Wrocław">
                                        <label for="customer-NIP-edit">NIP: </label>
                                        <input type="text" name="customer-NIP" id="customer-NIP-edit" value="---"
                                                placeholder="jeżeli brak wpisz '---'">
                                </div>
                                <div class="invoice__edit-form-box invoice__edit-form-box-services">
                                        <h2>Usługi</h2>
                                        <table class="invoice__edit-form-box-services-table">
                                                <thead>
                                                        <tr>
                                                                <th class="service-thead--mobile">Services
                                                                        list</th>
                                                                <th class="service-thead--large">L.p.</th>
                                                                <th class="service-thead--large">Nazwa towaru / usługi
                                                                </th>
                                                                <th class="service-thead--large">Kod PKWiU</th>
                                                                <th class="service-thead--large">Ilość</th>
                                                                <th class="service-thead--large">Cena netto (zł)</th>
                                                                <th class="service-thead--large">Stawka VAT</th>
                                                                <th class="service-thead--large">Wartość netto</th>
                                                                <th class="service-thead--large">Wartość brutto</th>
                                                                <th class="service-thead--large"></th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <tr class="empty-info">
                                                                <td>Brak pozycji na liście</td>
                                                        </tr>
                                                </tbody>
                                                <tfoot>
                                                        <tr>
                                                                <td><button class="new-service-btn"><i
                                                                                        class="fa-sharp fa-solid fa-plus"></i>
                                                                                Add new</button></td>
                                                                <td><strong>RAZEM:</strong></td>
                                                                <td><span class="service-title--mobile"><strong>Wartość
                                                                                        netto:
                                                                                </strong></span><span
                                                                                class="invoice-total-net">0.00 zł</span>
                                                                </td>
                                                                <td><span class="service-title--mobile"><strong>Cena
                                                                                        brutto:
                                                                                </strong></span><span
                                                                                class="invoice-total-gross">0.00
                                                                                zł</span>
                                                                </td>
                                                        </tr>
                                                </tfoot>
                                        </table>
                                </div>
                                <div class="invoice__edit-form-box invoice__edit-form-box-comments">
                                        <h2>Dodatkowe informacje</h2>
                                        <p>*Wypełnia się w przypadku, gdy do towaru (usługi) stosuje
                                                się zwolnienia przedmiotowe z podatku</p>
                                        <textarea name="comment" id="comment-edit" cols="30"
                                                rows="10">Zwolnienie podmiotowe art. 113 ust. o podatku dochodwym Lorem ipsum</textarea>
                                </div>
                                <div class="invoice__edit-form-box-submit-btn">
                                        <button type="submit"><i class="fa-solid fa-floppy-disk "></i>Save</button>
                                </div>
                        </form>
                </div>
        </main>
        <script src="./dist/js/index.min.js"></script>
        <script src="./dist/js/invoice/open_hide_edit_form.min.js"></script>
        <script src="./dist/js/invoice/edit_form_validation.min.js"></script>
        <script src="./dist/js/invoice/edit_form_services.min.js"></script>
        <script src="./dist/js/invoice/transfer_data_from_edit_to_preview.min.js"></script>
        <script src="./dist/js/invoice/num_to_word.min.js"></script>
</body>

</html>