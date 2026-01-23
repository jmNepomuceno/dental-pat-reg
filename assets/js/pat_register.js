$(document).ready(function() {

    window.testCases = function (){
        // ================= IDENTIFIERS =================
        $('#philID').val('1234-5678-9012-3456');
        $('#philDigitalID').val('PH-DIG-0001');
        // $('#healthRecNo').val('HR-000001'); // override only for testing
        $('#oldHealthRecNo').val('OLD-001');
        $('#seniorNo').val('');
        $('#mssNo').val('MSS-1001');

        // ================= BASIC INFO =================
        $('#lastName').val('Delos Reyes');
        $('#firstName').val('Julius');
        $('#suffix').val('');
        $('#alias').val('Jules');
        $('#middleName').val('Estrada');
        $('#dob').val('2000-07-07');
        $('#sex').val('M').trigger('change');

        $('#year').val(24);
        $('#month').val(7);
        $('#day').val(7);

        $('#gender').val('');
        $('#civilStatus').val('Single');
        $('#birthPlace').val('Quezon City');
        $('#bloodType').val('');
        $('#nationality').val('Filipino');
        $('#religion').val('Roman Catholic');
        $('#indigenousGroup').val('No');
        $('#employment').val('');
        $('#education').val('');
        $('#occupation').val('');
        $('#telephone').val('02-1234-5678');

        // ================= PRESENT ADDRESS =================
        $('#presentRegion').val('3').trigger('change');
        $('#presentProvince').val('314').trigger('change');
        $('#presentCity').val('31403').trigger('change');
        $('#presentBarangay').val('31403024');
        $('#presentStreet').val('Test Street #3');
        $('#presentDistrict').val('');
        $('#presentZip').val('3006');
        $('#presentCountry').val('Philippines');

        // ================= PERMANENT ADDRESS =================
        $('#permRegion').val('3').trigger('change');
        $('#permProvince').val('314').trigger('change');
        $('#permCity').val('31403').trigger('change');
        $('#permBarangay').val('31403024');
        $('#permStreet').val('Test Street #3');
        $('#permDistrict').val('');
        $('#permZip').val('3006');
        $('#permCountry').val('Philippines');

        // ================= FAMILY =================
        // Spouse (disabled but included for completeness)
        $('#spouse_lastName').val('');
        $('#spouse_firstName').val('');
        $('#spouse_middleName').val('');
        $('#spouse_address').val('');
        $('#spouse_mobile').val('');
        $('#spouse_contact').val('');
        $('#spouse_deceased').val('');

        // Father
        $('#father_lastName').val('Delos Reyes');
        $('#father_firstName').val('Jose');
        $('#father_middleName').val('');
        $('#father_address').val('Bulacan');
        $('#father_mobile').val('09171234567');
        $('#father_contact').val('');
        $('#father_deceased').val('0');
        $('#father_suffix').val('');

        // Mother
        $('#mother_lastName').val('Estrada');
        $('#mother_firstName').val('Maria');
        $('#mother_middleName').val('');
        $('#mother_address').val('Bulacan');
        $('#mother_mobile').val('09179876543');
        $('#mother_contact').val('');
        $('#mother_deceased').val('0');

        // Contact Person
        $('#contact_name').val('Juan Dela Cruz');
        $('#contact_address').val('Bulacan');
        $('#contact_mobile').val('09170001111');
        $('#contact_relation').val('Brother');

        console.log('✅ testCases() applied — form populated');
    };


    let patientMode = 'add'; // 'add' | 'edit' | 'view'
    let currentPatientId = null;
    let patientDT = null;

    $('#sameAddress').change(function () {
        if (!$(this).is(':checked')) {
            $('#permStreet, #permRegion, #permProvince, #permCity, #permBarangay, #permDistrict, #permZip, #permCountry')
                .prop('disabled', false);
            return;
        }

        // Disable fields
        $('#permStreet, #permRegion, #permProvince, #permCity, #permBarangay, #permDistrict, #permZip, #permCountry')
            .prop('disabled', true);

        // Copy simple fields
        $('#permStreet').val($('#presentStreet').val());
        $('#permDistrict').val($('#presentDistrict').val());
        $('#permCountry').val($('#presentCountry').val());

        const region = $('#presentRegion').val();
        const province = $('#presentProvince').val();
        const city = $('#presentCity').val();
        const barangay = $('#presentBarangay').val();
        const zip = $('#presentZip').val();

        // STEP 1: REGION
        $('#permRegion').val(region).trigger('change');

        // STEP 2: wait for provinces
        $.getJSON('../assets/php/getProvinces.php', { region_code: region }, function (provinces) {

            let pHtml = '<option value="">Select Province</option>';
            $.each(provinces, function (_, row) {
                pHtml += `<option value="${row.province_code}">${row.province_description}</option>`;
            });
            $('#permProvince').html(pHtml).val(province).trigger('change');

            // STEP 3: wait for cities
            $.getJSON('../assets/php/getCities.php', { province_code: province }, function (cities) {

                let cHtml = '<option value="">Select City</option>';
                $.each(cities, function (_, row) {
                    cHtml += `<option value="${row.municipality_code}">${row.municipality_description}</option>`;
                });
                $('#permCity').html(cHtml).val(city).trigger('change');

                // STEP 4: wait for barangays
                $.getJSON('../assets/php/getBarangays.php', { city_code: city }, function (barangays) {

                    let bHtml = '<option value="">Select Barangay</option>';
                    $.each(barangays, function (_, row) {
                        bHtml += `<option value="${row.barangay_code}">${row.barangay_description}</option>`;
                    });

                    $('#permBarangay').html(bHtml).val(barangay);
                    $('#permZip').val(zip);
                });
            });
        });
    });

    function loadRegions(select) {
        $.getJSON('../assets/php/getRegions.php', function (data) {
            let html = '<option value="">Select Region</option>';
            $.each(data, function (_, row) {
                html += `<option value="${row.region_code}">${row.region_description}</option>`;
            });
            $(select).html(html);
        } );
    }

    loadRegions('#presentRegion');
    loadRegions('#permRegion');

    function regionChange(region, province, city, barangay) {
        $(region).on('change', function () {
            let region_code = $(this).val();

            $(province).html('<option value="">Select Province</option>');
            $(city).html('<option value="">Select City</option>');
            $(barangay).html('<option value="">Select Barangay</option>');

            if (!region_code) return;

            $.getJSON('../assets/php/getProvinces.php', { region_code }, function (data) {
                console.log(data)
                let html = '<option value="">Select Province</option>';
                $.each(data, function (_, row) {
                    html += `<option value="${row.province_code}">${row.province_description}</option>`;
                });
                $(province).html(html);
            });
        });
    }

    function provinceChange(province, city, barangay) {
        $(province).on('change', function () {
            let province_code = $(this).val();

            $(city).html('<option value="">Select City</option>');
            $(barangay).html('<option value="">Select Barangay</option>');

            if (!province_code) return;

            $.getJSON('../assets/php/getCities.php', { province_code }, function (data) {
                console.log(data)
                let html = '<option value="">Select City / Municipality</option>';
                $.each(data, function (_, row) {
                    html += `<option value="${row.municipality_code}">${row.municipality_description}</option>`;
                });
                $(city).html(html);
            });
        });
    }

    function cityChange(city, barangay, zip) {
        $(city).on('change', function () {
            let city_code = $(this).val();

            $(barangay).html('<option value="">Select Barangay</option>');
            $(zip).val('');

            if (!city_code) return;

            $.getJSON('../assets/php/getBarangays.php', { city_code }, function (data) {
                console.log(data);

                let html = '<option value="">Select Barangay</option>';
                $.each(data, function (_, row) {
                    html += `<option value="${row.barangay_code}">
                                ${row.barangay_description}
                            </option>`;
                });

                $(barangay).html(html);

                // ✅ Set ZIP based on selected city
                console.log(data[0]?.ctyzipcode);
                $(zip).val(data[0]?.ctyzipcode || '');
            });
        });
    }

    function fillPatientForm(data) {
        console.log(data)
        // ================= IDENTIFIERS =================
        $('#philID').val(data.philID || '');
        $('#philDigitalID').val(data.philDigitalID || '');
        $('#healthRecNo').val(data.healthRecNo || '');
        $('#oldHealthRecNo').val(data.oldHealthRecNo || '');
        $('#seniorNo').val(data.seniorNo || '');
        $('#mssNo').val(data.mssNo || '');

        // ================= BASIC INFO =================
        $('#lastName').val(data.patlast || '');
        $('#firstName').val(data.patfirst || '');
        $('#middleName').val(data.patmiddle || '');
        $('#suffix').val(data.suffix || '');
        $('#alias').val(data.alias || '');
        $('#dob').val(data.dob || '');
        $('#sex').val(data.sex || '');
        $('#civilStatus').val(data.civilStatus || '');
        $('#birthPlace').val(data.birthPlace || '');
        $('#bloodType').val(data.bloodType || '');
        $('#nationality').val(data.nationality || '');
        $('#religion').val(data.religion || '');
        $('#indigenousGroup').val(data.indigenousGroup || '');
        $('#occupation').val(data.occupation || '');
        $('#telephone').val(data.telephone || '');

        // ================= PRESENT ADDRESS =================
        $('#presentRegion').val(data.present_region).trigger('change');
        $('#presentStreet').val(data.present_street);
        $('#presentZip').val(data.present_zip);

        // ================= PERMANENT ADDRESS =================
        $('#permRegion').val(data.perm_region).trigger('change');
        $('#permStreet').val(data.perm_street);
        $('#permZip').val(data.perm_zip);

        // ================= FAMILY =================
        $('#father_lastName').val(data.father_lastName || '');
        $('#father_firstName').val(data.father_firstName || '');
        $('#father_middleName').val(data.father_middleName || '');
        $('#father_mobile').val(data.father_mobile || '');

        $('#mother_lastName').val(data.mother_lastName || '');
        $('#mother_firstName').val(data.mother_firstName || '');
        $('#mother_middleName').val(data.mother_middleName || '');

        $('#contact_name').val(data.contact_name || '');
        $('#contact_mobile').val(data.contact_mobile || '');
    }

    function setViewMode(isView) {
        $('#modalPatient input, #modalPatient select').prop('disabled', isView);

        if (isView) {
            $('.actions .btn.success').hide(); // Hide Save
        } else {
            $('.actions .btn.success').show();
        }
    }

    function setModalTitle(title) {
        $('#modalPatient h3').text(title);
    }

    function resetPatientForm() {
        // 🔹 Clear all inputs (text, number, date)
        $('.page input').val('');

        // 🔹 Reset all selects
        $('.page select').prop('selectedIndex', 0);

        // 🔹 Uncheck checkboxes
        $('.page input[type="checkbox"]').prop('checked', false);

        // 🔹 Re-enable disabled fields (in case sameAddress was used)
        $('.page input, .page select').prop('disabled', false);

        // 🔹 Clear address cascading selects properly
        $('#presentProvince, #presentCity, #presentBarangay').html('<option value="">Select</option>');
        $('#permProvince, #permCity, #permBarangay').html('<option value="">Select</option>');

        // 🔹 Reset ZIPs
        $('#presentZip, #permZip').val('');

        // 🔹 Reload regions (important!)
        loadRegions('#presentRegion');
        loadRegions('#permRegion');

        // 🔹 Clear readonly health record (will be regenerated)
        $('#healthRecNo').val('');
    }


    // Initialize DataTable
    const init_table = () => {

        if (patientDT) return; // 🚫 already initialized

        patientDT = $('#patientTable').DataTable({
            ajax: {
                url: '../assets/php/getPatients.php',
                dataSrc: function (data) {
                    console.log('Fetched patients:', data);
                    return data;
                }
            },
            columns: [
                { data: 'hpatcode' },
                { data: null, render: d => `${d.patlast}, ${d.patfirst} ${d.patmiddle || ''}` },
                { data: 'age' },
                { data: 'patbdate' },
                {
                    data: null,
                    render: d => `
                        <button class="btn secondary btn-edit" data-id="${d.hpatkey}">Edit</button>
                        <button class="btn secondary btn-delete" data-id="${d.hpatkey}">Delete</button>
                        <button class="btn secondary btn-view" data-id="${d.hpatkey}">View</button>
                        <button class="btn success btn-process" data-id="${d.hpatkey}">Process</button>
                    `
                }
            ]
        });
    };


    // Present Address
    regionChange('#presentRegion', '#presentProvince', '#presentCity', '#presentBarangay');
    provinceChange('#presentProvince', '#presentCity', '#presentBarangay');
    cityChange('#presentCity', '#presentBarangay', '#presentZip');

    // Permanent Address
    regionChange('#permRegion', '#permProvince', '#permCity', '#permBarangay');
    provinceChange('#permProvince', '#permCity', '#permBarangay');
    cityChange('#permCity', '#permBarangay', '#permZip');

    init_table()

    $('label').each(function () {
        const html = $(this).html();

        if (html.includes('*')) {
            $(this).html(
                html.replace('*', '<span class="required">*</span>')
            );
        }
    });

     // Click event for Save Patient
    $('#btnSavePatient').on('click', function(e) {
        e.preventDefault();

        let patientData = {
            identifiers: {
                philID: $('#philID').val(),
                philDigitalID: $('#philDigitalID').val(),
                healthRecNo: $('#healthRecNo').val(),
                oldHealthRecNo: $('#oldHealthRecNo').val(),
                seniorNo: $('#seniorNo').val(),
                mssNo: $('#mssNo').val()
            },
            basicInfo: {
                lastName: $('#lastName').val(),
                firstName: $('#firstName').val(),
                suffix: $('#suffix').val(),
                alias: $('#alias').val(),
                middleName: $('#middleName').val(),
                dob: $('#dob').val(),
                sex: $('#sex').val(),
                year: $('#year').val(),
                month: $('#month').val(),
                day: $('#day').val(),
                gender: $('#gender').val(),
                civilStatus: $('#civilStatus').val(),
                birthPlace: $('#birthPlace').val(),
                bloodType: $('#bloodType').val(),
                nationality: $('#nationality').val(),
                religion: $('#religion').val(),
                indigenousGroup: $('#indigenousGroup').val(),
                employment: $('#employment').val(),
                education: $('#education').val(),
                occupation: $('#occupation').val(),
                telephone: $('#telephone').val()
            },
            address: {
                present: {
                    region: $('#presentRegion').val(),
                    province: $('#presentProvince').val(),
                    city: $('#presentCity').val(),
                    barangay: $('#presentBarangay').val(),
                    street: $('#presentStreet').val(),
                    district: $('#presentDistrict').val(),
                    zip: $('#presentZip').val(),
                    country: $('#presentCountry').val()
                },
                permanent: {
                    region: $('#permRegion').val(),
                    province: $('#permProvince').val(),
                    city: $('#permCity').val(),
                    barangay: $('#permBarangay').val(),
                    street: $('#permStreet').val(),
                    district: $('#permDistrict').val(),
                    zip: $('#permZip').val(),
                    country: $('#permCountry').val()
                }
            },
            family: {
                spouse: {
                    lastName: $('#spouse_lastName').val(),
                    firstName: $('#spouse_firstName').val(),
                    middleName: $('#spouse_middleName').val(),
                    address: $('#spouse_address').val(),
                    mobile: $('#spouse_mobile').val(),
                    contact: $('#spouse_contact').val(),
                    deceased: $('#spouse_deceased').val()
                },
                father: {
                    lastName: $('#father_lastName').val(),
                    firstName: $('#father_firstName').val(),
                    middleName: $('#father_middleName').val(),
                    address: $('#father_address').val(),
                    mobile: $('#father_mobile').val(),
                    contact: $('#father_contact').val(),
                    deceased: $('#father_deceased').val(),
                    suffix: $('#father_suffix').val()
                },
                mother: {
                    lastName: $('#mother_lastName').val(),
                    firstName: $('#mother_firstName').val(),
                    middleName: $('#mother_middleName').val(),
                    address: $('#mother_address').val(),
                    mobile: $('#mother_mobile').val(),
                    contact: $('#mother_contact').val(),
                    deceased: $('#mother_deceased').val()
                },
                contactPerson: {
                    name: $('#contact_name').val(),
                    address: $('#contact_address').val(),
                    mobile: $('#contact_mobile').val(),
                    relation: $('#contact_relation').val()
                }
            }
        };


        // // Optional: simple required field validation
        // let requiredFields = $('#lastName, #firstName, #middleName, #dob, #sex, #civilStatus, #presentRegion, #presentProvince, #presentCity, #presentBarangay, #presentStreet, #presentZip, #presentCountry, #permRegion, #permProvince, #permCity, #permBarangay, #permStreet, #permZip, #permCountry');
        // // #permDistrict
        // // #presentDistrict,
        // let missing = [];

        // // Clear previous errors
        // requiredFields.removeClass('field-error');

        // requiredFields.each(function () {
        //     if (!$(this).val()) {
        //         missing.push($(this).attr('id'));
        //         $(this).addClass('field-error');
        //     }
        // });

        // if (missing.length > 0) {
        //     alert('Please fill all required fields.');
        //     // Auto-scroll to first missing field
        //     $('#' + missing[0])[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
        //     return;
        // }

        console.log(patientData)

            
        let url = '../assets/php/savePatient.php';

        if (patientMode === 'edit') {
            url = '../assets/php/updatePatient.php';
            patientData.hpatkey = currentPatientId;
        }

        // AJAX POST to savePatient.php
        $.ajax({
            url: url,
            type: 'POST',
            data: { patient: patientData },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert('Patient saved successfully');

                    $('#modalPatient').hide();
                    patientDT.ajax.reload(null, false);

                    resetPatientForm();
                    patientMode = 'add';
                    currentPatientId = null;
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('An error occurred while saving the patient.');
            }
        });
    });

    $(document).on('input change', 'input, select', function () {
        if ($(this).val()) {
            $(this).removeClass('field-error');
        }
    });

    $('#sex').on('change', function () {
        const sex = $(this).val();
        if (sex === 'Male') $('#gender').val('Male');
        if (sex === 'Female') $('#gender').val('Female');
    });

    // Open modal
    $('#btnAddPatient').click(function () {
        // Optional: reset form first
        // $('#patientForm')[0].reset();

        $.ajax({
            url: '../assets/php/getNewHealthRecNo.php',
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                console.log(res)
                if (res.healthRecNo) {
                    $('#healthRecNo').val(res.healthRecNo);
                    $('#modalPatient').show();
                } else {
                    alert('Failed to generate Health Record Number');
                }
            },
            error: function () {
                alert('Server error while generating Health Record Number');
            }
        });
    });

    // Close modal
    $('.close-modal').click(() => $('#modalPatient').hide());
    $(window).click(function(e){
        if(e.target.id === 'modalPatient') $('#modalPatient').hide();
    });

    // Example: handle row button click
    $('#patientTable tbody').on('click', 'button.btn-edit', function () {
        const hpatkey = $(this).data('id');

        patientMode = 'edit';
        currentPatientId = hpatkey;

        $.ajax({
            url: '../assets/php/getPatientById.php',
            type: 'GET',
            data: { hpatkey },
            dataType: 'json',
            success: function (data) {
                console.log('Editing patient:', data);

                fillPatientForm(data);      // you already use this
                setViewMode(false);         // enable inputs
                setModalTitle('Edit Patient');

                $('#healthRecNo').prop('readonly', true); // NEVER editable
                $('#modalPatient').show();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Failed to load patient data');
            }
        });
    });

    // VIEW PATIENT
    $('#patientTable tbody').on('click', '.btn-view', function () {
        const hpatkey = $(this).data('id');

        $.ajax({
            url: '../assets/php/getPatientById.php',
            type: 'GET',
            data: { hpatkey },
            dataType: 'json',
            success: function (data) {
                console.log('Viewing patient:', data);

                fillPatientForm(data);
                setViewMode(true);
                setModalTitle('View Patient');

                $('#modalPatient').show();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Failed to load patient data');
            }
        });
    });

    


});
