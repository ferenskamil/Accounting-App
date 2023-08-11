<?php
// - - - - - - - - - 
// DOWNLOAD INVOICE DATA
session_start();

require_once './redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');

// Exit the script if the user did not submit the form
if (!isset($_POST['invoice-id'])) {
        $_SESSION['comment_download_error'] = "Something went wrong, the invoice was not found. Try again in a while. ";
        header('Location: ../invoice_list.php');
        exit();
}

// If invoice id was found...
// connect with database
require_once './db_database.php';

// Dowload invoice data from database to array
$db_query = $db->prepare("SELECT * FROM invoices WHERE user_id = :user_id AND id = :invoice_id");
$db_query->bindvalue(':user_id', $_SESSION['id'], PDO::PARAM_STR);
$db_query->bindvalue(':invoice_id', $_POST['invoice-id'], PDO::PARAM_STR);
$db_query->execute();
$invoice = $db_query->fetch(PDO::FETCH_ASSOC);

// Download services from database to array
$db_services_query = $db->prepare("SELECT * FROM services WHERE user_id = :user_id AND invoice_id = :invoice_id");
$db_services_query->bindvalue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
$db_services_query->bindvalue(':invoice_id', $invoice['id'], PDO::PARAM_INT);
$db_services_query->execute();
$services_arr = $db_services_query->fetchAll(PDO::FETCH_ASSOC);

// Some variables that will be inserted into html code
foreach ($services_arr as $service) {
        if ($service['service_tax'] === '0.00') {
                $service_tax = "tax-free";
        } else {
                $service_tax = strval($service['service_tax']*100)."%";
        }
        $service_tr = "
        <tr>
                <td>{$service['position']}</td>
                <td>{$service['service_name']}</td>
                <td>{$service['service_code']}</td>
                <td>{$service['quantity']}</td>
                <td>".number_format($service['item_net_price'], 2, ',',' ')."</td>
                <td>{$service_tax}</td>
                <td>".number_format($service['service_total_net'], 2, ',',' ')." $</td>
                <td>".number_format($service['service_total_gross'], 2, ',',' ')." $</td>
        </tr>";

        // Create $all_services_tr if it is first iteration
        if (!isset($all_services_tr)) $all_services_tr = '';

        // Conacate created $service_tr to $all_services_tr
        $all_services_tr .= $service_tr;
}
$to_pay_numeric = number_format($invoice['to_pay'], 2, ',',' ');
$to_pay_verbal = $invoice['to_pay_in_words'];

$total_sum_net = number_format($invoice['sum_net'], 2, ',',' ');
$total_sum_gross = number_format($invoice['sum_gross'], 2, ',',' ');

// - - - - - - - - - 
// DOWLOAD DOMPDF LIBRARY

// include autoloader
require_once '../assets/dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$tmp = sys_get_temp_dir();

$dompdf = new Dompdf([
        'logOutputFile' => '',
        // authorize DomPdf to download fonts and other Internet assets
        'isRemoteEnabled' => true,
        // all directories must exist and not end with /
        'fontDir' => $tmp,
        'fontCache' => $tmp,
        'tempDir' => $tmp,
        'chroot' => $tmp,
    ]);

// - - - - - - - - - 
// PREPARE TO GENERATE PDF

// add image path
$logo_img_path = "../dist/img/logos/{$_SESSION['logo_img']}";
$dompdf->getOptions()->setChroot("$logo_img_path");

