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
        <title>Dashboard</title>
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

        <main class="main">
                <div class="summary">
                        <div class="summary__card">
                                <div class="summary__card-text">
                                        <h2 class="summary__card-text-title">Total income</h2>
                                        <p class="summary__card-text-value"><span class="income-value">21 159</span>zł
                                        </p>
                                </div>
                                <i class="fa-solid fa-dollar-sign"></i>
                        </div>
                        <div class="summary__card">
                                <div class="summary__card-text">
                                        <h2 class="summary__card-text-title">Invoices amount</h2>
                                        <p class="summary__card-text-value"><span class="invoices-amount">5</span></p>
                                </div>
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                        <div class="summary__card">
                                <div class="summary__card-text">
                                        <h2 class="summary__card-text-title">Average value</h2>
                                        <p class="summary__card-text-value"><span class="average-value">4 569</span>zł
                                        </p>
                                </div>
                                <i class="fa-solid fa-calculator"></i>
                        </div>
                        <div class="summary__card">
                                <div class="summary__card-text">
                                        <h2 class="summary__card-text-title">After taxes</h2>
                                        <p class="summary__card-text-value"><span class="after-tax-value">16
                                                        546</span>zł</p>
                                </div>
                                <i class="fa-solid fa-piggy-bank"></i>
                        </div>
                </div>
                <div class="details">
                        <div class="details__invoices">
                                <h2 class="card-title">Invoices</h2>
                                <table class="details__invoices-table">
                                        <thead>
                                                <tr>
                                                        <th>Invoice no.</th>
                                                        <th>Contractor</th>
                                                        <th>Gross</th>
                                                        <th>Net</th>
                                                        <th>Status</th>
                                                        <th>Other</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                        <td>01/04/2023</td>
                                                        <td>Lorem ipsum dolor es</td>
                                                        <td><span>11111</span>zł</td>
                                                        <td><span>9999</span>zł</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-pen-to-square"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-download"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-share-from-square"></i></button></a>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>01/04/2023</td>
                                                        <td>Lorem ipsum dolor es</td>
                                                        <td><span>11111</span>zł</td>
                                                        <td><span>9999</span>zł</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-pen-to-square"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-download"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-share-from-square"></i></button></a>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>01/04/2023</td>
                                                        <td>Lorem ipsum dolor es</td>
                                                        <td><span>11111</span>zł</td>
                                                        <td><span>9999</span>zł</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-pen-to-square"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-download"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-share-from-square"></i></button></a>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>01/04/2023</td>
                                                        <td>Lorem ipsum dolor es</td>
                                                        <td><span>11111</span>zł</td>
                                                        <td><span>9999</span>zł</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-pen-to-square"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-download"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-share-from-square"></i></button></a>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>01/04/2023</td>
                                                        <td>Lorem ipsum dolor es</td>
                                                        <td><span>11111</span>zł</td>
                                                        <td><span>9999</span>zł</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-pen-to-square"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-download"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-share-from-square"></i></button></a>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>01/04/2023</td>
                                                        <td>Lorem ipsum dolor es</td>
                                                        <td><span>11111</span>zł</td>
                                                        <td><span>9999</span>zł</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-pen-to-square"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-download"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-share-from-square"></i></button></a>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>01/04/2023</td>
                                                        <td>Lorem ipsum dolor es</td>
                                                        <td><span>11111</span>zł</td>
                                                        <td><span>9999</span>zł</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-pen-to-square"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-download"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-share-from-square"></i></button></a>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>01/04/2023</td>
                                                        <td>Lorem ipsum dolor es</td>
                                                        <td><span>11111</span>zł</td>
                                                        <td><span>9999</span>zł</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-pen-to-square"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-download"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-share-from-square"></i></button></a>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>01/04/2023</td>
                                                        <td>Lorem ipsum dolor es</td>
                                                        <td><span>11111</span>zł</td>
                                                        <td><span>9999</span>zł</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-pen-to-square"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-download"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-share-from-square"></i></button></a>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>01/04/2023</td>
                                                        <td>Lorem ipsum dolor es</td>
                                                        <td><span>11111</span>zł</td>
                                                        <td><span>9999</span>zł</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-pen-to-square"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-download"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-share-from-square"></i></button></a>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>01/04/2023</td>
                                                        <td>Lorem ipsum dolor es</td>
                                                        <td><span>11111</span>zł</td>
                                                        <td><span>9999</span>zł</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-pen-to-square"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-download"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-share-from-square"></i></button></a>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>01/04/2023</td>
                                                        <td>Lorem ipsum dolor es</td>
                                                        <td><span>11111</span>zł</td>
                                                        <td><span>9999</span>zł</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-pen-to-square"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-download"></i></button></a>
                                                                <a href="#"><button><i
                                                                                        class="fa-solid fa-share-from-square"></i></button></a>
                                                        </td>
                                                </tr>
                                        </tbody>
                                </table>
                        </div>
                        <div class="details__results">
                                <h2 class="card-title">Annual profits</h2>
                                <canvas class="details__results-chart" id="invoices-sum-chart"></canvas>
                        </div>
                </div>
        </main>

        <script src="./dist/js/index.min.js"></script>

        <!-- GRAPH.JS -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="./dist/js/graphs/dashboard_invoices.min.js"></script>
</body>

</html>