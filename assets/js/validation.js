function validateField(fieldId) {
    $('#' + fieldId).next('.text-danger').remove();
    $('#' + fieldId).removeClass('is-invalid');
    if ($('#' + fieldId).val() == '') {
        $('#' + fieldId).addClass('is-invalid');
        $('#' + fieldId).after('<span class ="text-danger">This field is required!!</span>');
        return 0;
    }
    return 1;
}