$html = <<<HTML
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            *,
            *::before,
            *::after {
            	box-sizing: border-box;
            	margin: 0;
            	padding: 0;
            }

            body {
                font-family: DejaVu Sans;
            }

            .pdf {
		        padding: 35px;
                padding-top: 26px;
            }

            .row {
                display: inline-block;
                position: relative;
                margin: 0 auto;
                padding: 0;
                width: 100%;
            }

            .col {
                position: relative;
                display: inline-block;
                width: 347px;
            }

            .col-p {
                margin-left: 20px;
            }

            /* Row 1 */ 
            .row1 {
                display: inline-block;
                margin-top: 14px;
                height: 150px; 
            }

            .logo {
            }

            .logo img {
                display: inline-block;
                position: relative;
                left: 0;
                top: 0;
                max-width: 150px;
            }

            .invoice-info {
                position: absolute;
                top: 0;
                right: 0;
                float: right;
                height: 100%;
            }

            .invoice-info p{
                font-size: 11px;
            }

            /* Row 2 */
            .row2 {
                margin-top: 10px;
            }

            .title {
                font-size: 20px;
            }
            /* Row 3 */
            .row3 {
                margin-top: 32px;
            }

            .details {
                font-size: 11px;
            }

            .details h3 {
                font-size: 18px;
            }

            /* Row 4  */
            .row4 {

            }

            .table {
                width: 100%;
                border-collapse: collapse;
                font-size: 11px;
            }

            .table thead {
                border: 1px solid black;
            }

            .table thead tr {
                border: 1px solid black;
            }

            .table thead tr th {
                padding: 7px 9px;
            }

            .table tbody {
                border: 1px solid black;
            }

            .table tbody tr {
                border: none;
            } 

            .table tbody tr td {
                padding: 7px 9px;
                text-align: center;
            }

            .table tfoot {

            }

            .table tfoot tr td {
                padding: 7px 9px;
                font-weight: 700;
		        text-align: center;
            }
            /* Row 5 */
            .row5 {
                margin-top: 10px;
            }

            .row5 p {
                font-size: 11px;
            }

            /* Row 6 */
            .row6 {
                position: relative;
                display: inline-block;
                margin-top: 15px;
                min-height: 40px;
                height: auto;
            }

            .notes {
            }

            .notes h3 {
                font-size: 18px;
            }

            .notes .comment {
                font-family: inherit;
                font-size: 11px;
                white-space: pre-wrap;
            }

            .notes .footnote {
                font-size: 8px;
            }
            /* row7 */
            .row7 {
                position: relative;
                display: inline-block;
                margin-top: 10px;
                height: auto;
            }

            .notes2 {
                border-top: 1px solid black;
            }

            .notes2 .footnote {
                font-size: 8px;
            }

            .sign {
                float: right;
                height: auto;
                border-top: 1px solid black;
            }

            .sign p {
                font-size: 8px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="pdf">
                <div class="row1 row">
                        <div class="logo col">
                                <img src="{$logo_img_path}" alt="company logo">
                        </div>
                        <div class="invoice-info col col-p">
                                <p><b>Invoice date: </b>{$invoice['date']}</p>
                                <p><b>City: </b>{$invoice['city']}</p>
                                <p><b>Bank: </b>{$invoice['bank']}</p>
                                <p><b>Account no.: </b>{$invoice['account_no']}</p>
                                <p><b>Payment term: </b>{$invoice['payment_term']}</p>
                        </div>
                </div>
                <div class="row2 row">
                        <h2 class="title">Invoice no. {$invoice['no']}</h2>
                </div>
                <div class="row3 row">
                        <div class="details col">
                                <h3>Seller:</h3>
                                <p>{$invoice['seller_name']}</p>
                                <p>{$invoice['seller_address1']}</p>
                                <p>{$invoice['seller_address2']}</p>
                                <p>NIP: {$invoice['seller_company_no']}</p>
                        </div>
                        <div class="details col col-p">
                                <h3>Bill to:</h3>
                                <p>{$invoice['customer_name']}</p>
                                <p>{$invoice['customer_address1']}</p>
                                <p>{$invoice['customer_address2']}</p>
                                <p>NIP: {$invoice['customer_company_no']}</p>
                        </div>
                </div>
                <div class="row4 row">
                        <table class="table">
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
                                        {$all_services_tr}
                                </tbody>
                                <tfoot>
                                        <tr>
                                                <td colspan="4"></td>
                                                <td>TOTAL:</td>
                                                <td></td>
                                                <td>{$total_sum_net} $</td>
                                                <td>{$total_sum_gross} $</td>
                                        </tr>
                                </tfoot>
                        </table>
                </div>
                <div class="row5 row">
                        <p><b>To pay: </b>{$to_pay_numeric} $</p>
                        <p><b>In words: </b>{$to_pay_verbal}</p>
                </div>
                <div class="row6 row">            
                        <div class="notes col">
                                <h3>Additional notes</h3>
                                <pre class="comment">{$invoice['additional_notes']}</pre>
                        </div>
                </div>
                <div class="row7 row">
                        <div class="notes2 col">
                                <p class="footnote">*Fill in if the following   applies to the good (service).example, subject    exemptions     from tax.</p>
                        </div>
                        <div class="sign col col-p">
                                <p>Signature of authorized person</p>
                        </div>
                </div>
        </div>
    </body>
</html>
HTML;

// - - - - - - - - - 
// GENERATE PDF

// Pass html code to $dompdf object
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$filename = $_SESSION['login']."_".str_replace('/', '_', $invoice['no']).".pdf";
$dompdf->stream($filename, [
        'compress' => true,
        'Attachment' => false, // 'Attachment' => false is only for testing. After test change to 'Attachment' => true
]);