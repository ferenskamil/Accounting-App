<?php

function send_invoice_in_email(array $user , array $invoice , array $email_details) : void
{
    // Get object with initial settings
    require_once __DIR__ . '/phpmailer_config.php';
    $phpmailer = generate_phpmailer($email_details);

    // Get html code and alt text
    require_once __DIR__ . '/email_template.php';
    $html = generate_email_html($user , $invoice , $email_details);
    $alt = generate_email_alt_text($user , $invoice , $email_details);

    // Render pdf
    require_once __DIR__ . '/../dompdf/render_invoice_pdf.php';
    render_invoice_pdf($user, $invoice , 'render');

    // Get filename for new pdf file.
    require_once __DIR__ . '/../dompdf/generate_filename.php';
    $filename = generate_pdf_filename ($user , $invoice);

    /* ATTACHMENTS
     * ->addAttachment('path', 'filename')     - add attachment (filename is optional) */
    $phpmailer->addAttachment('../../assets/generated_pdf/' . $filename);
    $phpmailer->addEmbeddedImage('../../assets/user_img/logos/default_logo.png', 'logoimg');

    /* CONTENT
     * ->isHTML(true);         - inform that we will want to send email as html
     * ->Charset               - set charset
     * ->Subject               - message subject
     * ->Body                  - message body (html)
     * ->AltBody               - message body in plain text (for non-HTML mail clients)
     * or:
     * ->msgHTML('path')       - attach external html file */
    $phpmailer->isHTML(true);
    $phpmailer->CharSet = 'UTF-8';
    $phpmailer->Subject = $email_details['subject'];
    $phpmailer->Body    = $html;
    $phpmailer->AltBody = $alt;

    /* SEND MESSAGE
     * Send email after configuration */
    $phpmailer->send();

    /* DELETE PDF FILE FROM SERVER
     */
    // Get filename for created pdf file.
    require_once __DIR__ . '/../dompdf/generate_filename.php';
    $filename = generate_pdf_filename ($user , $invoice);
    unlink(__DIR__ . '/../../assets/generated_pdf/' . $filename);
}
