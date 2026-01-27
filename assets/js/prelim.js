$(document).ready(function () {

    $('#btnGeneratePDF').on('click', function () {
        console.log('here')
        let formData = {
            surname: $('input[name="surname"]').val(),
            firstname: $('input[name="firstname"]').val(),
            middle: $('input[name="middle"]').val(),
            dob: $('input[name="dob"]').val(),
            age: $('input[name="age"]').val(),
            sex: $('select[name="sex"]').val(),
            address: $('input[name="address"]').val(),
            bp: $('input[name="bp"]').val(),
            pulse: $('input[name="pulse"]').val(),
            temp: $('input[name="temp"]').val(),
            weight: $('input[name="weight"]').val()
            // we’ll expand this later
        };

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
