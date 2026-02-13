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
                    <input type="text" id="surname" name="surname">
                </div>
                <div>
                    <label>First Name</label>
                    <input type="text" id="firstName" name="firstName">
                </div>
                <div>
                    <label>Middle Initial</label>
                    <input type="text" id="middleInitial" name="middleInitial">
                </div>
                
                <div class="full form-row"> 
                    <div>
                        <label>Date of Birth</label>
                        <input type="date" id="dob" name="dob">
                    </div>
                    <div>
                        <label>Age</label>
                        <input type="number" id="age" name="age">
                    </div>
                    <div>
                        <label>Sex</label>
                        <select id="sex" name="sex">
                            <option></option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div>
                        <label>Status</label>
                        <select id="status" name="status">
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
                    <input type="text" id="placeOfBirth" name="placeOfBirth">
                </div>

                <div class="full">
                    <label>Address</label>
                    <input type="text" id="address" name="address">
                </div>

                <div class="full">
                    <label>Occupation</label>
                    <input type="text" id="occupation" name="occupation">
                </div>

                <div class="full">
                    <label>Parent / Guardian</label>
                    <input type="text" id="parentGuardian" name="parentGuardian">
                </div>
            </div>
        </div>

        <!-- MEMBERSHIP -->
        <div class="card">
            <div class="card-title">II. Other Patient Information (Membership)</div>

            <div class="checkbox-row">
                <label><input type="checkbox" id="nhts" name="membership"> National Household Targeting System - Poverty Reduction (NHTS-PR)</label>
                <label><input type="checkbox" id="4ps" name="membership"> Pantawid Pamilyang Pilipino Program (4Ps)</label>
                <label><input type="checkbox" id="ip" name="membership"> Indigenous People (IP)</label>
                <label><input type="checkbox" id="pwd" name="membership"> Person With Disabilities (PWDs)</label>
            </div>

            <div class="form-grid">
                <div>
                    <label>PhilHealth (Indicate Number)</label>
                    <input type="text" id="philhealth" name="philhealth">
                </div>
                <div>
                    <label>SSS (Indicate Number)</label>
                    <input type="text" id="sss" name="sss">
                </div>
                <div>
                    <label>GSIS (Indicate Number)</label>
                    <input type="text" id="gsis" name="gsis">
                </div>
            </div>
        </div>


        <!-- VITAL SIGNS -->
        <div class="card">
            <div class="card-title">III. Vital Signs</div>

            <div class="full form-row">
                <div>
                    <label>Blood Pressure</label>
                    <input type="text" id="bp" name="bp">
                </div>
                <div>
                    <label>Pulse Rate</label>
                    <input type="text" id="pulse" name="pulse">
                </div>
                <div>
                    <label>Temperature</label>
                    <input type="text" id="temp" name="temp">
                </div>
                <div>
                    <label>Weight</label>
                    <input type="text" id="weight" name="weight">
                </div>
            </div>
        </div>

        <!-- MEDICAL HISTORY -->
        <div class="card">
            <div class="card-title">IV. Medical History</div>

            <div class="checkbox-column">
                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox" id="allergies" name="medHistory[]" value="allergies">
                    <span>Allergies</span>
                    <input type="text" name="allergies_specify" class="inline-input" placeholder="Please Specify">
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox" id="htn" name="medHistory[]" value="hypertension">
                    <span>Hypertension / CVA</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox" id="diabetes" name="medHistory[]" value="diabetes">
                    <span>Diabetes Mellitus</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox" id="bloodDisorders" name="medHistory[]" value="blood_disorders">
                    <span>Blood Disorders</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox" id="heart" name="medHistory[]" value="heart_disease">
                    <span>Cardiovascular / Heart Diseases</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox" id="thyroid" name="medHistory[]" value="thyroid">
                    <span>Thyroid Disorders</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox" id="hepatitis" name="medHistory[]" value="hepatitis">
                    <span>Hepatitis</span>
                    <input type="text" name="hepatitis_type" class="inline-input" placeholder="Specify Type">
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox" id="malignancy" name="medHistory[]" value="malignancy">
                    <span>Malignancy</span>
                    <input type="text" name="malignancy_specify" class="inline-input" placeholder="Please Specify">
                </div>

                <div class="checkbox-item hospitalization-item">
                    <!-- First Line -->
                    <div class="checkbox-main-line">
                        <input class="med-history-checkboxes"
                            type="checkbox"
                            id="hospitalization"
                            name="medHistory[]"
                            value="hospitalization">

                        <label for="hospitalization">
                            History of Previous Hospitalization
                        </label>
                    </div>

                    <!-- Sub Fields -->
                    <div class="hospitalization-sub-div">
                        <div class="hospital-line">
                            <span>Medical (Last Admission & Cause)</span>
                            <input type="text"
                                name="hospital_medical"
                                class="inline-input short-inline-input">
                        </div>

                        <div class="hospital-line">
                            <span>Surgical (Post-Operative)</span>
                            <input type="text"
                                name="hospital_surgical"
                                class="inline-input short-inline-input">
                        </div>
                    </div>

                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox" id="bloodTransfusion" name="medHistory[]" value="blood_transfusion">
                    <span>Blood Transfusion</span>
                    <input type="text" name="blood_transfusion_date" class="inline-input" placeholder="Month & Year">
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox" id="tattoo" name="medHistory[]" value="tattoo">
                    <span>Tattoo</span>
                </div>

                <div class="checkbox-item">
                    <input class="med-history-checkboxes" type="checkbox" id="othersMed" name="medHistory[]" value="others">
                    <span>Others</span>
                    <input type="text" name="others_medical" class="inline-input" placeholder="Please Specify">
                </div>

            </div>
        </div>

        <!-- V. DIETARY HABITS / SOCIAL HISTORY -->
        <div class="card">
            <div class="card-title">V. Dietary Habits / Social History</div>

            <div class="checkbox-column one-column">
                <div class="checkbox-item">
                    <input class="dietary-checkbox" type="checkbox" id="sugar" name="dietary[]" value="sugar">
                    <span>Sugar Sweetened Beverages / Food</span>
                    <input type="text" name="sugar_details" class="inline-input" placeholder="Amount, Frequency & Duration">
                </div>

                <div class="checkbox-item">
                    <input class="dietary-checkbox" type="checkbox" id="alcohol" name="dietary[]" value="alcohol">
                    <span>Use of Alcohol</span>
                    <input type="text" name="alcohol_details" class="inline-input" placeholder="Amount, Frequency & Duration">
                </div>

                <div class="checkbox-item">
                    <input class="dietary-checkbox" type="checkbox" id="tobacco" name="dietary[]" value="tobacco">
                    <span>Use of Tobacco</span>
                    <input type="text" name="tobacco_details" class="inline-input" placeholder="Amount, Frequency & Duration">
                </div>

                <div class="checkbox-item">
                    <input class="dietary-checkbox" type="checkbox" id="betel" name="dietary[]" value="betel">
                    <span>Betel Nut Chewing</span>
                    <input type="text" name="betel_details" class="inline-input" placeholder="Amount, Frequency & Duration">
                </div>

            </div>
        </div>

        <!-- ORAL HEALTH -->
        <div class="card">
            <div class="card-title">VI. Oral Health Condition</div>

            <div class="section-subtitle">
                A. Check (✔) if Present, (✖) if Absent
            </div>

            <table class="table oral-health-table" id="ohc-a-table">
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
                    <tr>
                        <td>Date of Oral Examination</td>
                        <td><input type="date"></td>
                        <td><input type="date"></td>
                        <td><input type="date"></td>
                        <td><input type="date"></td>
                        <td><input type="date"></td>
                    </tr>
                    <tr>
                        <td>Orally Fit Child (OFC)</td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Dental Caries</td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Gingivitis</td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Periodontal Disease</td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Debris</td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Calculus</td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Abnormal Growth</td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td></td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <td>Cleft Lip / Palate</td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                        <td>
                            <span><input type="checkbox"> Present</span><br>
                            <span><input type="checkbox"> Absent</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Others (supernumerary / mesiodens, malocclusion, etc.)</td>
                        <td><input type="text" placeholder="Specify"></td>
                        <td><input type="text" placeholder="Specify"></td>
                        <td><input type="text" placeholder="Specify"></td>
                        <td><input type="text" placeholder="Specify"></td>
                        <td><input type="text" placeholder="Specify"></td>
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
                    <tr>
                        <td>No. of Permanent Teeth Present</td>
                        <td>
                            <input type="number">
                        </td>
                        <td>
                            <input type="number">
                        </td>
                        <td>
                            <input type="number">
                        </td>
                        <td>
                            <input type="number">
                        </td>
                        <td>
                            <input type="number">
                        </td>
                    </tr>
                    <tr>
                        <td>No. of Permanent Sound Teeth</td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                    </tr>
                    <tr>
                        <td>No. of Decayed Teeth (D)</td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                    </tr>
                    <tr>
                        <td>o. of Missing Teeth (M)</td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                    </tr>
                    <tr>
                        <td>No. of Filled Teeth (F)</td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                    </tr>
                    <tr>
                        <td>Total DMF Teeth</td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                    </tr>

                    <tr>
                        <td>No. of Temporary Teeth Present</td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                    </tr>
                    <tr>
                        <td>No. of Temporary Sound Teeth</td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                    </tr>
                    <tr>
                        <td>No. of Decayed Teeth (d)</td>
                        <td><input type="text" placeholder="Specify"></td>
                        <td><input type="text" placeholder="Specify"></td>
                        <td><input type="text" placeholder="Specify"></td>
                        <td><input type="text" placeholder="Specify"></td>
                        <td><input type="text" placeholder="Specify"></td>
                    </tr>
                    <tr>
                        <td>No. of Filled Teeth (f)</td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                    </tr>
                    <tr>
                        <td>Total df Teeth</td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                        <td><input type="number"></td>
                    </tr>
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
