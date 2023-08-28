<?php
/* This function completes the pdf rendering process, depending on the value of the $action parameter.
 */
function render_invoice_pdf(array $user , array $invoice , ?string $action = 'display') : void
{
        // Generate html code of invoice
        require_once __DIR__ . '/invoice_template.php';
        $logo_file_path = __DIR__ . "/../../assets/user_img/logos/{$user['logo']}";
        $html = generate_invoice_html($invoice, $logo_file_path);

        // Get $dompdf object with initial settings.
        require_once __DIR__ . '/dompdf_config.php';
        $dompdf = generate_dompdf($html , $logo_file_path);

        // Get filename for new pdf file.
        require_once __DIR__ . '/generate_filename.php';
        $filename = generate_pdf_filename ($user , $invoice);

        // Perform an action depending on the $action parameter.
        if ($action === 'render')
        {
                $target_path = __DIR__ . '/../../assets/generated_pdf/' . $filename;
                file_put_contents($target_path, $dompdf->output());
        }
        elseif ($action === 'save')
        {
                $dompdf->stream($filename, [
                        'compress' => true,
                        'Attachment' => true,
                    ]);
        }
        else //This is default action = 'display'
        {
                $dompdf->stream($filename, [
                        'compress' => true,
                        'Attachment' => false,
                    ]);
        }
}