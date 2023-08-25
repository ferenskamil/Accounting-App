<?php 
session_start();

require_once './scripts/redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');

// Check from where the invoice information was transferred for display.
// They should come, either from the 'list.php' file and be passed via the POST method, or from the 'update_invoice_in_db.php' or 'scripts/update_invoice_in_db.php' files and be passed in the session variable $_SESSION['invoice_no_to_display'].
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
if (
        (strpos($referer, 'public/list.php') !== false && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['invoice-no']))
        || (strpos($referer, 'public/add_edit_form.php') !== false && isset($_SESSION['invoice_no_to_display']))
        || (strpos($referer, 'public/scripts/update_invoice_in_db.php') !== false && isset($_SESSION['invoice_no_to_display']))
)
{
        // Assign invoice number to variables depending of origin 
        $invoice_no = $_POST['invoice-no'] ?? $_SESSION['invoice_no_to_display'];

        // Unset  $_SESSION['invoice_no_to_display'] if exist
        unset( $_SESSION['invoice_no_to_display']);

        // Get user data and assign to $user assoc array
        if (isset($_SESSION['user'])) $user = $_SESSION['user'];

        // Get information about invoice and services and assign to variables
        require_once '../class/invoice.class.php';
        $invoice_obj = new Invoice($invoice_no , $user['id']);
        $invoice = $invoice_obj->get_invoice();
        $services = $invoice['services'];
}
else 
{
        // Redirect to invoice list
        header('Location: list.php');
        exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../templates/head_links.php'; ?>
        <title>Invoice preview</title>
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
<?php
require_once '../templates/confirm_send.php';
require_once '../templates/nav_topbar.php';
?>
        <main class="main invoice">
                <div class="invoice__settings">
                        <button class="send-btn"><i class="fa-solid fa-paper-plane"></i>Send</button>
                        <form action="./add_edit_form.php" method="post">
                                <input hidden type="text" value="<?php echo $invoice['no'] ?>" name="invoice_no_to_edit">
                                <button type="submit" class="invoice__settings-edit"><i class="fa-solid fa-pen-to-square"></i>Edit</button>
                        </form>
                        <form action="../config/dompdf/download_pdf.php" method="post">
                                <input hidden type="text" value="<?php echo $invoice['id'] ?>" name="invoice-id">
                                <button type="submit">
                                        <i class="fa-solid fa-download"></i>
                                        Download
                                </button>
                        </form>
                        <button class="delete-btn"><i class="fa-solid fa-trash"></i>Delete</button>
                </div>
                <?php
                        if (isset($_SESSION['comment_after_edit'])) {
                                echo('
                                <div class="invoice__pop-up pop-up">
                                        <div class="invoice__pop-up-box">
                                                <i class="fa-regular fa-circle-check"></i>
                                                <p class="invoice__pop-up-text">'.$_SESSION['comment_after_edit'].'</p>
                                        </div>
                                        <button class="close-pop-up">
                                                <i class="fa-solid fa-xmark"></i>
                                        </button>
                                </div>');

                                unset($_SESSION['comment_after_edit']);
                        } else if (isset($_SESSION['comment_after_email'])) {
                                echo('
                                <div class="invoice__pop-up pop-up">
                                        <div class="invoice__pop-up-box">
                                                <i class="fa-regular fa-circle-check"></i>
                                                <p class="invoice__pop-up-text">'.$_SESSION['comment_after_email'].'</p>
                                        </div>
                                        <button class="close-pop-up">
                                                <i class="fa-solid fa-xmark"></i>
                                        </button>
                                </div>');
                                unset($_SESSION['comment_after_email']);
                        }
                ?>
                <div class="invoice__container">
                        <div class="invoice__paper">
                                <img class="invoice__paper-logo" src="../assets/user_img/logos/<?php echo $user['logo'] ?>"
                                        alt="company logo">
                                <h2 class="invoice__paper-title">Invoice no. <span class="invoice-no"><?php 
                                        echo $invoice['no'] 
                                ?></span></h2>
                                <div class="invoice__paper-content invoice-info">
                                        <p><Strong>Invoice date: </Strong><span class="invoice-date">
                                                <?php echo $invoice['date'] ?>
                                        </span></p>
                                        <p><Strong>City: </Strong><span class="invoice-city">
                                                <?php echo $invoice['city'] ?>
                                        </span></p>
                                        <p><Strong>Bank: </Strong><span class="invoice-bank">
                                                <?php echo $invoice['bank'] ?>
                                        </span></p>
                                        <p><Strong>Account no.: </Strong><span class="invoice-account-no">
                                                <?php echo $invoice['account_no'] ?>
                                        </span></p>
                                        <p><Strong>Payment term: </Strong><span class="invoice-term">
                                                <?php echo $invoice['payment_term'] ?>
                                        </span></p>
                                </div>
                                <div class="invoice__paper-content invoice-seller">
                                        <h3>Seller:</h3>
                                        <p><span>
                                                <?php echo $invoice['seller_name'] ?>
                                        </span></p>
                                        <p><span>
                                                <?php echo $invoice['seller_address1'] ?>
                                        </span></p>
                                        <p><span>
                                                <?php echo $invoice['seller_address2'] ?>
                                        </span></p>
                                        <p><span>
                                                <?php echo "NIP: ".$invoice['seller_company_no'] ?>
                                        </span></p>
                                </div>
                                <div class="invoice__paper-content invoice-customer">
                                        <h3>Bill to:</h3>
                                        <p><span class="invoice-name">
                                                <?php echo $invoice['customer_name'] ?>
                                        </span></p>
                                        <p><span class="invoice-address1">
                                                <?php echo $invoice['customer_address1'] ?>
                                        </span></p>
                                        <p><span class="invoice-address2">
                                                <?php echo $invoice['customer_address2'] ?>
                                        </span></p>
                                        <p><span class="invoice-company-code">
                                                <?php echo "NIP: ".$invoice['customer_company_no'] ?>
                                        </span></p>
                                </div>
                                <div class="invoice__paper-content invoice__paper-services">
                                        <table>
                                                <thead>
                                                        <tr>
                                                                <th>No.</th>
                                                                <th>Item / service</th>
                                                                <th>Service code</th>
                                                                <th>Quantity</th>
                                                                <th>Net price</th>
                                                                <th>Tax</th>
                                                                <th>Net sum</th>
                                                                <th>Gross sum</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <?php
                                                        foreach ($services as $service) {
                                                                if ($service['service_tax'] === '0.00') {
                                                                        $service_tax = "tax-free";
                                                                } else {
                                                                        $service_tax = strval($service['service_tax']*100)."%";
                                                                }
                                                                echo("
                                                                <tr>
                                                                        <td>{$service['position']}</td>
                                                                        <td>{$service['service_name']}</td>
                                                                        <td>{$service['service_code']}</td>
                                                                        <td>{$service['quantity']}</td>
                                                                        <td>".number_format($service['item_net_price'], 2, ',',' ')."</td>
                                                                        <td>{$service_tax}</td>
                                                                        <td>".number_format($service['service_total_net'], 2, ',',' ')." $</td>
                                                                        <td>".number_format($service['service_total_gross'], 2, ',',' ')." $</td>
                                                                </tr>");
                                                        }?>
                                                </tbody>
                                                <tfoot>
                                                        <tr>
                                                                <td colspan="4"></td>
                                                                <td>TOTAL:</td>
                                                                <td></td>
                                                                <td>
                                                                        <?php echo number_format($invoice['sum_net'], 2, ',',' ')." $" ?>
                                                                </td>
                                                                <td>
                                                                        <?php echo number_format($invoice['sum_gross'], 2, ',',' ')." $" ?>
                                                                </td>
                                                        </tr>
                                                </tfoot>
                                        </table>
                                </div>
                                <div class="invoice__paper-content invoice-sum">
                                        <p><Strong>To pay: </Strong><span class="invoice-to-pay">
                                                <?php echo number_format($invoice['to_pay'], 2, ',',' ')." $" ?>
                                        </span></p>
                                        <p><Strong>In words: </Strong><span>
                                                <?php echo $invoice['to_pay_in_words'] ?>
                                        </span></p>
                                </div>
                                <div class="invoice__paper-content invoice-comments">
                                        <h3>Additional notes</h3>
                                        <pre class="comment"><?php echo $invoice['additional_notes'] ?></pre>
                                        <p class="footnote">*Fill in if the following applies to the good (service). For example, subject exemptions from tax.</p>
                                </div>
                                <div class="invoice__paper-content invoice-sign">
                                        <div class="line"></div>
                                        <p>Signature of authorized person</p>
                                </div>
                        </div>
                </div>
        </main>
        <script src="../assets/js/index.min.js"></script>
        <script src="../assets/js/popup_message.min.js"></script>
        <script src="../assets/js/confirm_popup.min.js"></script>
        <script src="../assets/js/confirm_send.min.js"></script>
</body>

</html>