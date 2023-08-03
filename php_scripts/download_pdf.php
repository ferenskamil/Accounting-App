<?php
// - - - - - - - - - 
// DOWNLOAD INVOICE DATA




// - - - - - - - - - 
// DOWLOAD DOMPDF LIBRARY

// include autoloader
require_once '../libs/dompdf/autoload.inc.php';

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
$logo_img_path = "../dist/img/logos/default_logo.png";
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
                font-size: 11px;
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
                                <p><b>Invoice date: </b><span>01.01.2023</span></p>
                                <p><b>City: </b><span>test</span></p>
                                <p><b>Bank: </b><span>test</span></p>
                                <p><b>Account no.: </b><span>00 1111 2222 3333 4444 5555 6666</span></p>
                                <p><b>Payment term: </b><span>14 days</span></p>
                        </div>
                </div>
                <div class="row2 row">
                        <h2 class="title">Invoice no. <span>test</span></h2>
                </div>
                <div class="row3 row">
                        <div class="details col">
                                <h3>Seller:</h3>
                                <p>test</p>
                                <p>test</p>
                                <p>test</p>
                                <p>NIP: test</p>
                        </div>
                        <div class="details col col-p">
                                <h3>Bill to:</h3>
                                <p>test</p>
                                <p>test</p>
                                <p>test</p>
                                <p>---</p>
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
                                        <tr>
                                               <td>ąę</td>
                                               <td>ąę</td>
                                               <td>ąę</td>
                                               <td>ąę</td>
                                               <td>ąę</td>
                                               <td>ąę</td>
                                               <td>ąę</td>
                                               <td>ąę</td>
                                        </tr>
                                        <tr>
                                               <td>test</td>
                                               <td>test</td>
                                               <td>test</td>
                                               <td>test</td>
                                               <td>test</td>
                                               <td>test</td>
                                               <td>test</td>
                                               <td>test</td>
                                        </tr>
                                        <tr>
                                               <td>test</td>
                                               <td>test</td>
                                               <td>test</td>
                                               <td>test</td>
                                               <td>test</td>
                                               <td>test</td>
                                               <td>test</td>
                                               <td>test</td>
                                        </tr>
                                </tbody>
                                <tfoot>
                                        <tr>
                                                <td colspan="4"></td>
                                                <td>TOTAL:</td>
                                                <td></td>
                                                <td>0,00 PLN</td>
                                                <td>0,00 PLN</td>
                                        </tr>
                                </tfoot>
                        </table>
                </div>
                <div class="row5 row">
                        <p><b>To pay: </b>100,56 PLN</p>
                        <p><b>In words: </b>one hundred 56/100 PLN </p>
                </div>
                <div class="row6 row">            
                        <div class="notes col">
                                <h3>Additional notes</h3>
                                <p class="comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat quo veritatis illo blanditiis saepe maiores iusto fugit cupiditate, modi ipsam, obcaecati voluptas quidem magnam! Similique ipsam doloremque corrupti necessitatibus sunt!</pre>
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
$dompdf->stream('filename.pdf', [
        'compress' => true,
        'Attachment' => false, // 'Attachment' => false is only for testing. After test change to 'Attachment' => true
]);