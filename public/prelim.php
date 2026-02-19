<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Individual Patient Treatment Record</title>
    <link rel="stylesheet" href="../assets/css/prelim.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">

    <?php require "../links/header_link.php"; ?>
</head>
<body>
    <div class="dashboard-layout"> 

        <?php include("./sidebar.php")?>

        <div class="right-container">

            <!-- Top Action Bar -->
            <div class="content-header">
                <button 
                    class="btn-search-patient"
                    data-bs-toggle="modal"
                    data-bs-target="#searchPatientModal"
                >
                    <i class="bi bi-search"></i>
                    Search Patient
                </button>

            </div>


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
                        <input type="hidden" id="hpatcode" name="hpatcode">
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


                
                <div style="text-align:right; margin-top:20px;" id="pdfActionWrapper">
                    <button id="btnGeneratePDF" class="btn-pdf" style="display:none;">
                        Generate Printable PDF
                    </button>
                    <button id="btnSaveData" class="btn-pdf">
                        Save
                    </button>
                </div>

            </div>
        </div>

    </div>

    <!-- Search Patient Modal -->
    <div class="modal fade" id="searchPatientModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title">
                <i class="bi bi-person-lines-fill me-2"></i>
                Search Patient
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <!-- Search Input -->
                <div class="input-group mb-3">
                    <input 
                        type="text" 
                        class="form-control" 
                        id="patientSearchInput"
                        placeholder="Search by name or patient code..."
                    >
                    <button class="btn btn-primary" id="btnSearchPatient">
                        Search
                    </button>
                </div>

                <!-- Results Area -->
                <div class="search-results">
                <!-- Later we populate this with AJAX -->
                <div class="text-muted text-center py-4">
                    Start typing to search patients...
                </div>
                </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Close
                </button>
            </div>

            </div>
        </div>
    </div>

    <!-- ========================= -->
    <!-- Waiver Modal -->
    <!-- ========================= -->
    <div class="modal fade" id="waiverModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

                <form id="waiverForm">

                    <div class="modal-body" style="font-family: 'Times New Roman', serif; font-size: 15px;">

                        <!-- Header with Logos -->
                        <div class="d-flex align-items-center justify-content-center mb-3">

                            <!-- Left Logo -->
                            <img src="../source/landing_img/doh_logo.png"
                                alt="Hospital Logo"
                                style="height:70px; margin-right:15px;">

                            <!-- Center Text -->
                            <div class="text-center">
                                <h5 class="fw-bold mb-0">BATAAN GENERAL HOSPITAL AND MEDICAL CENTER</h5>
                                <small>Balanga City, Bataan</small><br>
                                <strong>Dental / Medical History at Pahintulot sa Gamutang Pang-Dental</strong>
                            </div>

                            <!-- Right Logo -->
                            <img src="../source/landing_img/bghmc_logo.png"
                                alt="DOH Logo"
                                style="height:70px; margin-left:15px;">

                        </div>


                        <hr>

                        <!-- Patient Info -->
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>PANGALAN:</strong>
                                <span id="waiverPatientName" class="ms-2 border-bottom d-inline-block w-75"></span>
                            </div>
                            <div class="col-md-6">
                                <strong>EDAD:</strong>
                                <span id="waiverAge" class="ms-2 border-bottom d-inline-block w-50"></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <strong>ADDRESS:</strong>
                            <span id="waiverAddress" class="ms-2 border-bottom d-inline-block w-75"></span>
                        </div>

                        <hr>

                        <!-- Medical Questions -->
                        <div style="max-height:350px; overflow-y:auto;">

                            <ol class="ps-3">

                                <!-- YES / NO QUESTIONS -->
                                <li class="mb-3">
                                    Nakapagpabunot ka na ba ng ngipin dati?
                                    <div>
                                        <label><input type="radio" name="q1" value="Yes" required> Yes</label>
                                        <label class="ms-3"><input type="radio" name="q1" value="No"> No</label>
                                    </div>
                                </li>

                                <li class="mb-3">
                                    Nakaranas ka ba ng kakaibang reaksyon dulot ng pampamanhid ng ngipin?
                                    <div>
                                        <label><input type="radio" name="q2" value="Yes" required> Yes</label>
                                        <label class="ms-3"><input type="radio" name="q2" value="No"> No</label>
                                    </div>
                                </li>

                                <li class="mb-3">
                                    Matagal ba ang pagdurugo kapag ikaw ay nasusugatan?
                                    <div>
                                        <label><input type="radio" name="q3" value="Yes" required> Yes</label>
                                        <label class="ms-3"><input type="radio" name="q3" value="No"> No</label>
                                    </div>
                                </li>

                                <li class="mb-3">
                                    Ikaw ba ay ginagamot ng doktor sa anumang sakit?
                                    <div>
                                        <label><input type="radio" name="q4" value="Yes" required> Yes</label>
                                        <label class="ms-3"><input type="radio" name="q4" value="No"> No</label>
                                    </div>
                                    <input type="text" name="gamot_details" class="form-control mt-2"
                                        placeholder="If Yes, please specify">
                                </li>

                                <li class="mb-3">
                                    Meron ka bang iniinom na gamot sa kasalukuyan?
                                    <div>
                                        <label><input type="radio" name="q5" value="Yes" required> Yes</label>
                                        <label class="ms-3"><input type="radio" name="q5" value="No"> No</label>
                                    </div>
                                    <input type="text" name="sakit_details" class="form-control mt-2"
                                        placeholder="If Yes, please specify">
                                </li>

                                <li class="mb-3">
                                    Naospital ka na ba?
                                    <div>
                                        <label><input type="radio" name="q6" value="Yes" required> Yes</label>
                                        <label class="ms-3"><input type="radio" name="q6" value="No"> No</label>
                                    </div>
                                </li>

                                <li class="mb-3">
                                    Naoperahan ka na ba?
                                    <div>
                                        <label><input type="radio" name="q7" value="Yes" required> Yes</label>
                                        <label class="ms-3"><input type="radio" name="q7" value="No"> No</label>
                                    </div>
                                </li>

                                <li class="mb-3">
                                    Nasalinan ka na ba ng dugo?
                                    <div>
                                        <label><input type="radio" name="q8" value="Yes" required> Yes</label>
                                        <label class="ms-3"><input type="radio" name="q8" value="No"> No</label>
                                    </div>
                                </li>

                                <li class="mb-3">
                                    Ikaw ba ay nagbubuntis?
                                    <div>
                                        <label><input type="radio" name="q9" value="Yes" required> Yes</label>
                                        <label class="ms-3"><input type="radio" name="q9" value="No"> No</label>
                                    </div>
                                </li>

                                <!-- CONDITION CHECKBOXES -->
                                <li class="mb-4">
                                    <div class="fw-semibold mb-2">
                                        Ikaw ba ay may sakit na sumusunod?
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Hika" id="condHika">
                                                <label class="form-check-label" for="condHika">Hika</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Alta Presyon" id="condAlta">
                                                <label class="form-check-label" for="condAlta">Alta Presyon</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Diabetes" id="condDiabetes">
                                                <label class="form-check-label" for="condDiabetes">Diabetes</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Paninilaw ng Balat" id="condPaninilaw">
                                                <label class="form-check-label" for="condPaninilaw">Paninilaw ng Balat</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Sakit sa Puso" id="condPuso">
                                                <label class="form-check-label" for="condPuso">Sakit sa Puso</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Allergy" id="condAllergy">
                                                <label class="form-check-label" for="condAllergy">Allergy</label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>

                        </div>

                        <hr>

                        <!-- Consent Paragraph -->
                        <p style="text-align: justify;">
                            Aking pinatutunayan na lahat ng aking ibinigay na impormasyon tungkol sa aking kondisyon ay totoo.
                            Ang aking dentista ay walang pananagutan sa anumang puwedeng mangyari sa akin dahil sa hindi pagsasabi o pagsasagot ng totoo tungkol sa aking kalusugan.
                            Pinahihintulutan ko ang Dentista na gawin ang kinakailangang pamamaraan na may kinalaman sa aking gamutan.
                        </p>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="" id="waiverAgree">
                            <label class="form-check-label" for="waiverAgree">
                                I have read and agree to the waiver terms.
                            </label>
                        </div>


                        <!-- Signature Section -->
                      <div class="mt-5 text-center">

                        <!-- Top Row -->
                        <div class="row justify-content-center mb-4">
                            <div class="col-md-5 text-center">
                                <input type="text" name="signature_name"
                                    class="form-control border-0 border-bottom text-center"
                                    required>
                                <small class="fw-semibold">Patient / Parent / Guardian</small>
                            </div>

                            <div class="col-md-5 text-center">
                                <input type="date" name="date_signed"
                                    class="form-control border-0 border-bottom text-center"
                                    required>
                                <small class="fw-semibold">Date Signed</small>
                            </div>
                        </div>

                        <!-- Witness Centered -->
                        <div class="row justify-content-center">
                            <div class="col-md-5 text-center">
                                <input type="text" name="witness_name"
                                    class="form-control border-0 border-bottom text-center"
                                    required>
                                <small class="fw-semibold">Witness</small>
                            </div>
                        </div>

                    </div>


                        <!-- Hidden -->
                        <input type="hidden" name="patient_id" id="waiverPatientId">

                        <input type="hidden" name="waiverHpatcode" id="waiverHpatcode">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" id="btnSaveWaiver" class="btn btn-success">
                            Save and Generate PDF
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="saveSuccessModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Saved</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center" id="saveSuccessMessage">
                    Data saved successfully.<br><br>
                    Please Proceed to Waiver.
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="button" class="btn btn-warning" id="btnOpenWaiver">
                        Complete Waiver
                    </button>

                    <button type="button" class="btn btn-success d-none" id="btnGenerateAfterWaiver">
                        Generate PDF Treatment Record
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/prelim.js"></script>
</body>
</html>
