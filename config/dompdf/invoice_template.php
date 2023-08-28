<?php
/* Function that returns html code of generated invoice with completed data.
 */
function generate_invoice_html(array $invoice, string $logo_img_path) : string
{
        // Prepare the data before entering the html code.
        $services = $invoice['services'];
        foreach ($services as $service) {
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

        // Assign html code to $html variable.
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
                                <p class="footnote">*Fill in if the following   applies to the good            (service).example, subject    exemptions     from tax.</p>
                        </div>
                        <div class="sign col col-p">
                                <p>Signature of authorized person</p>
                        </div>
                </div>
        </div>
    </body>
</html>
HTML;

        // Return html code with specific data.
        return $html;
}