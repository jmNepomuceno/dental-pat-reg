<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Patient Registration Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/pat_register.css">
    <!-- <link rel="stylesheet" href="../assets/css/sidebar.css"> -->

    <?php require "../links/header_link.php"; ?>
</head>
<body>
    <div class="page">
        <div class="container">
            <div class="section">
                <div class="section-header"><i class="fa fa-users"></i> Patient List</div>
                <div class="section-body">
                    <!-- Toolbar -->
                    <div class="toolbar" style="margin-bottom:10px;">
                        <button class="btn success" id="btnAddPatient">Add New Patient</button>
                        <button class="btn secondary" id="btnSearchPatient">Search Patient</button>
                    </div>

                    <!-- DataTable -->
                    <table id="patientTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Patient #</th>
                                <th>Full Name</th>
                                <th>Age</th>
                                <th>Birthdate</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Patient Modal -->
    <div id="modalPatient" class="modal" style="display:none;">
        <div class="modal-content" style="max-width: 70%; margin: 50px auto; background:#fff; padding:10px; border-radius:10px; position:relative;">
            <span class="close-modal" style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:20px;">&times;</span>
            <h3 style="color:var(--green); margin:10px 0 0 10px;">Add New Patient</h3>
            <!-- INSERT YOUR ENTIRE CURRENT FORM HTML HERE -->
            <div class="page">
                <div class="container">
                    <div class="section">
                        <div class="section-header"><i class="fa fa-id-card"></i> Identifiers</div>
                        <div class="section-body grid-single">

                            <div class="form-col identifiers-col">
                                <label for="philID">PhilSys National ID Card Number</label>
                                <input type="text" id="philID" disabled>

                                <label for="philDigitalID">PhilSys Digital National ID Number</label>
                                <input type="number" id="philDigitalID" disabled>

                                <label for="healthRecNo">Health Record #</label>
                                <input type="text" id="healthRecNo" readonly>

                                <label for="oldHealthRecNo">Old Health Record #</label>
                                <input type="number" id="oldHealthRecNo">

                                <label for="seniorNo">Senior Citizen No</label>
                                <input type="number" id="seniorNo" disabled>

                                <label for="mssNo">MSS No</label>
                                <input type="number" id="mssNo">
                            </div>

                        </div>
                    </div>  
                </div>
                <!-- ================= BASIC INFORMATION ================= -->
                <div class="container"> 
                    <div class="section">
                        <div class="section-header"><i class="fa fa-user"></i> Basic Information</div>
                        <div class="section-body grid">

                            <!-- COLUMN 1 -->
                            <div class="form-col">
                                <label for="lastName">Last Name *</label>
                                <input type="text" id="lastName" required>

                                <label for="firstName">First Name *</label>
                                <input type="text" id="firstName" required>

                                <label for="suffix">First Name Suffix</label>
                                <select id="suffix">
                                    <option value="">None</option>
                                    <option value="jr">Jr</option>
                                    <option value="sr">Sr</option>
                                    <option value="iii">III</option>
                                </select>

                                <label for="alias">Alias</label>
                                <input type="text" id="alias">

                                <label for="middleName">Middle Name *</label>
                                <input type="text" id="middleName" required>

                                <label for="dob">Date of Birth *</label>
                                <input type="date" id="dob" required>

                                <label for="sex">Sex *</label>
                                <select id="sex" required>
                                    <option value="">Select</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="I">Intersex</option>
                                </select>

                            </div>

                            <!-- COLUMN 2 -->
                            <div class="form-col">
                                <label for="year">Year</label>
                                <input type="number" id="year" disabled>

                                <label for="month">Month</label>
                                <input type="number" id="month" disabled>

                                <label for="day">Day</label>
                                <input type="number" id="day" disabled>

                                <label for="gender">Gender</label>
                                <select id="gender" name="gender">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Intersex">Intersex</option>
                                </select>

                                <label for="civilStatus">Civil Status *</label>
                                <select id="civilStatus" required>
                                    <option value="">Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Annulled">Annulled</option>
                                    <option value="Common-Law">Common-Law / Live-in</option>
                                </select>

                                <label for="birthPlace">Place of Birth</label>
                                <input type="text" id="birthPlace">

                                <label for="bloodType">Blood Type</label>
                                <select id="bloodType" name="bloodType">
                                    <option value="">Select</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>

                            </div>

                            <!-- COLUMN 3 -->
                            <div class="form-col">
                                

                                <label for="nationality">Nationality</label>
                                <input type="text" id="nationality">

                                <label for="religion">Religion</label>
                                <input type="text" id="religion">

                                <label for="indigenousGroup">Indigenous Group</label>
                                <select id="indigenousGroup"><option>No</option><option>Yes</option></select>

                                <label for="employment">Employment</label>
                                <select id="employment"></select>

                                <label for="education">Education Attainment</label>
                                <select id="education"></select>

                                <label for="occupation">Occupation</label>
                                <input type="text" id="occupation" disabled>

                                <label for="telephone">Telephone</label>
                                <input type="text" id="telephone" disabled>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- ================= DEMOGRAPHIC INFORMATION ================= -->
                <div class="container"> 
                    <div class="section">
                        <div class="section-header"><i class="fa fa-map"></i> Demographic Information</div>
                        <div class="section-body address-grid">

                            <!-- PRESENT ADDRESS -->
                            <div class="card">
                                <h4>Present Address</h4>
                                <div class="form-col">

                                    <label for="presentRegion">Region *</label>
                                    <select id="presentRegion" required></select>

                                    <label for="presentProvince">Province *</label>
                                    <select id="presentProvince" required></select>

                                    <label for="presentCity">City / Municipality *</label>
                                    <select id="presentCity" required></select>

                                    <label for="presentBarangay">Barangay *</label>
                                    <select id="presentBarangay" required></select>

                                    <label for="presentStreet">No./Street *</label>
                                    <input type="text" id="presentStreet" required>

                                    <label for="presentDistrict">District *</label>
                                    <select id="presentDistrict" required></select>

                                    <label for="presentZip">Zip Code *</label>
                                    <input type="number" id="presentZip" required>

                                    <label for="presentCountry">Country *</label>
                                    <select id="presentCountry" required><option>Philippines</option></select>
                                </div>
                            </div>

                            <!-- PERMANENT ADDRESS -->
                            <div class="card">
                                <h4>Permanent Address</h4>
                                <div class="form-col">
                                    <!-- <label>
                                        <input type="checkbox" id="sameAddress"> Same as Present Address
                                    </label> -->
                                    <input type="checkbox" id="sameAddress"> Same as Present Address

                                    <label for="permRegion">Region *</label>
                                    <select id="permRegion" required></select>

                                    <label for="permProvince">Province *</label>
                                    <select id="permProvince" required></select>

                                    <label for="permCity">City / Municipality *</label>
                                    <select id="permCity" required></select>

                                    <label for="permBarangay">Barangay *</label>
                                    <select id="permBarangay" required></select>

                                    <label for="permStreet">No./Street *</label>
                                    <input type="text" id="permStreet" required>

                                    <label for="permDistrict">District *</label>
                                    <select id="permDistrict" required></select>

                                    <label for="permZip">Zip Code *</label>
                                    <input type="number" id="permZip" required>

                                    <label for="permCountry">Country *</label>
                                    <select id="permCountry" required><option>Philippines</option></select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- ================= FAMILY INFORMATION ================= -->
                <div class="container"> 
                    <div class="section">
                        <div class="section-header"><i class="fa fa-users"></i> Family Information</div>
                        <div class="section-body family-grid">

                            <!-- SPOUSE -->
                            <div class="card">
                                <h4>Spouse</h4>
                                <div class="form-col">
                                    <label for="spouse_lastName">Last Name</label>
                                    <input type="text" id="spouse_lastName">

                                    <label for="spouse_firstName">First Name</label>
                                    <input type="text" id="spouse_firstName">

                                    <label for="spouse_middleName">Middle Name</label>
                                    <input type="text" id="spouse_middleName">

                                    <label for="spouse_address">Address</label>
                                    <input type="text" id="spouse_address">

                                    <label for="spouse_mobile">Mobile / Tel</label>
                                    <input type="text" type="number" id="spouse_mobile">

                                    <label for="spouse_contact">Contact</label>
                                    <input type="text" type="number" id="spouse_contact">

                                    <label for="spouse_deceased">Deceased</label>
                                    <select id="spouse_deceased"></select>
                                </div>
                            </div>

                            <!-- FATHER -->
                            <div class="card">
                                <h4>Father</h4>
                                <div class="form-col">
                                    <label for="father_lastName">Last Name</label>
                                    <input type="text" id="father_lastName">

                                    <label for="father_firstName">First Name</label>
                                    <input type="text" id="father_firstName">

                                    <label for="father_middleName">Middle Name</label>
                                    <input type="text" id="father_middleName">

                                    <label for="father_address">Address</label>
                                    <input type="text" id="father_address">

                                    <label for="father_mobile">Mobile / Tel</label>
                                    <input type="text" type="number" id="father_mobile">

                                    <label for="father_contact">Contact</label>
                                    <input type="text" type="number" id="father_contact">

                                    <label for="father_deceased">Deceased</label>
                                    <select id="father_deceased">
                                        <option value=""></option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    
                                    <label for="father_suffix">Suffix</label>
                                    <select id="father_suffix"></select>
                                </div>
                            </div>

                            <!-- MOTHER -->
                            <div class="card">
                                <h4>Mother (Maiden)</h4>
                                <div class="form-col">
                                    <label for="mother_lastName">Last Name</label>
                                    <input type="text" id="mother_lastName">

                                    <label for="mother_firstName">First Name</label>
                                    <input type="text" id="mother_firstName">

                                    <label for="mother_middleName">Middle Name</label>
                                    <input type="text" id="mother_middleName">

                                    <label for="mother_address">Address</label>
                                    <input type="text" id="mother_address">

                                    <label for="mother_mobile">Mobile / Tel</label>
                                    <input type="text" type="number" id="mother_mobile">

                                    <label for="mother_contact">Contact</label>
                                    <input type="text" type="number" id="mother_contact">

                                    <label for="mother_deceased">Deceased</label>
                                    <select id="mother_deceased">
                                        <option value=""></option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <!-- CONTACT PERSON -->
                            <div class="card">
                                <h4>Contact Person</h4>
                                <div class="form-col">
                                    <label for="contact_name">Contact Name</label>
                                    <input type="text" id="contact_name">

                                    <label for="contact_address">Address</label>
                                    <input type="text" id="contact_address">

                                    <label for="contact_mobile">Mobile / Tel</label>
                                    <input type="text" type="number" id="contact_mobile">

                                    <label for="contact_relation">Relation</label>
                                    <select id="contact_relation"></select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- ================= ACTIONS ================= -->
                <div class="actions">
                    <button type="button" class="btn secondary">Cancel</button>
                    <button type="button" class="btn success" id="btnSavePatient">Save Patient</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/pat_register.js"></script>
</body>
</html>