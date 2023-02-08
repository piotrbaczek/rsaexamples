<?php

require_once '../TCPDF/tcpdf.php';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->AddPage();
// Set some content to print
$html = 'costam';

$certificate = 'file://' . __DIR__ . '/../rsa/cert.crt';
$privatekey = 'file://' . __DIR__ . '/../rsa/private.pem';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// set additional information
$info = array(
	'Name' => 'Test',
	'Location' => 'Infinite Loop 1, California, USA',
	'Reason' => '',
	'ContactInfo' => 'http://www.test.com',
);

// set document signature
$pdf->setSignature($certificate, $privatekey, 'VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg', '', 1, $info);


$string = $pdf->Output('pdf.pdf', 'S');

$output = file_put_contents('pdf.pdf', $string);
