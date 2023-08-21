<?php
session_start();

require_once './php_scripts/redirect_if_user_not_logged_in.php';
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
        <!-- @include './head_links -->
        <title>Dashboard</title>
</head>

<body>
        <!-- @include './nav_topbar' -->

        <main class="main">
                <div class="summary">
                        <div class="summary__card">
                                <div class="summary__card-text">
                                        <h2 class="summary__card-text-title">Total income</h2>
                                        <p class="summary__card-text-value"><span class="income-value">21 159</span> $
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
                                        <p class="summary__card-text-value"><span class="average-value">4 569</span> $
                                        </p>
                                </div>
                                <i class="fa-solid fa-calculator"></i>
                        </div>
                        <div class="summary__card">
                                <div class="summary__card-text">
                                        <h2 class="summary__card-text-title">After taxes</h2>
                                        <p class="summary__card-text-value"><span class="after-tax-value">16
                                                        546</span> $</p>
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
                                                        <td><span>11111</span> $</td>
                                                        <td><span>9999</span> $</td>
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
                                                        <td><span>11111</span> $</td>
                                                        <td><span>9999</span> $</td>
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
                                                        <td><span>11111</span> $</td>
                                                        <td><span>9999</span> $</td>
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
                                                        <td><span>11111</span> $</td>
                                                        <td><span>9999</span> $</td>
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
                                                        <td><span>11111</span> $</td>
                                                        <td><span>9999</span> $</td>
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
                                                        <td><span>11111</span> $</td>
                                                        <td><span>9999</span> $</td>
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
                                                        <td><span>11111</span> $</td>
                                                        <td><span>9999</span> $</td>
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
                                                        <td><span>11111</span> $</td>
                                                        <td><span>9999</span> $</td>
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
                                                        <td><span>11111</span> $</td>
                                                        <td><span>9999</span> $</td>
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
                                                        <td><span>11111</span> $</td>
                                                        <td><span>9999</span> $</td>
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
                                                        <td><span>11111</span> $</td>
                                                        <td><span>9999</span> $</td>
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
                                                        <td><span>11111</span> $</td>
                                                        <td><span>9999</span> $</td>
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