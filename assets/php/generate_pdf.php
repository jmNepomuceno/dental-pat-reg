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

// Create PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('BGHMC System');
$pdf->SetAuthor('BGHMC');
$pdf->SetTitle('Individual Patient Treatment Record');

$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

// Coordinates
$xLeftLogo  = 10;  // X position of left logo
$yLogo      = 20;  // Y position for both logos
$logoWidth  = 40;  // width of logo
$logoHeight = 40;  // height of logo

// Add left logo
$pdf->Image($dohLogo, $xLeftLogo, $yLogo, $logoWidth, $logoHeight);

// Add right logo
$xRightLogo = 160;
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
            <span class="value">' . val('firstname') . '</span>
        </td>
        <td width="34%">
            <span class="label">Middle Initial</span><br>
            <span class="value">' . val('middle') . '</span>
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
        <td colspan="3">
            <span class="label">Place of Birth</span><br>
            <span class="value">' . val('birthplace') . '</span>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <span class="label">Address</span><br>
            <span class="value">' . val('address') . '</span>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <span class="label">Occupation</span><br>
            <span class="value">' . val('occupation') . '</span>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <span class="label">Parent / Guardian</span><br>
            <span class="value">' . val('guardian') . '</span>
        </td>
    </tr>
    </table>
    </div>

    <!-- II. MEMBERSHIP -->
    <div class="card">
    <div class="card-title">II. Other Patient Information (Membership)</div>

    <p>
    ' . (isset($_POST['nhts']) ? '☑' : '☐') . ' NHTS-PR &nbsp;&nbsp;
    ' . (isset($_POST['fourps']) ? '☑' : '☐') . ' 4Ps &nbsp;&nbsp;
    ' . (isset($_POST['ip']) ? '☑' : '☐') . ' Indigenous People (IP) &nbsp;&nbsp;
    ' . (isset($_POST['pwd']) ? '☑' : '☐') . ' PWD
    </p>

    <table width="100%" cellpadding="4">
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
    <br>
    <br>
    <br>
    <br>
    <div class="card">
    <div class="card-title">IV. Medical History</div>

    <p>
    ' . (isset($_POST['allergies']) ? '☑' : '☐') . ' Allergies<br>
    ' . (isset($_POST['hypertension']) ? '☑' : '☐') . ' Hypertension / CVA<br>
    ' . (isset($_POST['diabetes']) ? '☑' : '☐') . ' Diabetes Mellitus<br>
    ' . (isset($_POST['blood_disorder']) ? '☑' : '☐') . ' Blood Disorders<br>
    ' . (isset($_POST['heart']) ? '☑' : '☐') . ' Cardiovascular Diseases<br>
    ' . (isset($_POST['thyroid']) ? '☑' : '☐') . ' Thyroid Disorders<br>
    ' . (isset($_POST['hepatitis']) ? '☑' : '☐') . ' Hepatitis<br>
    ' . (isset($_POST['malignancy']) ? '☑' : '☐') . ' Malignancy
    </p>
    </div>

    <!-- V. DIETARY HABITS / SOCIAL HISTORY -->
    <div class="card">
    <div class="card-title">V. Dietary Habits / Social History</div>

    <p>
    ' . (isset($_POST['sugar']) ? '☑' : '☐') . ' Sugar Sweetened Beverages / Food<br>
    ' . (isset($_POST['alcohol']) ? '☑' : '☐') . ' Use of Alcohol<br>
    ' . (isset($_POST['tobacco']) ? '☑' : '☐') . ' Use of Tobacco<br>
    ' . (isset($_POST['betel']) ? '☑' : '☐') . ' Betel Nut Chewing
    </p>

    </div>


    <!-- VI. ORAL HEALTH CONDITION -->
    <div class="card">
        <div class="card-title">VI. Oral Health Condition <br> <b>A. Check (✔) if Present, (✖) if Absent</b></div>
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

                <tr><td>Orally Fit Child (OFC)</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>Dental Caries</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>Gingivitis</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>Periodontal Disease</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>Debris</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>Calculus</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>Abnormal Growth</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>Cleft Lip / Palate</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr>
                    <td>Others (supernumerary / mesiodens, malocclusion, etc.)</td>
                    <td></td><td></td><td></td><td></td><td></td>
                </tr>
            </table>

    </div>

    <div class="card">
        <div class="card-title"> B. Indicate Number </div>
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
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>

            <tr>
                <td>No. of Permanent Teeth Present</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>No. of Permanent Sound Teeth</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>No. of Decayed Teeth (D)</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>No. of Missing Teeth (M)</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>No. of Filled Teeth (F)</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>Total DMF Teeth</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>

            <tr>
                <td>No. of Temporary Teeth Present</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>No. of Temporary Sound Teeth</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>No. of Decayed Teeth (d)</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>No. of Filled Teeth (f)</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>Total df Teeth</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
        </table>
    </div>

';



$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('patient_record.pdf', 'I');
