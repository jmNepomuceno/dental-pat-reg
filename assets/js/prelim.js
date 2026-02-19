const test = () => {
    // ====== BASIC PATIENT INFO ======
    $('input[name="surname"]').val('Reyes');
    $('input[name="firstName"]').val('Juan');
    $('input[name="middleInitial"]').val('D');
    $('input[type="date"]').val('2015-06-12');
    // $('input[type="number"]').val('10');
    $('select').each(function(){
        if($(this).attr('id') === 'sex') $(this).val('Male');
        if($(this).attr('id') === 'status') $(this).val('Single');
    });
    $('input[name="placeOfBirth"]').val('Balanga, Bataan');
    $('input[name="address"]').val('123 Rizal Street');
    $('input[name="occupation"]').val('Student');
    $('input[name="parentGuardian"]').val('Maria Reyes');

    // ====== MEMBERSHIP ======
    $('.checkbox-row input[type=checkbox]').each(function(index){
        if(index < 2) $(this).prop('checked', true); // check first 2
    });
    $('input[name="philhealth"]').val('1234567890');
    $('input[name="sss"]').val('0987654321');
    $('input[name="gsis"]').val('1122334455');

    // ====== VITAL SIGNS ======
    var vitals = ['120/80 mmHg', '80 bpm', '36.5°C', '32 kg'];
    $('.card:has(.card-title:contains("Vital Signs")) input[type=text]').each(function(i){
        $(this).val(vitals[i]);
    });

    // ====== MEDICAL HISTORY ======
    // Check all checkboxes
    $('.med-history-checkboxes').prop('checked', true);

    // Auto-fill all related text inputs
    $('.checkbox-column input[type="text"]').each(function(){
        $(this).val('Test Data');
    });

    $('.med-history-checkboxes').each(function(){
        if($(this).siblings('span:contains("Please Specify")').length){
            $(this).siblings('span:contains("Please Specify")').text(' Example Data');
        }
    });

    // ====== DIETARY HABITS ======
    $('.checkbox-column.one-column .dietary-checkbox').each(function () {
        // Check the box
        $(this).prop('checked', true);

        // Target the Amount/Frequency span (2nd span)
        $(this)
            .closest('.checkbox-item')
            .find('span').eq(1)
            .text('(2x/day)');
    });


    // ====== ORAL HEALTH ======
    // Section A: Check Present/Absent
    var oralChecks = [
        ['✔','✖'], // Orally Fit Child (OFC)
        ['✔','✖'], // Dental Caries
        ['✔','✖'], // Gingivitis
        ['✔','✖'], // Periodontal Disease
        ['✔','✖'], // Debris
        ['✔','✖'], // Calculus
        ['✔','✖'], // Abnormal Growth
        ['✔','✖'], // Cleft Lip / Palate
        ['','']     // Others, leave blank
    ];

    // Section A table — fill only first column
    $('#ohc-a-table tbody tr').each(function(i){
        if(i === 0){
            $(this).find('td').eq(1).find('input[type="date"]').val('2026-01-27');
            return; // skip date row
        }

        var checks = oralChecks[i-1];
        var $firstTd = $(this).find('td').eq(1); // first column only
        var $inputs = $firstTd.find('input[type="checkbox"]');
        if($inputs.length > 0){
            $inputs.eq(0).prop('checked', checks[0] === '✔');
        }
    });


    // ====== Section B: Indicate Number
    var oralNumbers = [28, 28, 2, 0, 0, 30, 12, 12, 1, 0, 13];

    $('.oral-health-table').last().find('tbody tr').each(function(i){
        var $firstTdInput = $(this).find('td').eq(1).find('input[type="number"]');
        if($firstTdInput.length){
            $firstTdInput.val(oralNumbers[i] || 0);
        }
    });

}

