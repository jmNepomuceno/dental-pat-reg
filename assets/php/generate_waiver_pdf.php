<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$dohLogo   = __DIR__ . '/../../source/landing_img/tcp_DOH.jpg';
$bghmcLogo = __DIR__ . '/../../source/landing_img/tcp_BGHMC.jpg';

// Helper for safe input
function val($key) {
    return htmlspecialchars($_POST[$key] ?? '', ENT_QUOTES, 'UTF-8');
}

// Get conditions array safely
$conditions = $_POST['conditions'] ?? [];

if (!is_array($conditions)) {
    $conditions = [];
}
$conditionList = '';

if (!empty($conditions)) {
    foreach ($conditions as $cond) {
        $conditionList .= '☑ ' . htmlspecialchars($cond) . '<br>';
    }
} else {
    $conditionList = 'None Declared';
}

// Create PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('BGHMC System');
$pdf->SetAuthor('BGHMC');
$pdf->SetTitle('Dental Waiver Form');

$pdf->SetFont('dejavusans', '', 10);
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

// Coordinates
$xLeftLogo  = 15;
$yLogo      = 12;
$logoWidth  = 20;
$logoHeight = 20;

// Logos
$pdf->Image($dohLogo, $xLeftLogo, $yLogo, $logoWidth, $logoHeight);
$pdf->Image($bghmcLogo, 170, $yLogo, $logoWidth, $logoHeight);

// HTML Layout
$html = '
    <style>
        body { font-size: 10pt; font-family: helvetica; }
        .header { text-align: center; }
        .line { border-bottom: 1px solid #000; display: inline-block; width: 60%; }
        .short-line { border-bottom: 1px solid #000; display: inline-block; width: 15%; }
        .question { margin-bottom: 5px; }
        .signature { margin-top: 40px; }
        .signature-block {
            text-align: center;
        }

        .signature-line {
            margin-top: 5px;
        }

        .signature-label {
            margin-top: 3px;
            font-size: 9pt;
        }
    </style>

    <!-- HEADER TABLE -->
    <table width="100%" cellpadding="3">
        <tr>
            <td width="20%" align="left">
                <img src="'.$dohLogo.'" height="50">
            </td>

            <td width="60%" align="center">
                <strong>BATAAN GENERAL HOSPITAL AND MEDICAL CENTER</strong><br>
                Balanga City, Bataan<br>
                <strong>Dental / Medical History at Pahintulot sa Gamutang Pang-Dental</strong>
            </td>

            <td width="20%" align="right">
                <img src="'.$bghmcLogo.'" height="50">
            </td>
        </tr>
    </table>

    <br><br>

    <!-- Patient Info -->
    <table width="100%" cellpadding="3">
        <tr>
            <td width="70%" align="left">
                <strong>Name:</strong>
                <span class="line">'.val("patient_name").'</span>
            </td>
            <td width="30%" align="right">
                <strong>Age:</strong>
                <span class="short-line">'.val("age").'</span>
            </td>
        </tr>
    </table>

    <p>
        <strong>Address:</strong>
        <span class="line">'.val("address").'</span>
    </p>


    <br>

    <!-- Medical and Dental Questions -->
    <strong>Medical and Dental</strong>
    <ol>
        <li class="question">Question #1: '.val("q1").'</li>
        <li class="question">Question #2: '.val("q2").'</li>
        <li class="question">Question #3: '.val("q3").'</li>
        <li class="question">Question #4: '.val("q4").' '.val("gamot_details").'</li>
        <li class="question">Question #5: '.val("q5").' '.val("sakit_details").'</li>
        <li class="question">Question #6: '.val("q6").'</li>
        <li class="question">Question #7: '.val("q7").'</li>
        <li class="question">Question #8: '.val("q8").'</li>
        <li class="question">Question #9: '.val("q9").'</li>
        <li class="question">
            Question #10:<br><br>
            '.(in_array("Hika", $conditions) ? "☑" : "☐").' Hika<br>
            '.(in_array("Alta Presyon", $conditions) ? "☑" : "☐").' Alta Presyon<br>
            '.(in_array("Diabetes", $conditions) ? "☑" : "☐").' Diabetes<br>
            '.(in_array("Paninilaw ng Balat", $conditions) ? "☑" : "☐").' Paninilaw ng Balat<br>
            '.(in_array("Sakit sa Puso", $conditions) ? "☑" : "☐").' Sakit sa Puso<br>
            '.(in_array("Allergy", $conditions) ? "☑" : "☐").' Allergy
        </li>
    </ol>

    <br>

    <!-- Waiver Statement -->
    <p style="text-align: justify;">
    Aking pinatutunayan na lahat ng aking ibinigay na impormasyon tungkol sa aking kondisyon ay totoo.
    Ang aking dentista ay walang pananagutan sa anumang puwedeng mangyari sa akin dahil sa hindi pagsasabi
    o pagsasagot ng totoo tungkol sa aking kalusugan.
    Pinahihintulutan ko ang Dentista na gawin ang kinakailangang pamamaraan
    na may kinalaman sa aking gamutan.
    </p>

    <br><br>

    <table width="100%" cellpadding="5">
        <tr>
            <td width="50%" class="signature-block">
                <div style="margin-bottom:-50px;">'.val("signature_name").'</div>
                <div class="signature-line">_________________________</div>
                <div class="signature-label">Patient / Parent / Guardian</div>
            </td>

            <td width="50%" class="signature-block">
                <div>'.val("date_signed").'</div>
                <div class="signature-line">_________________________</div>
                <div class="signature-label">Date Signed</div>
            </td>
        </tr>

        <tr>
            <td colspan="2" class="signature-block" style="padding-top:25px;">
                <div>'.val("witness_name").'</div>
                <div class="signature-line">_________________________</div>
                <div class="signature-label">Witness</div>
            </td>
        </tr>
    </table>

';



$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('dental_waiver.pdf', 'I');
