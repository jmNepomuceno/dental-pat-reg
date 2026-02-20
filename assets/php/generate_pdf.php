<?php
require_once __DIR__ . '/../../vendor/autoload.php';
$dohLogo = __DIR__ . '/../../source/landing_img/tcp_DOH.jpg';
$bghmcLogo = __DIR__ . '/../../source/landing_img/tcp_BGHMC.jpg';

// if (!file_exists($dohLogo)) die("DOH Logo not found!");
// if (!file_exists($bghmcLogo)) die("BGHMC Logo not found!");

// Helper for safe input
function val($key) {
    return htmlspecialchars($_POST[$key] ?? '', ENT_QUOTES, 'UTF-8');
}

$medHistory = $_POST['medHistory'] ?? []; // get array safely
$medHistoryData = [];

foreach ($medHistory as $item) {
    if (isset($item['condition'])) {
        $medHistoryData[$item['condition']] = $item;
    }
}


$dietary = $_POST['dietary'] ?? [];
$dietaryData = [];

foreach ($dietary as $item) {
    if (isset($item['condition'])) {
        $dietaryData[$item['condition']] = $item;
    }
}

$oralCheck   = $_POST['oralCheck2D']   ?? [];
$oralNumbers = $_POST['oralNumbers2D'] ?? [];

$oralCheck   = isset($_POST['oralCheck2D']) 
    ? json_decode($_POST['oralCheck2D'], true) 
    : [];

$oralNumbers = isset($_POST['oralNumbers2D']) 
    ? json_decode($_POST['oralNumbers2D'], true) 
    : [];



/* ===== Section A rows ===== */
$conditions = [
    'Date of Oral Examination',
    'Orally Fit Child (OFC)',
    'Dental Caries',
    'Gingivitis',
    'Periodontal Disease',
    'Debris',
    'Calculus',
    'Abnormal Growth',
    'Cleft Lip / Palate',
    'Others (supernumerary / mesiodens, malocclusion, etc.)'
];

$oralCheckRows = '';

foreach ($conditions as $rowIndex => $label) {

    $oralCheckRows .= '<tr>';
    $oralCheckRows .= '<td>'.$label.'</td>';

    for ($c = 0; $c < 5; $c++) {

        $value = $oralCheck[$rowIndex][$c] ?? '';

        if (is_bool($value)) {
            $value = $value ? '✔' : '✖';
        }

        $oralCheckRows .= '<td>'.$value.'</td>';
    }

    $oralCheckRows .= '</tr>';
}




/* ===== Section B rows ===== */
$indicators = [
    'No. of Permanent Teeth Present',
    'No. of Permanent Sound Teeth',
    'No. of Decayed Teeth (D)',
    'No. of Missing Teeth (M)',
    'No. of Filled Teeth (F)',
    'Total DMF Teeth',
    'No. of Temporary Teeth Present',
    'No. of Temporary Sound Teeth',
    'No. of Decayed Teeth (d)',
    'No. of Filled Teeth (f)',
    'Total df Teeth'
];



$oralNumberRows = '';

foreach ($indicators as $rowIndex => $label) {

    $oralNumberRows .= '<tr>';
    $oralNumberRows .= '<td>'.$label.'</td>';

    for ($c = 0; $c < 5; $c++) {

        $value = $oralNumbers[$rowIndex][$c] ?? '';
        $oralNumberRows .= '<td>'.$value.'</td>';
    }

    $oralNumberRows .= '</tr>';
}


function checked($array, $value) {
    return isset($array[$value]) ? "☑" : "☐";
}

function checked_dietary($array, $condition) {
    return isset($array[$condition]) ? "☑" : "☐";
}



// Create PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('BGHMC System');
$pdf->SetAuthor('BGHMC');
$pdf->SetTitle('Individual Patient Treatment Record');

$pdf->SetFont('dejavusans', '', 9);


$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

// Coordinates
$xLeftLogo  = 15;  // X position of left logo
$yLogo      = 13;  // Y position for both logos
$logoWidth  = 15;  // width of logo
$logoHeight = 15;  // height of logo

// Add left logo
$pdf->Image($dohLogo, $xLeftLogo, $yLogo, $logoWidth, $logoHeight);

// Add right logo
$xRightLogo = 170;
$pdf->Image($bghmcLogo, $xRightLogo, $yLogo, $logoWidth, $logoHeight);