const test2 = () => {
    // ====== PATIENT INFO ======
    $('#waiverPatientName').val('Juan D Reyes');
    $('#waiverAge').val('11'); // example age
    $('#waiverAddress').val('123 Rizal Street, Balanga, Bataan');

    // Hidden patient_id (for backend)
    $('#waiverPatientId').val(13); // set a test patient ID
    $('#waiverHpatcode').val('H-2026-000054'); // if you have this input

    // ====== YES/NO QUESTIONS ======
    // Fill with example answers
    $('input[name="q1"][value="Yes"]').prop('checked', true);
    $('input[name="q2"][value="No"]').prop('checked', true);
    $('input[name="q3"][value="Yes"]').prop('checked', true);
    $('input[name="q4"][value="No"]').prop('checked', true);
    $('input[name="q5"][value="Yes"]').prop('checked', true);
    $('input[name="q6"][value="No"]').prop('checked', true);
    $('input[name="q7"][value="Yes"]').prop('checked', true);
    $('input[name="q8"][value="No"]').prop('checked', true);
    $('input[name="q9"][value="No"]').prop('checked', true);

    // Fill details for questions with text input
    $('input[name="gamot_details"]').val('Paracetamol 500mg');
    $('input[name="sakit_details"]').val('Mild asthma');

    // ====== CONDITIONS ======
    // Check multiple checkboxes
    $('input[name="conditions[]"]').each(function(){
        if(['Diabetes', 'Allergy'].includes($(this).val())){
            $(this).prop('checked', true);
        }
    });

    // ====== CONSENT / SIGNATURE ======
    $('input[name="signature_name"]').val('Juan D Reyes');
    $('input[name="date_signed"]').val('2026-02-18');
    $('input[name="witness_name"]').val('Jessica Soho');

    console.log('Waiver modal test data populated.');
};


function getOralHealthChecks() {

    let data = [];

    $('.oral-health-table').first().find('tbody tr').each(function (i) {

        // =====================
        // DATE ROW
        // =====================
        if (i === 0) {

            let firstDate = null;

            $(this).find('td').slice(1).each(function () {
                let val = $(this).find('input[type="date"]').val();
                if (!firstDate && val) {
                    firstDate = val;
                }
            });

            if (firstDate) {
                data.push(firstDate); // 🔥 push directly, not inside array
            }

        } else {

            // =====================
            // CHECKBOX ROWS
            // =====================
            $(this).find('td').slice(1).each(function () {

                let $checkboxes = $(this).find('input[type="checkbox"]');

                if ($checkboxes.length === 2) {

                    let presentChecked = $checkboxes.eq(0).prop('checked');
                    let absentChecked  = $checkboxes.eq(1).prop('checked');

                    if (presentChecked) {
                        data.push(true); // 🔥 direct push
                    }
                    else if (absentChecked) {
                        data.push(false); // 🔥 direct push
                    }

                }

            });

        }

    });

    console.log('Final Oral Checks:', data);
    return data;
}


/* ================= ORAL HEALTH B ================= */
function getOralHealthNumbers() {

    let data = [];

    $('.oral-health-table').last().find('tbody tr').each(function () {

        $(this).find('td').slice(1).each(function () {

            let val = $(this).find('input').val();

            if (val !== undefined && val !== null && val !== '') {
                data.push(Number(val)); // 🔥 push as number, not string
            }

        });

    });

    console.log('Oral Numbers:', data);
    return data;
}


function clearForm() {
    // Text inputs
    $('input[type="text"], input[type="date"], input[type="number"]').val('');

    // Checkboxes
    $('input[type="checkbox"]').prop('checked', false);

    // Radio buttons (if any)
    $('input[type="radio"]').prop('checked', false);

    // Selects
    $('select').prop('selectedIndex', 0);

    // Optional: clear oral health tables completely
    $('.oral-health-table').find('tbody tr').each(function() {
        $(this).find('td input').each(function() {
            if ($(this).is(':checkbox') || $(this).is(':radio')) {
                $(this).prop('checked', false);
            } else {
                $(this).val('');
            }
        });
    });
}

function clearWaiverForm() {

    const form = $('#waiverForm');

    // 1️⃣ Reset basic inputs (text, date, etc.)
    form[0].reset();

    // 2️⃣ Clear all radio buttons manually (extra safety)
    form.find('input[type="radio"]').prop('checked', false);

    // 3️⃣ Clear all checkboxes
    form.find('input[type="checkbox"]').prop('checked', false);

    // 4️⃣ Clear text inputs (including border-bottom style ones)
    form.find('input[type="text"], input[type="date"]').val('');

    // 5️⃣ Clear hidden fields
    $('#waiverPatientId').val('');
    $('#waiverHpatcode').val('');

    // 6️⃣ Clear patient display info (the spans)
    $('#waiverPatientName').val('');
    $('#waiverAge').val('');
    $('#waiverAddress').val('');

    // 7️⃣ Clear agreement checkbox
    $('#waiverAgree').prop('checked', false);

    console.log('Waiver form cleared.');
}



