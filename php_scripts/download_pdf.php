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



// - - - - - - - - - 
// GENERATE PDF

$dompdf->loadHtml('<div><img src="'.$logo_img_path.'" alt="test"></div>');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('filename.pdf', [
        'compress' => true,
        'Attachment' => false, // 'Attachment' => false is only for testing. After test change to 'Attachment' => true
]);