<?php

require 'vendor/autoload.php';

ob_start();
include 'documento_confirmacion.php';
$html = ob_get_clean();


use Dompdf\Dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=> true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('letter');


$dompdf->render();

//adjuntar para el correo

$pdfOutput = $dompdf->output();
$pdfFile = 'Reporte.pdf';
file_put_contents($pdfFile, $pdfOutput);
// $dompdf->stream("Reporte.pdf", array('Attachment'=>'0'));

?>

