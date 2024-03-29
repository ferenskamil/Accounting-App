<?php
session_start();

require_once './scripts/redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');

// Get user data to $user assoc array
if (isset($_SESSION['user'])) $user = $_SESSION['user'];

// Create an instance of the User class.
require_once '../class/user.class.php';
$user_obj = new User();

// Put invoice information in an associative array $invoices
$invoices = $user_obj->get_all_invoices($user['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../templates/head_links.php'; ?>
        <title>Invoice List</title>
</head>

<body>
        <div class="confirm__shadow">
                <div class="confirm__pop-up">
                        <div class="confirm__pop-up-message">
                                <p>Are you sure you want to delete invoice number
                                        <span>01/01/2023</span> ?</p>
                        </div>
                        <div class="confirm__pop-up-buttons">
                                <form action="./scripts/delete_invoice.php" method="post">
                                        <input hidden type="text" id="pop-up-invoice-no-hidden-input" name="pop-up-invoice-no-hidden-input">
                                        <button type="submit" class="confirm__pop-up-buttons-delete">Delete</button>
                                </form>
                                <button class="confirm__pop-up-buttons-return">Return</button>
                        </div>
                </div>
        </div>

        <?php require_once '../templates/nav_topbar.php';?>
        <main class="main invoice-list">
                <a href="./add_edit_form.php" class="invoice-list__add-new-btn">
                        <button>
                                <i class="fa-solid fa-plus"></i>Add new invoice
                        </button>
                </a>
                <?php
                        if (isset($_SESSION['comment_after_delete'])) {
                                echo('
                                <div class="invoice-list__pop-up pop-up">
                                        <div class="invoice__pop-up-box">
                                                <i class="fa-solid fa-trash-can"></i>
                                                <p class="invoice__pop-up-text">'.$_SESSION['comment_after_delete'].'</p>
                                        </div>
                                        <button class="close-pop-up">
                                                <i class="fa-solid fa-xmark"></i>
                                        </button>
                                </div>');

                                unset($_SESSION['comment_after_delete']);
                        } else if (isset($_SESSION['comment_download_error'])) {
                                echo('
                                <div class="invoice-list__pop-up pop-up">
                                        <div class="invoice__pop-up-box">
                                                <i class="fa-solid fa-trash-can"></i>
                                                <p class="invoice__pop-up-text">'.$_SESSION['comment_download_error'].'</p>
                                        </div>
                                        <button class="close-pop-up">
                                                <i class="fa-solid fa-xmark"></i>
                                        </button>
                                </div>');

                                unset($_SESSION['comment_download_error']);
                        }
                ?>
                <table class="invoice-list__table">
                        <thead class="invoice-list__table-thead">
                                <tr>
                                        <th class="invoice-list__table-thead--mobile">Invoices</th>
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
                                <tr class="invoice-list__table-tbody-empty_info">
                                        <td>You have not created any invoice yet. <a href="./add_edit_form.php">
                                                Create one now
                                        </a></td>
                                </tr>
                                <?php
                                      foreach ($invoices as $invoice) {
                                        $item = '
                                        <tr class="invoice-list__table-tbody-item">
                                                <td><span class="invoice-list__table-tbody-item--mobile-title">Invoice No:
                                                        </span>
                                                        <span>'.$invoice['no'].'</span>
                                                </td>
                                                <td><span class="invoice-list__table-tbody-item--mobile-title">Contractor:
                                                        </span>
                                                        '.$invoice['customer_name'].'
                                                </td>
                                                <td><span class="invoice-list__table-tbody-item--mobile-title">Contractor No:
                                                        </span>
                                                        '.$invoice['customer_company_no'].'
                                                </td>
                                                <td><span class="invoice-list__table-tbody-item--mobile-title">Gross:
                                                        </span>
                                                        '.$invoice['sum_gross'].' $
                                                </td>
                                                <td><span class="invoice-list__table-tbody-item--mobile-title">Net:
                                                        </span>
                                                        '.$invoice['sum_net'].' $
                                                </td>
                                                <td><span class="invoice-list__table-tbody-item--mobile-title">Status:
                                                        </span>
                                                        not-send</td>
                                                <td class="invoice-list__table-tbody-item-btns">
                                                        <form action="./preview.php" method="post">
                                                                <input hidden class="invoice-no-hidden-input" name="invoice-no" type="text" value="'.$invoice['no'].'">
                                                                <button class="preview-btn"><i class="fa-solid fa-magnifying-glass"></i>View</button>
                                                        </form>
                                                        <form action="./scripts/download_pdf.php" method="post">
                                                                <input hidden class="invoice-id-hidden-input" name="invoice-no" type="text" value="'.$invoice['no'].'">
                                                                <button type="submit">
                                                                        <i class="fa-solid fa-download"></i>
                                                                        Download
                                                                </button>
                                                        </form>
                                                        <button class="delete-btn"><i
                                                                        class="fa-solid fa-trash"></i>Delete</button>
                                                </td>
                                        </tr>';
                                        echo $item;
                                }?>
                        </tbody>
                </table>
        </main>

        <script src="../assets/js/common/nav.min.js"></script>
        <script src="../assets/js/common/popup_message.min.js"></script>
        <script src="../assets/js/common/confirm_popup.min.js"></script>
        <script src="../assets/js/pages/invoice_list/list.min.js"></script>

</body>

</html>