// HTML Layout
$html = '
    <style>
        body { font-size: 10pt; font-family: helvetica; }
        h2, h3 { margin: 2px 0; }
        table { border-collapse: collapse; }

        .header-border {
            border-bottom: 2px solid #000;
            margin-bottom: 10px;
        }

        .card {
            border: 1px solid #000;
            padding: 8px;
            margin-bottom: 12px;
        }

        .card-title {
            font-weight: bold;
            border-bottom: 1px solid #000;
            margin-bottom: 6px;
            padding-bottom: 3px;
        }

        .label { font-size: 9pt; font-weight: bold; }
        .value { font-size: 10pt; }

        .oral-health-table th,
        .oral-health-table td {
            font-size: 8pt;
            line-height: 1.2;
            padding: 3px 4px;
        }

        .card-membership {
            padding: 2px;
            margin-bottom: 4px;
            font-size: 9pt;
        }

        .card-medical-dietary {
            border: 1px solid #000;
            padding: 4px 6px;
            margin-bottom: 4px;
            font-size: 9pt;
        }

        #dcc-form{
            width:100%;
            text-align:right;
            font-weight:bold;
        }
    </style>

    <!-- HEADER -->
    <table width="100%" class="header-border">
    <tr>
    <td width="15%"><img src="' . $dohLogo . '"></td>
    <td width="70%" align="center">
    <span style="font-size:8pt;">Republic of the Philippines</span><br>
    <span style="font-size:8pt;">Department of Health</span><br>
    <span style="font-size:8pt;">Center for Health Development III</span><br>
    <span style="font-size:11pt; font-weight:bold;">BGHMC BATAAN</span><br>
    <span style="font-size:9pt;">Individual Patient Treatment Record</span>
    </td>
    <td width="15%" align="center"><img src="' . $bghmcLogo . '"></td>
    </tr>
    </table>

    <br>

    <!-- I. BASIC INFORMATION -->
    <div class="card">
        <div class="card-title">I. Basic Patient Information</div>

        <table width="100%" cellpadding="4">
            <tr>
                <td width="33%">
                    <span class="label">Surname</span><br>
                    <span class="value">' . val('surname') . '</span>
                </td>
                <td width="33%">
                    <span class="label">First Name</span><br>
                    <span class="value">' . val('firstName') . '</span>
                </td>
                <td width="34%">
                    <span class="label">Middle Initial</span><br>
                    <span class="value">' . val('middleInitial') . '</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Date of Birth</span><br>
                    <span class="value">' . val('dob') . '</span>
                </td>
                <td>
                    <span class="label">Age</span><br>
                    <span class="value">' . val('age') . '</span>
                </td>
                <td>
                    <span class="label">Sex</span><br>
                    <span class="value">' . val('sex') . '</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Place of Birth</span><br>
                    <span class="value">' . val('placeOfBirth') . '</span>
                </td>

                <td>
                    <span class="label">Address</span><br>
                    <span class="value">' . val('address') . '</span>
                </td>

                <td>
                    <span class="label">Occupation</span><br>
                    <span class="value">' . val('occupation') . '</span>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <span class="label">Parent / Guardian</span><br>
                    <span class="value">' . val('parentGuardian') . '</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- II. MEMBERSHIP -->
    <div class="card card-membership">
        <div class="card-title">II. Other Patient Information (Membership)</div>

        <p id="membership-paragraph">
            ' . ($_POST['nhts'] === 'true' ? '☑' : '☐') . ' NHTS-PR &nbsp;&nbsp;
            ' . ($_POST['p4ps'] === 'true' ? '☑' : '☐') . ' 4Ps &nbsp;&nbsp;
            ' . ($_POST['ip'] === 'true' ? '☑' : '☐') . ' Indigenous People (IP) &nbsp;&nbsp;
            ' . ($_POST['pwd'] === 'true' ? '☑' : '☐') . ' PWD
        </p>


        <table width="100%">
            <tr>
                <td width="33%">
                    <span class="label">PhilHealth No.</span><br>
                    <span class="value">' . val('philhealth') . '</span>
                </td>
                <td width="33%">
                    <span class="label">SSS No.</span><br>
                    <span class="value">' . val('sss') . '</span>
                </td>
                <td width="34%">
                    <span class="label">GSIS No.</span><br>
                    <span class="value">' . val('gsis') . '</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- III. VITAL SIGNS -->
    <div class="card">
        <div class="card-title">III. Vital Signs</div>

        <table width="100%" cellpadding="4">
        <tr>
            <td width="25%"><b>Blood Pressure</b><br>' . val('bp') . '</td>
            <td width="25%"><b>Pulse Rate</b><br>' . val('pulse') . '</td>
            <td width="25%"><b>Temperature</b><br>' . val('temp') . '</td>
            <td width="25%"><b>Weight</b><br>' . val('weight') . '</td>
        </tr>
        </table>
    </div>

    <!-- IV. MEDICAL HISTORY -->
    <div class="card card-medical-dietary">
        <div class="card-title">IV. Medical History</div>
        <p>
            '. checked($medHistoryData, "allergies") .' Allergies 
                '. (!empty($medHistoryData["allergies"]["allergies_specify"]) 
                    ? " - ".$medHistoryData["allergies"]["allergies_specify"] 
                    : "") .'<br>

            '. checked($medHistoryData, "hypertension") .' Hypertension / CVA<br>

            '. checked($medHistoryData, "diabetes") .' Diabetes Mellitus<br>

            '. checked($medHistoryData, "blood_disorders") .' Blood Disorders<br>

            '. checked($medHistoryData, "heart_disease") .' Cardiovascular Diseases<br>

            '. checked($medHistoryData, "thyroid") .' Thyroid Disorders<br>

            '. checked($medHistoryData, "hepatitis") .' Hepatitis
                '. (!empty($medHistoryData["hepatitis"]["hepatitis_type"]) 
                    ? " - ".$medHistoryData["hepatitis"]["hepatitis_type"] 
                    : "") .'<br>

            '. checked($medHistoryData, "malignancy") .' Malignancy
                '. (!empty($medHistoryData["malignancy"]["malignancy_specify"]) 
                    ? " - ".$medHistoryData["malignancy"]["malignancy_specify"] 
                    : "") .'<br>

            '. checked($medHistoryData, "hospitalization") .' History of Previous Hospitalization
                '. (!empty($medHistoryData["hospitalization"]["hospital_medical"]) 
                    ? "<br>&nbsp;&nbsp;Medical: ".$medHistoryData["hospitalization"]["hospital_medical"] 
                    : "") .'
                '. (!empty($medHistoryData["hospitalization"]["hospital_surgical"]) 
                    ? "<br>&nbsp;&nbsp;Surgical: ".$medHistoryData["hospitalization"]["hospital_surgical"] 
                    : "") .'<br>

            '. checked($medHistoryData, "blood_transfusion") .' Blood Transfusion
                '. (!empty($medHistoryData["blood_transfusion"]["blood_transfusion_date"]) 
                    ? " - ".$medHistoryData["blood_transfusion"]["blood_transfusion_date"] 
                    : "") .'<br>

            '. checked($medHistoryData, "tattoo") .' Tattoo<br>

            '. checked($medHistoryData, "others") .' Others
                '. (!empty($medHistoryData["others"]["others_medical"]) 
                    ? " - ".$medHistoryData["others"]["others_medical"] 
                    : "") .'
        </p>

    </div>

    <!-- V. DIETARY HABITS / SOCIAL HISTORY -->
    <div class="card card-medical-dietary card-dietary" style="page-break-inside: avoid;">
        <div class="card-title">V. Dietary Habits / Social History</div>

        <p>
            '. checked_dietary($dietaryData, "sugar") .' Sugar Sweetened Beverages / Food
                '. (!empty($dietaryData["sugar"]["sugar_details"]) 
                    ? " - ".$dietaryData["sugar"]["sugar_details"] 
                    : "") .'<br>

            '. checked_dietary($dietaryData, "alcohol") .' Use of Alcohol
                '. (!empty($dietaryData["alcohol"]["alcohol_details"]) 
                    ? " - ".$dietaryData["alcohol"]["alcohol_details"] 
                    : "") .'<br>

            '. checked_dietary($dietaryData, "tobacco") .' Use of Tobacco
                '. (!empty($dietaryData["tobacco"]["tobacco_details"]) 
                    ? " - ".$dietaryData["tobacco"]["tobacco_details"] 
                    : "") .'<br>

            '. checked_dietary($dietaryData, "betel") .' Betel Nut Chewing
                '. (!empty($dietaryData["betel"]["betel_details"]) 
                    ? " - ".$dietaryData["betel"]["betel_details"] 
                    : "") .'
        </p>
    </div>

    ';

    $pdf->writeHTML($html, true, false, true, false, '');
    // ================= PUSH SECTION VI DOWN =================
    $pdf->Ln(15);   // 🔥 15mm ≈ 50px spacing


    // ================= SECTION VI ONLY =================
    $html2 = '

    <!-- VI. ORAL HEALTH CONDITION -->
    <div class="card oral-health-div">
        <div class="card-title">
            VI. Oral Health Condition <br>
            <b>A. Check (✔) if Present, (✖) if Absent</b>
        </div>

        <table width="100%" border="1" cellpadding="4" class="table oral-health-table">
            <colgroup>
                <col width="40%">
                <col width="12%">
                <col width="12%">
                <col width="12%">
                <col width="12%">
                <col width="12%">
            </colgroup>

            <tr>
                <th>Condition</th>
                <th></th><th></th><th></th><th></th><th></th>
            </tr>

            '.$oralCheckRows.'
        </table>
    </div>

    <div class="card">
        <div class="card-title">B. Indicate Number</div>

        <table width="100%" border="1" cellpadding="4" class="table oral-health-table">
            <colgroup>
                <col width="40%">
                <col width="12%">
                <col width="12%">
                <col width="12%">
                <col width="12%">
                <col width="12%">
            </colgroup>

            <tr>
                <th>Indicator</th>
                <th></th><th></th><th></th><th></th><th></th>
            </tr>

            '.$oralNumberRows.'
        </table>
    </div>

    <table width="100%">
        <tr>
            <td align="right"><b>DEN-F-10-00</b></td>
        </tr>
    </table>

';

$pdf->writeHTML($html2, true, false, true, false, '');
$pdf->Output('patient_record.pdf', 'I');