// =========================
// Function to collect form data
// =========================
function cleanArray(arr) {
    return arr.filter(val => val !== null && val !== '' && val !== undefined);
}

function clearDentalForm() {
    // Clear vitals
    $('#bp, #pulse, #temp, #weight').val('');

    // Clear dietary checkboxes and details
    const dietaryConditions = ['sugar','alcohol','tobacco','betel'];
    dietaryConditions.forEach(cond => {
        $(`#${cond}`).prop('checked', false);
        $(`[name="${cond}_details"]`).val('');
    });

    // Clear medical history checkboxes and details
    $('.med-history-checkboxes').prop('checked', false);
    $('.med-history-details').val(''); // assuming you have input fields with class .med-history-details for specifics

    // Clear Oral Health Section A (checkboxes)
    $('#ohc-a-table tbody tr').each(function(i){
        $(this).find('input[type="checkbox"]').prop('checked', false);
    });

    // Clear Oral Health Section B (numbers)
    $('.oral-health-table tbody tr').each(function(i){
        $(this).find('input[type="number"]').val('');
    });

    // Clear parent/guardian
    $('#parentGuardian').val('');

    // Optional: reset any hidden fields or JSON storage
    $('#oralCheckJSON, #oralNumbersJSON, #dietaryJSON, #medHistoryJSON').val('');
}


function collectFormData() {
    return {
        hpatcode: $('#hpatcode').val(), // <- added this
        // Basic Information
        surname: $('input[name="surname"]').val(),
        firstName: $('input[name="firstName"]').val(),
        middleInitial: $('input[name="middleInitial"]').val(),
        dob: $('input[name="dob"]').val(),
        age: $('input[name="age"]').val(),
        sex: $('select[name="sex"]').val(),
        status: $('select[name="status"]').val(),
        placeOfBirth: $('input[name="placeOfBirth"]').val(),
        address: $('input[name="address"]').val(),
        occupation: $('input[name="occupation"]').val(),
        parentGuardian: $('input[name="parentGuardian"]').val(),

        // Membership / IDs
        nhts: $('#nhts').is(':checked'),
        p4ps: $('#4ps').is(':checked'),
        ip: $('#ip').is(':checked'),
        pwd: $('#pwd').is(':checked'),
        philhealth: $('#philhealth').val(),
        sss: $('#sss').val(),
        gsis: $('#gsis').val(),

        // Vital Signs
        bp: $('#bp').val(),
        pulse: $('#pulse').val(),
        temp: $('#temp').val(),
        weight: $('#weight').val(),

        // Medical History
        medHistory: $('.med-history-checkboxes:checked').map(function () {
            const $item = $(this).closest('.checkbox-item');
            const condition = $(this).val();
            let data = { condition: condition };
            $item.find('input[type="text"]').each(function () {
                data[$(this).attr('name')] = $(this).val();
            });
            return data;
        }).get(),

        // Dietary Habits
        dietary: $('.dietary-checkbox').map(function () {
            if (!$(this).is(':checked')) return null;
            const $item = $(this).closest('.checkbox-item');
            const condition = $(this).attr('id');
            let data = { condition: condition };
            $item.find('input[type="text"]').each(function () {
                data[$(this).attr('name')] = $(this).val();
            });
            return data;
        }).get().filter(Boolean), // remove nulls

        // Oral Health
        oralCheck: cleanArray(getOralHealthChecks()),
        oralNumbers: cleanArray(getOralHealthNumbers())
    };
}


