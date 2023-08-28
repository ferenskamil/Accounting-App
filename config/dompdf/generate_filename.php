<?php
/* This function returns filename of rendered invoice
 */
function generate_pdf_filename(array $user , array $invoice) : string
{
        $filename = $user['login'] . "_" . str_replace('/', '_', $invoice['no']) . ".pdf";
        return $filename;
}