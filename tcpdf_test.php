<?php
require_once __DIR__ . '/vendor/autoload.php';

$dohLogo = __DIR__ . '/source/landing_img/tcp_DOH.jpg';
$bghmcLogo = __DIR__ . '/source/landing_img/tcp_BGHMC.jpg';

if (!file_exists($dohLogo)) die("DOH logo not found!");
if (!file_exists($bghmcLogo)) die("BGHMC logo not found!");

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->Image($dohLogo, 10, 10, 18);
$pdf->Image($bghmcLogo, 182, 10, 18);
$pdf->Output('test.pdf', 'I');