$(document).ready(function () {
    // Disable Save button initially
    $('#btnSaveData').prop('disabled', true);

    // =========================
    // Generate PDF Button
    // =========================
    $('#btnGeneratePDF').on('click', function () {
        const formData = collectFormData();
        console.log('Generating PDF with data:', formData);

        $.ajax({
            url: '../assets/php/generate_pdf.php',
            type: 'POST',
            data: formData,
            xhrFields: { responseType: 'blob' }, // for PDF
            success: function (response) {
                const blob = new Blob([response], { type: 'application/pdf' });
                const url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');
            },
            error: function () {
                alert('Failed to generate PDF');
            }
        });
    });

    // =========================
    // Save Data Button
    // =========================
    $('#btnSaveData').on('click', function () {
        const formData = collectFormData();
        console.log('Saving form data:', formData);

        $.ajax({
            url: '../assets/php/save_dental_patient.php', // new endpoint
            type: 'POST',
            data: formData,
            success: function (response) {
                console.log(response)
                let res = typeof response === 'string' ? JSON.parse(response) : response;

                if(res.success){
                    // Store globally
                    window.savedPatientId = res.patient_id;
                    window.savedHpatcode = res.hpatcode;
                    console.log(window.savedPatientId)
                    console.log(window.savedHpatcode)

                    // Show confirmation modal
                    $('#saveSuccessModal').modal('show');
                    // clearForm()
                    // Hide generate until waiver is done
                    $('#btnGeneratePDF').hide();

                    // Reset modal buttons
                    $('#btnOpenWaiver').prop('disabled', false);
                    $('#btnGenerateAfterWaiver').addClass('d-none');

                    $('#saveSuccessModal').modal('show');

                    // Hide and reset buttons
                    // $('#btnGeneratePDF').hide();
                    $('#btnSaveData').prop('disabled', true);

                } else {
                    alert(res.message || 'Save failed.');
                }
            }, 
            error: function () {
                alert('Failed to save data');
            }
        });
    });

    $('#btnOpenWaiver').on('click', function(){

        $('#saveSuccessModal').modal('hide');

        $('#saveSuccessModal').on('hidden.bs.modal', function () {

            $('#waiverPatientName').val(
                $('#surname').val() + ', ' + $('#firstName').val()
            );

            $('#waiverAge').val($('#age').val());
            $('#waiverAddress').val($('#address').val());

            let today = new Date().toISOString().split('T')[0];

            $('#waiverModal').modal('show');

            $(this).off('hidden.bs.modal');
        });

    });


    $('#btnSaveWaiver').on('click', function(e){
        e.preventDefault();

        if(!$('#waiverAgree').is(':checked')){
            alert('You must agree to the waiver.');
            return;
        }

        if(!$('input[name="signature_name"]').val()){
            alert('Signature is required.');
            return;
        }

        // Collect form data
        let formData = $('#waiverForm').serializeArray();
        let dataObj = {};
        formData.forEach(item => dataObj[item.name] = item.value);

        // Collect checkboxes
        let conditions = [];
        $('#waiverForm input[name="conditions[]"]:checked').each(function(){
            conditions.push($(this).val());
        });
        dataObj['conditions'] = JSON.stringify(conditions);

        // Add patient info
        dataObj['patient_id'] = window.savedPatientId;
        dataObj['hpatcode'] = window.savedHpatcode // optional

        // dataObj['patient_id'] = $('#waiverPatientId').val(13)
        // dataObj['hpatcode'] = $('#waiverHpatcode').val('H-2026-000054')

        dataObj['signed_by'] = $('input[name="signature_name"]').val();
        dataObj['signed_date'] = $('input[name="date_signed"]').val();
        dataObj['witness_name'] = $('input[name="witness_name"]').val();

        console.log(dataObj)
        console.log(formData)
        $.ajax({
            url: '../assets/php/save_waiver.php',
            type: 'POST',
            data: dataObj,
            success: function(res){
                let response = typeof res === 'string' ? JSON.parse(res) : res;
                if(response.success){
                    let formData = new FormData(document.getElementById('waiverForm'));

                    formData.append('hpatcode', window.savedHpatcode);
                    formData.append('age', $('#waiverAge').val());
                    formData.append('address', $('#waiverAddress').val());

                    // Log all formData key/value pairs
                    console.log(formData);
                    for (let [key, value] of formData.entries()) {
                        console.log(key, ':', value);
                    }
                    // After saving waiver, generate waiver PDF
                    $.ajax({
                        url: '../assets/php/generate_waiver_pdf.php',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            xhrFields: { responseType: 'blob' },
                            success: function(pdfResponse) {

                            const blob = new Blob([pdfResponse], { type: 'application/pdf' });
                            const url = window.URL.createObjectURL(blob);
                            window.open(url, '_blank');

                            // Now continue your modal logic
                            $('#waiverModal').modal('hide');

                            $('#saveSuccessMessage').html(`
                                Waiver completed successfully.<br><br>
                                You may now generate the Patient Treatment Record Form.
                            `);

                            $('#btnOpenWaiver').addClass('d-none');

                            $('#btnGenerateAfterWaiver')
                                .removeClass('d-none')
                                .text('Generate PDF for Patient Treatment Record Form');

                            $('#saveSuccessModal').modal('show');
                        },
                        error: function(){
                            alert('Waiver saved but failed to generate Waiver PDF.');
                        }
                    });

                }
                else {
                    alert(response.message || 'Failed to save waiver.');
                }
            },
            error: function(){
                alert('Error saving waiver.');
            }
        });
    });


    $('#btnGenerateAfterWaiver').on('click', function(){

        const formData = collectFormData();

        $.ajax({
            url: '../assets/php/generate_pdf.php',
            type: 'POST',
            data: formData,
            xhrFields: { responseType: 'blob' },
            success: function (response) {

                const blob = new Blob([response], { type: 'application/pdf' });
                const url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');

                // NOW clear everything
                clearForm();
                clearDentalForm();
                clearWaiverForm();
                
                // Reset modal message to original
                $('#saveSuccessMessage').html(`
                    Data saved successfully.<br><br>
                    Please Proceed to Waiver.
                `);

                // Restore buttons
                $('#btnOpenWaiver').removeClass('d-none');
                $('#btnGenerateAfterWaiver')
                    .addClass('d-none')
                    .text('Generate PDF');

                $('#saveSuccessModal').modal('hide');

                // Reset buttons
                $('#btnSaveData').prop('disabled', true);
                $('#btnGeneratePDF').hide();

                window.savedPatientId = null;
                window.savedHpatcode = null;
            },
            error: function () {
                alert('Failed to generate PDF');
            }
        });

    });


    $(document).on('click', '#saveSuccessModal .btn-secondary', function() {
        // $('#saveSuccessModal .btn-close').on('click', function(){
        $('#btnGeneratePDF').hide();
        clearForm()
    })

    $('#patientSearchInput').on('keypress', function(e){
        if(e.which === 13){
            $('#btnSearchPatient').click();
        }
    });

    function escapeQuotes(str){
        return str?.replace(/'/g, "&apos;") ?? '';
    }

    $('#btnSearchPatient').on('click', function(){
        let searchValue = $('#patientSearchInput').val().trim();

        if (searchValue.length < 2) {
            $('.search-results').html(
                '<div class="text-muted text-center py-4">Enter at least 2 characters.</div>'
            );
            return;
        }

        $.ajax({
            url: '../assets/php/search_patient.php',
            method: 'POST',
            data: { search: searchValue },
            dataType: 'json',
            success: function(response){
                console.log(response)
                if(response.success && response.data.length > 0){

                    let html = `
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>HRN</th>
                                    <th>Name</th>
                                    <th>Birthdate</th>
                                    <th>Sex</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;

                    response.data.forEach(function(patient){
                        let patientStr = JSON.stringify(patient).replace(/'/g, "&apos;");

                        html += `
                            <tr class="patient-row" data-patient='${patientStr}'>
                                <td>${patient.hpatcode}</td>
                                <td>
                                    ${patient.patlast}, 
                                    ${patient.patfirst} 
                                    ${patient.patmiddle ?? ''}
                                </td>
                                <td>${patient.patbdate ?? ''}</td>
                                <td>${patient.patsex ?? ''}</td>
                            </tr>
                        `;
                    });

                    html += '</tbody></table>';

                    $('.search-results').html(html);

                } else {
                    $('.search-results').html(
                        '<div class="text-muted text-center py-4">No patients found.</div>'
                    );
                }
            },
            error: function(){
                $('.search-results').html(
                    '<div class="text-danger text-center py-4">Error fetching data.</div>'
                );
            }
        });

    });


    $(document).on('click', '.patient-row', function() {
        let patient = $(this).data('patient'); // stored as JSON
        console.log(patient)
        // Basic Info
        $('#surname').val(patient.patlast);
        $('#firstName').val(patient.patfirst);
        $('#middleInitial').val(patient.patmiddle ? patient.patmiddle.charAt(0) : '');
        $('#dob').val(patient.patbdate);
        $('#age').val(); 
        $('#hpatcode').val(patient.hpatcode);
        
        // Compute age based on dob
        if(patient.patbdate) {
            let dob = new Date(patient.patbdate);
            let today = new Date();

            let age = today.getFullYear() - dob.getFullYear();
            let m = today.getMonth() - dob.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                age--; // birthday hasn't occurred yet this year
            }

            $('#age').val(age);
        } else {
            $('#age').val('');
        }
        $('#sex').val(patient.patsex === 'M' ? 'Male' : 'Female');
        $('#status').val(patient.status);
        $('#placeOfBirth').val(patient.patbplace);
        $('#occupation').val(patient.employment.occupation ?? 'N/A');
        
        // Address
        if(patient.address){
            let addr = [];
            if(patient.address.unit) addr.push(patient.address.unit);
            if(patient.address.bldg) addr.push(patient.address.bldg);
            if(patient.address.lot) addr.push(patient.address.lot);
            if(patient.address.subd) addr.push(patient.address.subd);
            if(patient.address.barangay) addr.push(patient.address.barangay_name);
            if(patient.address.city) addr.push(patient.address.city_name);
            if(patient.address.province) addr.push(patient.address.province_name);
            if(patient.address.zipcode) addr.push(patient.address.zipcode);
            if(patient.address.country) addr.push(patient.address.country);
            $('#address').val(addr.join(', '));
        }

        // Parent / Guardian (take father first if exists)
        if(patient.family.mother){
            $('#parentGuardian').val(`${patient.family.mother.firstname} ${patient.family.father.lastname}`);
        } else if(patient.family.father){
            $('#parentGuardian').val(`${patient.family.father.firstname} ${patient.family.guardian.lastname}`);
        }

        // If dental record exists, pre-fill the form
        if(patient.dental) {
            const dental = patient.dental;

            // Fill vitals
            $('#bp').val(dental.bp);
            $('#pulse').val(dental.pulse);
            $('#temp').val(dental.temp);
            $('#weight').val(dental.weight);

            // Fill dietary habits
            const dietary = JSON.parse(dental.dietary || '[]');
            dietary.forEach(item => {
                const checkbox = $(`#${item.condition}`);
                if(checkbox.length) checkbox.prop('checked', true);
                // Optional: fill details if any
                Object.keys(item).forEach(key => {
                    if(key !== 'condition') {
                        $(`[name="${key}"]`).val(item[key]);
                    }
                });
            });

            // Fill medical history
            const medHistory = JSON.parse(dental.med_history || '[]');
            medHistory.forEach(item => {
                const checkbox = $(`.med-history-checkboxes[value="${item.condition}"]`);
                if(checkbox.length) checkbox.prop('checked', true);
                Object.keys(item).forEach(key => {
                    if(key !== 'condition') {
                        $(`[name="${key}"]`).val(item[key]);
                    }
                });
            });

            // Oral health (Section A)
            const oralCheck = JSON.parse(dental.oral_check || '[]');
            if(oralCheck.length) {
                $('#ohc-a-table tbody tr').each(function(i){
                    if(i === 0) return; // skip date row
                    const $td = $(this).find('td').eq(1);
                    const $checkboxes = $td.find('input[type="checkbox"]');
                    // Set date
                    $('#ohc-a-table tbody tr').first().find('td').eq(1).text(oralCheck[0]);

                    if($checkboxes.length === 2) {
                        $checkboxes.eq(0).prop('checked', oralCheck[i] === true || oralCheck[i] === 'true');
                        $checkboxes.eq(1).prop('checked', oralCheck[i] === false || oralCheck[i] === 'false');
                    }
                });
            }

            // Oral health numbers (Section B)
            const oralNumbers = JSON.parse(dental.oral_numbers || '[]');
            if(oralNumbers.length) {
                $('.oral-health-table').last().find('tbody tr').each(function(i){
                    const $input = $(this).find('td').eq(1).find('input[type="number"]');
                    if($input.length) $input.val(oralNumbers[i] || 0);
                });
            }

            // Fill parent/guardian
            $('#parentGuardian').val(dental.parent_guardian);

            // ==============================
            // Fill Other Patient Information (Membership & Govt Numbers)
            // ==============================
            $('#nhts').prop('checked', dental.nhts == 1);
            $('#4ps').prop('checked', dental.p4ps == 1);
            $('#ip').prop('checked', dental.ip == 1);
            $('#pwd').prop('checked', dental.pwd == 1);

            $('#philhealth').val(dental.philhealth ?? '');
            $('#sss').val(dental.sss ?? '');
            $('#gsis').val(dental.gsis ?? '');

        } else {
            // No dental record: clear dental form
            // clearDentalForm(); // you can make a JS function that resets checkboxes, numbers, etc.
        }


        // Close the modal
        $('#searchPatientModal').modal('hide');

        // Show Generate PDF button when patient is loaded
        $('#btnGeneratePDF').show();

        // Enable Save button now that a patient is selected
        $('#btnSaveData').prop('disabled', false);
    });

    // $('#waiverModal').modal('show');

});
