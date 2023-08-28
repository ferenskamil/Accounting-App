<?php
/* This function retrurn html code of email with invoice
 */
function generate_email_html(array $user, array $invoice , array $email_details) : string
{
        $html = <<<HTML
        <!DOCTYPE html>
        <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Mail Message</title>

            </head>

            <body>
                <main>
                        <div class="content" style="width: 100%;max-width: 480px;margin: 0 auto;color: #000000;">
                            <div class=" content__message" style="padding: 10px;">
                                <img src="cid:logoimg" alt="logo" style="height: 50px; margin: 10px 0">
                                <h1 style="margin-top: 0">Hello!</h1>
                                <p>User <b>{$user['company']}</b> has just issued you an invoice No. <b>{$invoice['no']}</b> for its
                                        services.</p>
                                <p>Pay it according to the deadline or contact the <b>{$user['company']}</b> for clarification.
                                </p>
                                <p>An invoice is attached to this message as pdf file.</p>
                        </div>
                        <div class="content__footer" style="padding: 10px;background-color: #f7f7f7;">
                                <p style="margin: 0;font-size: 11px;color: #88898c;">This message was sent to <span class="recipient__mail" style="text-decoration: underline;color: #003147;">{$email_details['recipient_mail']}</span>. If you have
                                        questions or complaints, please <b>contact us</b>.</p>
                                <br>
                                <p style="margin: 0;font-size: 11px;color: #88898c;">Accounting App, Poland. Thank you for using!</p>
                        </div>
                </main>
            </body>

        </html>
        HTML;

        return $html;
}

/* This function return alternative text of email with invoice
 */
function generate_email_alt_text(array $user , array $invoice , array $email_details) : string
{
        $alt = "Hello!\r\n\r\n

        User" . $user['company'] . "has just issued you an invoice No. " . $invoice['no'] . " for its services.\r\n
        Pay it according to the deadline or contact the" . $user['company'] . "for clarification. \r\n\r\n

        An invoice should be attached to this message as pdf file.\r\n
        If the invoice is not attached to this email, please contact us and we will solve the problem as soon as possible. We apologize for the complication. \r\n\r\n

        This message was sent to" . $email_details['recipient_mail'] . ". If it's not you, please ignore it and report it to us.\r\n\r\n

        Accounting App, Poland. Thank you for using!";

        return $alt;
}