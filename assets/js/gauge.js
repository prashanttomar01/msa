$(document).ready(function () {
    // let table = new DataTable('#msa-table');

    $("#msa-form").submit(function (e) {
        e.preventDefault();
        let validForm = true;

        let user_form = new FormData(this);
        $('.required').each(function () {
            $(this).next('.text-danger').remove();
            if (validateField(this.id) == 0) {
                validForm = false;
            }
        });
        if (validForm) {
            $(':input[type="submit"]').prop('disabled', true);
            $.ajax({
                type: "POST",
                url: "api/gauge.php",
                data: user_form,
                contentType: false,
                processData: false,
                success: function (result) {
                    console.log(result);
                    if (result == 1) {
                        new Notify({
                            title: 'Form Status',
                            text: 'MSA Added Successfully!!',
                            status: 'success',
                            position: 'right bottom',
                            autoclose: true,
                            autotimeout: 3000,
                            effect: 'fade',
                            speed: 300
                        });
                        $('#msa-modal').modal('hide');
                        $(':input[type="submit"]').prop('disabled', false);
                    } else {
                        new Notify({
                            title: 'Form Status',
                            text: 'Error Adding MSA!!',
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
    $('.required').keyup(function () {
        validateField(this.id);
    });
    function userModal() {
        $('#msa-modal').modal('show');
    }

    $('#btn-modal').click(function () {
        $('#msa-modal').modal('show');
        $('#msa-form')[0].reset();
        $('#msaModalLabel').text('Add MSA');
        $('#btn-submit').text('Add');
        $('#gauge_name, #gauge_type, #gauge_number, #operators, #trials, #parts, #characteristic, #specification, #test_number, #status').each(function () {
            $(this).next('.text-danger').remove();
            $(this).removeClass('is-invalid');
        });
    });
    $('#icon-modal').click(function () {
    });

});
function editModal(msa_id) {
    $('#msa-modal').modal('show');
}
function msaEdit(msa_id) {
    let edit_form = new FormData();
    $('#msa-modal').modal('show');
    $('#msa-form')[0].reset();
    $('#btn-submit').text('Update');
    $('#gauge_name, #gauge_type, #gauge_number, #operators, #trials, #parts, #characteristic, #specification, #test_number, #status').each(function () {
        $(this).next('.text-danger').remove();
        $(this).removeClass('is-invalid');
    });
    edit_form.append('msa_id', msa_id);
    edit_form.append('form_action', 'fetch_msa');
    $.ajax({
        type: "POST",
        url: 'api/gauge.php',
        data: edit_form,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (result) {
            $('#msaModalLabel').text('Update MSA');
            $('#btn-submit').text('Update');
            $('#msa_id').val(result.msa_id);
            console.log(result);
            $('#gauge_name').val(result.gauge_name);
            $('#gauge_type').val(result.gauge_type);
            $('#gauge_number').val(result.gauge_number);
            $('#operators').val(result.operators);
            $('#trials').val(result.trials);
            $('#parts').val(result.parts);
            $('#characteristic').val(result.characteristic);
            $('#specification').val(result.specification);
            $('#test_number').val(result.test_number);
            $('#form_action').val('update_msa');
        }
    });
}


function msaDelete(msa_id) {
    $('#del-modal').modal('show');
    $('#del_msa_id').val(msa_id);
}
function removeUser() {
    let removeData = new FormData();
    let msa_id = $("#del_msa_id").val();
    removeData.append('msa_id', msa_id); 
    removeData.append('form_action', 'remove_msa');
    $.ajax({
        type: "POST",
        url: "api/gauge.php",
        data: removeData,
        contentType: false,
        processData: false,
        success: function (result) {
           
            if (result == 0) {
                new Notify({
                    title: 'Form Status',
                    text: 'MSA Deleted Successfully!!',
                    status: 'success',
                    position: 'right bottom',
                    autoclose: true,
                    autotimeout: 3000,
                    effect: 'fade',
                    speed: 300
                });
                $('#del-modal').modal('hide');
            } else {
                new Notify({
                    title: 'Form Status',
                    text: 'Error Deleting MSA!!',
                    status: 'error',
                    position: 'right bottom',
                    autoclose: true,
                    autotimeout: 3000,
                    effect: 'fade',
                    speed: 300
                });
            }
            
        }
    });
    var modalConfirm = function(callback){

        $("#modal-btn-yes").on("click", function(){
          callback(true);
          $("#mi-modal").modal('hide');
        });
        
        $("#modal-btn-no").on("click", function(){
          callback(false);
          $("#mi-modal").modal('hide');
        });
      };
}
