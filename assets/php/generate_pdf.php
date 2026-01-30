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
$dietary = $_POST['dietary'] ?? []; // get array safely
$oralCheck   = $_POST['oralCheck']   ?? [];
$oralNumbers = $_POST['oralNumbers'] ?? [];

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
    $oralCheckRows .= '<tr><td>'.$label.'</td>';
    for ($c = 0; $c < 5; $c++) {
        $oralCheckRows .= '<td>'.($oralCheck[$rowIndex][$c] ?? '').'</td>';
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
    $oralNumberRows .= '<tr><td>'.$label.'</td>';
    for ($c = 0; $c < 5; $c++) {
        $oralNumberRows .= '<td>'.($oralNumbers[$rowIndex][$c] ?? '').'</td>';
    }
    $oralNumberRows .= '</tr>';
}

function checked($array, $key) {
    return in_array($key, $array) ? '☑' : '☐';
}

function checked_dietary($value, $array) {
    return in_array($value, $array) ? '☑' : '☐';
}


// Create PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('BGHMC System');
$pdf->SetAuthor('BGHMC');
$pdf->SetTitle('Individual Patient Treatment Record');

$pdf->SetFont('dejavusans', '', 10); // use DejaVu Sans for Unicode

$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

// Coordinates
$xLeftLogo  = 15;  // X position of left logo
$yLogo      = 20;  // Y position for both logos
$logoWidth  = 25;  // width of logo
$logoHeight = 25;  // height of logo

// Add left logo
$pdf->Image($dohLogo, $xLeftLogo, $yLogo, $logoWidth, $logoHeight);

// Add right logo
$xRightLogo = 170;
$pdf->Image($bghmcLogo, $xRightLogo, $yLogo, $logoWidth, $logoHeight);

// HTML Layout
$html = '
    <style>
        body {
            font-size: 10pt;
            font-family: helvetica;
        }

        h2, h3 {
            margin: 2px 0;
        }

        table {
            border-collapse: collapse;
        }

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

        .label {
            font-size: 9pt;
            font-weight: bold;
        }

        .value {
            font-size: 10pt;
        }

         /* ================= ORAL HEALTH TABLES ================= */
        .oral-health-table th,
        .oral-health-table td {
            font-size: 8pt;        /* smaller font */
            line-height: 1.2;     /* tighter line spacing */
            padding: 3px 4px;     /* reduce padding */
        }

        .oral-health-table th:first-child,
        .oral-health-table td:first-child {
            font-size: 8pt;        /* first column label */
            font-weight: normal;   /* optional, not bold */
        }


        .card-membership {
            padding: 2px;             /* smaller padding */
            margin-bottom: 4px;
            font-size: 9pt;           /* shrink text to reduce height */
        }

        .card-membership .card-title {
            font-size: 10pt;
            margin-bottom: 2px;
            padding-bottom: 2px;
        }

        .card-membership p,
        .card-membership table {
            margin: 0;
            padding: 0;
            line-height: 1.0;         /* tight line spacing */
        }

        .card-membership td {
            padding: 1px;             /* tiny padding inside cells */
            line-height: 1.0;
        }

        .card-medical-dietary {
            border: 1px solid #000;
            padding: 4px 6px;       /* smaller padding */
            margin-bottom: 4px;     /* smaller spacing between these cards only */
            font-size: 9pt;         /* smaller font */
        }

        .card-medical-dietary .card-title {
            font-size: 10pt;
            font-weight: bold;
            border-bottom: 1px solid #000;
            margin-bottom: 2px;     /* very compact title spacing */
            padding-bottom: 2px;
        }

        
        .card-medical-dietary p {
            margin: 0;
            padding: 0;
            line-height: 1.0;       /* tighter line spacing */
        }

    </style>

    <!-- HEADER -->
    <table width="100%" class="header-border">
        <tr>
            <td width="15%">
                <img src="' . $dohLogo . '">
            </td>
            <td width="70%" align="center">
                <p>Republic of the Philippines</p>
                <p>Department of Health</p>
                <p>Center for Health Development III</p>
                <h2>BGHMC BATAAN</h2>
                <h3>Individual Patient Treatment Record</h3>
            </td>
            <td width="15%" align="center">
                <img src="' . $bghmcLogo . '">
            </td>
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
            '. checked($medHistory, "allergies") . ' Allergies<br>
            '. checked($medHistory, "hypertension") . ' Hypertension / CVA<br>
            '. checked($medHistory, "diabetes") . ' Diabetes Mellitus<br>
            '. checked($medHistory, "blood_disorder") . ' Blood Disorders<br>
            '. checked($medHistory, "heart") . ' Cardiovascular Diseases<br>
            '. checked($medHistory, "thyroid") . ' Thyroid Disorders<br>
            '. checked($medHistory, "hepatitis") . ' Hepatitis<br>
            '. checked($medHistory, "malignancy") . ' Malignancy
        </p>
    </div>

    <!-- V. DIETARY HABITS / SOCIAL HISTORY -->
    <div class="card card-medical-dietary">
        <div class="card-title">V. Dietary Habits / Social History</div>

        <p>
            '. checked_dietary('sugar', $dietary) . ' Sugar Sweetened Beverages / Food<br>
            '. checked_dietary('alcohol', $dietary) . ' Use of Alcohol<br>
            '. checked_dietary('tobacco', $dietary) . ' Use of Tobacco<br>
            '. checked_dietary('betel', $dietary) . ' Betel Nut Chewing
        </p>
    </div>


    <!-- VI. ORAL HEALTH CONDITION -->
    <div class="card">
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

';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('patient_record.pdf', 'I');

