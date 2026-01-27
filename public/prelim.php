<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Individual Patient Treatment Record</title>
    <link rel="stylesheet" href="../assets/css/prelim.css">
    <!-- <link rel="stylesheet" href="../assets/css/sidebar.css"> -->

    <?php require "../links/header_link.php"; ?>
</head>
<body>
    <div class="page">

        <!-- HEADER -->
        <div class="header">
            <div class="logo-box">
                <img src="../source/landing_img/doh_logo.png" alt="test">
            </div>

            <div class="header-text">
                <p>Republic of the Philippines</p>
                <p>Department of Health</p>
                <p>Center for Health Development III</p>
                <h2>BGHMC BATAAN</h2>
                <h3>Individual Patient Treatment Record</h3>
            </div>

            <div class="logo-box">
                <img src="../source/landing_img/bghmc_logo.png" alt="test">
            </div>
        </div>

        <!-- BASIC INFORMATION -->
        <div class="card">
            <div class="card-title">I. Basic Patient Information</div>

            <div class="form-grid">
                <div>
                    <label>Surname</label>
                    <input type="text">
                </div>
                <div>
                    <label>First Name</label>
                    <input type="text">
                </div>
                <div>
                    <label>Middle Initial</label>
                    <input type="text">
                </div>
                
                <div class="full form-row"> <!-- spans entire form-grid row -->
                    <div>
                        <label>Date of Birth</label>
                        <input type="date">
                    </div>
                    <div>
                        <label>Age</label>
                        <input type="number">
                    </div>
                    <div>
                        <label>Sex</label>
                        <select>
                            <option></option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div>
                        <label>Status</label>
                        <select>
                            <option></option>
                            <option>Single</option>
                            <option>Married</option>
                            <option>Divorce</option>
                            <option>Widowed</option>
                        </select>
                    </div>
                </div>



                <div class="full">
                    <label>Place of Birth</label>
                    <input type="text">
                </div>

                <div class="full">
                    <label>Address</label>
                    <input type="text">
                </div>

                <div class="full">
                    <label>Occupation</label>
                    <input type="text">
                </div>

                <div class="full">
                    <label>Parent / Guardian</label>
                    <input type="text">
                </div>
            </div>
        </div>

        <!-- MEMBERSHIP -->
        <div class="card">
            <div class="card-title">II. Other Patient Information (Membership)</div>

            <div class="checkbox-row">
                <label><input type="checkbox"> National Household Targeting System - Poverty Reduction (NHTS-PR)</label>
                <label><input type="checkbox"> Pantawid Pamilyang Pilipino Program (4Ps)</label>
                <label><input type="checkbox"> Indigenous People (IP)</label>
                <label><input type="checkbox"> Person With Disabilities (PWDs)</label>
            </div>

            <div class="form-grid">
                <div>
                    <label>PhilHealth (Indicate Number)</label>
                    <input type="text">
                </div>
                <div>
                    <label>SSS (Indicate Number)</label>
                    <input type="text">
                </div>
                <div>
                    <label>GSIS (Indicate Number)</label>
                    <input type="text">
                </div>
            </div>
        </div>

        <!-- VITAL SIGNS -->
        <div class="card">
            <div class="card-title">III. Vital Signs</div>

            <div class="full form-row">
                <div>
                    <label>Blood Pressure</label>
                    <input type="text">
                </div>
                <div>
                    <label>Pulse Rate</label>
                    <input type="text">
                </div>
                <div>
                    <label>Temperature</label>
                    <input type="text">
                </div>
                <div>
                    <label>Weight</label>
                    <input type="text">
                </div>
            </div>
        </div>

        <!-- MEDICAL HISTORY -->
        <div class="card">
            <div class="card-title">IV. Medical History</div>

            <div class="checkbox-column">
                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Allergies</span>
                    <span>(Please Specify) ______________________________</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Hypertension / CVA</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Diabetes Mellitus</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Blood Disorders</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Cardiovascular / Heart Diseases</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Thyroid Disorders</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Hepatitis</span>
                    <span>(Please Specify Type) ______________________________</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Malignancy</span>
                    <span>(Please Specify) ______________________________</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>History of Previous Hospitalization</span>
                    <span>Medical (Last Admission &amp; Cause) ___________</span>
                    <span>Surgical (Post-Operative) ___________</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Blood Transfusion</span>
                    <span>(Month &amp; Year) ______________________________</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Tattoo</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Others</span>
                    <span>(Please Specify) ______________________________</span>
                </div>
            </div>

            <!-- CONFORME -->
            <div class="conforme-section">
                <span class="conforme-label">Conforme</span>
                <span class="conforme-line">_____________________________________________</span>
                <div class="conforme-subtext">
                    Patient’s / Guardian’s Name and Signature
                </div>
            </div>

        </div>

        <!-- V. DIETARY HABITS / SOCIAL HISTORY -->
        <div class="card">
            <div class="card-title">V. Dietary Habits / Social History</div>

            <div class="checkbox-column one-column">
                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Sugar Sweetened Beverages / Food</span>
                    <span>(Amount, Frequency &amp; Duration) ____________________________</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Use of Alcohol</span>
                    <span>(Amount, Frequency &amp; Duration) ____________________________</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Use of Tobacco</span>
                    <span>(Amount, Frequency &amp; Duration) ____________________________</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox">
                    <span>Betel Nut Chewing</span>
                    <span>(Amount, Frequency &amp; Duration) ____________________________</span>
                </div>
            </div>
        </div>

        <!-- ORAL HEALTH -->
        <div class="card">
            <div class="card-title">VI. Oral Health Condition</div>

            <div class="section-subtitle">
                A. Check (✔) if Present, (✖) if Absent
            </div>

            <table class="table oral-health-table">
                <colgroup>
                    <col style="width: 40%">
                    <col style="width: 12%">
                    <col style="width: 12%">
                    <col style="width: 12%">
                    <col style="width: 12%">
                    <col style="width: 12%">
                </colgroup>
                <thead>
                    <tr>
                        <th>Condition</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
            
            <div class="section-subtitle">
                B. Indicate Number
            </div>

            <table class="table oral-health-table">
                <colgroup>
                    <col style="width: 40%">
                    <col style="width: 12%">
                    <col style="width: 12%">
                    <col style="width: 12%">
                    <col style="width: 12%">
                    <col style="width: 12%">
                </colgroup>
                <thead>
                    <tr>
                        <th>Indicator</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>No. of Permanent Teeth Present</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>No. of Permanent Sound Teeth</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>No. of Decayed Teeth (D)</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>No. of Missing Teeth (M)</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>No. of Filled Teeth (F)</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>Total DMF Teeth</td><td></td><td></td><td></td><td></td><td></td></tr>

                    <tr><td>No. of Temporary Teeth Present</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>No. of Temporary Sound Teeth</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>No. of Decayed Teeth (d)</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>No. of Filled Teeth (f)</td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td>Total df Teeth</td><td></td><td></td><td></td><td></td><td></td></tr>
                </tbody>
            </table>

        </div>

        
        <div style="text-align:right; margin-top:20px;">
            <button id="btnGeneratePDF" class="btn-pdf">
                Generate Printable PDF
            </button>
        </div>
    </div>

    <script src="../assets/js/prelim.js"></script>
</body>
</html>
