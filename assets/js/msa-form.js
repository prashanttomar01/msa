$("#msa-form").submit(function (e) {
    e.preventDefault();
    let validForm = true;
  
    let msaForm = new FormData(this);
    $('#gauge-name, #gauge-type, #gauge-number, #operators, #trials, #parts, #characteristic, #specification, #test-num').each(function () {
        $(this).next('.text-danger').remove();
        if (validateField(this.id) == 0) {
            validForm = false;
        }
    });
    if (validForm) {
        $(':input[type="submit"]').prop('disabled', true);
        
        $.ajax({
            type: "POST",
            url: "api/msa_form_api.php",
            data: msaForm,
            contentType: false,
            processData: false,
            success: function (result) {
                alert(result);
                if (result == 1) {
                    new Notify({
                        title: 'Form Status',
                        text: 'Form submitted!!',
                        status: 'success',
                        position: 'right bottom',
                        autoclose: true,
                        autotimeout: 3000,
                        effect: 'fade',
                        speed: 300
                    });
                    $(':input[type="submit"]').prop('disabled', false);
                } else {
                    new Notify({
                        title: 'Form Status',
                        text: 'Form not submitted!!',
                        status: 'error',
                        position: 'right bottom',
                        autoclose: true,
                        autotimeout: 3000,
                        effect: 'fade',
                        speed: 300
                    });
                    $(':input[type="submit"]').prop('disabled', true);
                }
            }
        });
    }
});

$('#gauge-name, #gauge-type, #gauge-number, #operators, #trials, #parts, #characteristic, #specification, #test-num').keyup(function () {
    $(this).next('.text-danger').remove();
    $(this).removeClass('is-invalid');
    if (validateField(this.id) == 0) {
        validForm = false;
    }
});
