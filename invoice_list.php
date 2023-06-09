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
        <title>Invoice List</title>
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
        <main class="main invoice-list">
                <table class="invoice-list__table">
                        <thead class="invoice-list__table-thead">
                                <tr>
                                        <th class="invoice-list__table-thead--mobile">Lista faktur</th>
                                        <th class="invoice-list__table-thead--tablet">Invoice No</th>
                                        <th class="invoice-list__table-thead--tablet">Contractor</th>
                                        <th class="invoice-list__table-thead--tablet">Contractor No</th>
                                        <th class="invoice-list__table-thead--tablet">Gross</th>
                                        <th class="invoice-list__table-thead--tablet">Net</th>
                                        <th class="invoice-list__table-thead--tablet">Status</th>
                                        <th class="invoice-list__table-thead--PC">Settings</th>
                                </tr>
                        </thead>
                        <tbody class="invoice-list__table-tbody">
                                <tr class="invoice-list__table-tbody-item">
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Invoice No:
                                                </span>
                                                01/01/2023
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Contractor:
                                                </span>
                                                Jan Kowalski
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Contractor No:
                                                </span>
                                                123456789
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Gross:
                                                </span>
                                                9999zł
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Net:
                                                </span>
                                                8765zł
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Status:
                                                </span>
                                                not-send</td>
                                        <td class="invoice-list__table-tbody-item-btns">
                                                <button><i class="fa-solid fa-magnifying-glass"></i>View</button>
                                                <button><i class="fa-solid fa-download"></i>Download</button>
                                                <button><i class="fa-solid fa-print"></i>Print</button>
                                                <button class="delete-btn"><i
                                                                class="fa-solid fa-trash"></i>Delete</button>
                                        </td>
                                </tr>
                                <tr class="invoice-list__table-tbody-item">
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Invoice No:
                                                </span>
                                                01/01/2023
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Contractor:
                                                </span>
                                                Jan Kowalski
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Contractor No:
                                                </span>
                                                123456789
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Gross:
                                                </span>
                                                9999zł
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Net:
                                                </span>
                                                8765zł
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Status:
                                                </span>
                                                not-send
                                        </td>
                                        <td class="invoice-list__table-tbody-item-btns">
                                                <button><i class="fa-solid fa-magnifying-glass"></i>View</button>
                                                <button><i class="fa-solid fa-download"></i>Download</button>
                                                <button><i class="fa-solid fa-print"></i>Print</button>
                                                <button class="delete-btn"><i
                                                                class="fa-solid fa-trash"></i>Delete</button>
                                        </td>
                                </tr>
                                <tr class="invoice-list__table-tbody-item">
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Invoice No:
                                                </span>
                                                01/01/2023
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Contractor:
                                                </span>
                                                Jan Kowalski
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Contractor No:
                                                </span>
                                                123456789
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Gross:
                                                </span>
                                                9999zł
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Net:
                                                </span>
                                                8765zł
                                        </td>
                                        <td><span class="invoice-list__table-tbody-item--mobile-title">Status:
                                                </span>
                                                not-send
                                        </td>
                                        <td class="invoice-list__table-tbody-item-btns">
                                                <button><i class="fa-solid fa-magnifying-glass"></i>View</button>
                                                <button><i class="fa-solid fa-download"></i>Download</button>
                                                <button><i class="fa-solid fa-print"></i>Print</button>
                                                <button class="delete-btn"><i
                                                                class="fa-solid fa-trash"></i>Delete</button>
                                        </td>
                                </tr>
                        </tbody>
                </table>
        </main>

        <script src="./dist/js/index.min.js"></script>
</body>

</html>