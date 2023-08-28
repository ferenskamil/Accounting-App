<?php

require __DIR__ . '/../../vendor/autoload.php';
use Dompdf\Dompdf;

/* A function that returns an instance of the Dompdf class with
 * the initial settings of the generated pdf file. */
function generate_dompdf($html , $logo_img_path) : object
{
// Instantiate and use the dompdf class
        $tmp = sys_get_temp_dir();
        $dompdf = new Dompdf([
                'logOutputFile' => '',
                // Authorize DomPdf to download fonts and other Internet assets
                'isRemoteEnabled' => true,
                // All directories must exist and not end with /
                'fontDir' => $tmp,
                'fontCache' => $tmp,
                'tempDir' => $tmp,
                'chroot' => $tmp,
            ]);

        // Initial settings.
        $dompdf->loadHtml($html);
        $dompdf->getOptions()->setChroot("$logo_img_path");
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Return object.
        return $dompdf;
}