<?php
session_start();

require_once './scripts/redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');

// Get user data to $user assoc array
if (isset($_SESSION['user'])) $user = $_SESSION['user'];

// Get info about invoices from DB
require_once '../class/user.class.php';
$user_obj = new User();
$invoices = $user_obj->get_all_invoices($user['id']);

// Set TOTAL INCOME
$total_income = 0;
foreach ($invoices as $invoice) $total_income += $invoice['sum_gross'];

// Set INVOICES AMOUNT
$invoices_amount = count($invoices);

// Set TOTAL INCOME AFTER TAXES
$after_taxes = 0;
foreach ($invoices as $invoice) $after_taxes += $invoice['sum_net'];

// Set AVERAGE VALUE
$average_value = $total_income / $invoices_amount;
$average_value = round($average_value, 2, PHP_ROUND_HALF_UP);
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../templates/head_links.php'; ?>
        <title>Dashboard</title>
</head>

<body>
        <?php require_once '../templates/nav_topbar.php'; ?>
        <main class="main">
                <div class="summary">
                        <div class="summary__card">
                                <div class="summary__card-text">
                                        <h2 class="summary__card-text-title">Total income</h2>
                                        <p class="summary__card-text-value"><span class="income-value"><?php echo $total_income ?></span> $
                                        </p>
                                </div>
                                <i class="fa-solid fa-dollar-sign"></i>
                        </div>
                        <div class="summary__card">
                                <div class="summary__card-text">
                                        <h2 class="summary__card-text-title">Invoices amount</h2>
                                        <p class="summary__card-text-value"><span class="invoices-amount"><?php echo $invoices_amount ?></span></p>
                                </div>
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                        <div class="summary__card">
                                <div class="summary__card-text">
                                        <h2 class="summary__card-text-title">Average value</h2>
                                        <p class="summary__card-text-value"><span class="average-value"><?php echo $average_value ?></span> $
                                        </p>
                                </div>
                                <i class="fa-solid fa-calculator"></i>
                        </div>
                        <div class="summary__card">
                                <div class="summary__card-text">
                                        <h2 class="summary__card-text-title">After taxes</h2>
                                        <p class="summary__card-text-value"><span class="after-tax-value"><?php echo $after_taxes ?></span> $</p>
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
                                                        <th>Net</th>
                                                        <th>Gross</th>
                                                        <th>Status</th>
                                                        <th>Other</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($invoices as $invoice) {
                                                echo <<<HTML
                                                <tr>
                                                        <td>{$invoice['no']}</td>
                                                        <td>{$invoice['customer_name']}</td>
                                                        <td><span>{$invoice['sum_net']}</span> $</td>
                                                        <td><span>{$invoice['sum_gross']}</span> $</td>
                                                        <td>not-send</td>
                                                        <td class="details__invoices-table-other">
                                                                <form action="./preview.php" method="POST">
                                                                        <input hidden type="text" name="invoice-no" value="{$invoice['no']}">
                                                                        <button><i class="fa-solid fa-magnifying-glass"></i>
                                                                                View</button>
                                                                </form>
                                                        </td>
                                                </tr>
                                        HTML;
                                        }
                                        ?>
                                        </tbody>
                                </table>
                        </div>
                        <div class="details__results">
                                <h2 class="card-title">Annual profits</h2>
                                <canvas class="details__results-chart" id="invoices-sum-chart"></canvas>
                        </div>
                </div>
        </main>

        <script src="../assets/js/common/nav.min.js"></script>

        <!-- GRAPH.JS -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="../assets/js/tools/graph_js/graph_dashboard.min.js"></script>
</body>

</html>