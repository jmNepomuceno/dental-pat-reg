const test = () => {
    // ====== BASIC PATIENT INFO ======
    $('input[name="surname"]').val('Reyes');
    $('input[name="firstName"]').val('Juan');
    $('input[name="middleInitial"]').val('D');
    $('input[type="date"]').val('2015-06-12');
    $('input[type="number"]').val('10');
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
    // Add your preliminary data for oral checks
    var oralChecks = ['✔','✖','✔','✔','✖','✔','✔','✔','✖']; // for the actual conditions, skip the first row

    // Target the first oral-health table
    $('.oral-health-table').first().find('tbody tr').each(function(i){
        // Skip first row (Date of Oral Examination)
        if(i === 0){
            $(this).find('td').slice(1).text('01/27/2026'); // example date
            return; // skip to next iteration
        }

        // Fill the rest of the rows with ✔/✖
        $(this).find('td').slice(1).each(function(){
            $(this).text(oralChecks[i-1]); // subtract 1 because oralChecks starts from second row
        });
    });


    // Section B: Indicate Number
    var oralNumbers = [28, 28, 2, 0, 0, 30, 12, 12, 1, 0, 13];
    $('.oral-health-table').last().find('tbody tr').each(function(i){
        $(this).find('td').slice(1).each(function(){
            $(this).text(oralNumbers[i]);
        });
    });
}

function getOralHealthChecks() {
    let data = [];

    $('.oral-health-table').first().find('tbody tr').each(function (i) {
        let row = [];
        $(this).find('td').slice(1).each(function () {
            row.push($(this).text().trim());
        });
        data.push(row);
    });

    console.log(data)
    return data;
}

function getOralHealthNumbers() {
    let data = [];

    $('.oral-health-table').last().find('tbody tr').each(function () {
        let row = [];
        $(this).find('td').slice(1).each(function () {
            row.push($(this).text().trim());
        });
        data.push(row);
    });

    console.log(data)
    return data;
}


$(document).ready(function () {

    $('#btnGeneratePDF').on('click', function () {
        let formData = {
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

            // Membership
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

            // Medical History (collect all checked)
            medHistory: $('.med-history-checkboxes:checked').map(function () {

                const $item = $(this).closest('.checkbox-item');
                const condition = $(this).val();

                let data = {
                    condition: condition
                };

                $item.find('input[type="text"]').each(function () {
                    const name = $(this).attr('name');
                    data[name] = $(this).val();
                });

                return data;

            }).get(),

            /* ================= DIETARY HABITS ================= */
            dietary: $('.dietary-checkbox').map(function () {
                const $item = $(this).closest('.checkbox-item');
                const condition = $(this).attr('id');

                let data = { condition: condition };

                // Collect any text inputs inside this item
                $item.find('input[type="text"]').each(function () {
                    const name = $(this).attr('name');
                    data[name] = $(this).val();
                });

                // Only include if checkbox is checked (or you can include all)
                if ($(this).is(':checked')) {
                    return data;
                } else {
                    return null; // will be filtered out by .get()
                }
            }).get(),


             /* ================= ORAL HEALTH A ================= */
            oralCheck: getOralHealthChecks(),

            /* ================= ORAL HEALTH B ================= */
            oralNumbers: getOralHealthNumbers()

            // You can continue with oral health, dietary habits, etc.
        };

        console.log('formData being sent:', formData);

        $.ajax({
            url: '../assets/php/generate_pdf.php',
            type: 'POST',
            data: formData,
            xhrFields: {
                responseType: 'blob' // IMPORTANT for PDF
            },
            success: function (response) {
                let blob = new Blob([response], { type: 'application/pdf' });
                let url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');
            },
            error: function () {
                alert('Failed to generate PDF');
            }
        });
    });

});
