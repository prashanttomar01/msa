$("#initialize-msa").submit(function(e){
    e.preventDefault();
    let validForm = true;
    $(':input[type="submit"]').prop('disabled', true);
 
    // $('#btn-submit').prop('disable', true);
    let formData = new FormData(this);
    $('#operators, #trials, #parts').each(function () {
        $(this).next('.text-danger').remove();
        if (validateField(this.id) === 0) {
            validForm = false;
        }
    });

    if(validForm){
        $.ajax({
            type: "POST",
            url: "api/form_action.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function(result) {
                if (result == 1) {
                    new Notify({
                        title: 'Form status ',
                        text: 'Form submitted!!',
                        status: 'success',
                        position: 'right bottom',
                        autoclose: true,
                        autotimeout: 3000,
                        effect: 'fade',
                        speed: 300 // animation speed
                    });
                    $(':input[type="submit"]').prop('disabled', false);
 
                    // $('#btn-submit').attr('disable', false);
                } else {
                    new Notify({
                        title: 'Form status ',
                        text: 'Form not submitted!!',
                        status: 'error',
                        position: 'right bottom',
                        autoclose: true,
                        autotimeout: 3000,
                        effect: 'fade',
                        speed: 300 // animation speed
                    });
                    $(':input[type="submit"]').prop('disabled', false);
 
                    // $('#btn-submit').attr('disable', true);
                }
            }
        });
    }
});

$('#operators, #trials, #parts').keyup(function () {
    $(this).next('.text-danger').remove();
    $(this).removeClass('is-invalid');
    if (validateField(this.id) === 0) {
        validForm = false;
    }
});
function validateField(fieldId) {
    if ($('#' + fieldId).val() == '') {
        $('#' + fieldId).addClass('is-invalid');
        $('#' + fieldId).after('<span class="text-danger">This field is required!!</span>');
        return 0;
    }
    return 1;
}
