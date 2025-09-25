$(document).ready(function () {
    let table = new DataTable('#user-table');

    $("#user-form").submit(function (e) {
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
                url: "api/user.php",
                data: user_form,
                contentType: false,
                processData: false,
                success: function (result) {
                    console.log(result);
                    if (result == 1) {
                        new Notify({
                            title: 'Form Status',
                            text: 'User Created Successfully!!',
                            status: 'success',
                            position: 'right bottom',
                            autoclose: true,
                            autotimeout: 3000,
                            effect: 'fade',
                            speed: 300
                        });
                        $('#user-modal').modal('hide');
                        $(':input[type="submit"]').prop('disabled', false);
                    } else {
                        new Notify({
                            title: 'Form Status',
                            text: 'Error Creating User!!',
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
        $('#user-modal').modal('show');
    }

    $('#btn-modal').click(function () {
        $('#user-modal').modal('show');
        $('#user-form')[0].reset();
        $('#userModalLabel').text('Add User');
        $('#btn-submit').text('Add');
        $('#first_name, #last_name, #username, #password, #email, #phone').each(function () {
            $(this).next('.text-danger').remove();
            $(this).removeClass('is-invalid');
            $('#password').addClass('required');
        });
    });
    $('#icon-modal').click(function () {
    });

});
function userEdit(user_id) {
    let edit_form = new FormData();
    $('#user-modal').modal('show');
    $('#user-form')[0].reset();
    $('#first_name, #last_name, #username, #password, #email, #phone').each(function () {
        $(this).next('.text-danger').remove();
        $(this).removeClass('is-invalid');
    });
    if ($('#password').hasClass('required')) {
        $('#password').removeClass('required');
    }
    edit_form.append('user_id', user_id);
    edit_form.append('form_action', 'fetch_user');
    $.ajax({
        type: "POST",
        url: 'api/user.php',
        data: edit_form,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (result) {
            $('#userModalLabel').text('Update User');
            $('#btn-submit').text('Update');
            $('#user_id').val(result.id);
            if ($('#password').hasClass('required')) {
                $('#password').removeClass('required');
            }
            console.log(result);
            $('#first_name').val(result.first_name);
            $('#last_name').val(result.last_name);
            $('#username').val(result.username);
            $('#email').val(result.email);
            $('#phone').val(result.phone);
            $('#form_action').val('update_user');
        }
    });
}

function showModal(user_id) {
    $('#mi-modal').modal('show');
}
function removeUser(user_id) {
    let removeData = new FormData();
    $('#mi-modal').modal('show');
    removeData.append('user_id', user_id); 
    removeData.append('form_action', 'remove_user');
    $.ajax({
        type: "POST",
        url: "api/user.php",
        data: removeData,
        contentType: false,
        processData: false,
        success: function (result) {
            if (result == 0) {
                new Notify({
                    title: 'Form Status',
                    text: 'User Deleted Successfully!!',
                    status: 'success',
                    position: 'right bottom',
                    autoclose: true,
                    autotimeout: 3000,
                    effect: 'fade',
                    speed: 300
                });
            } else {
                new Notify({
                    title: 'Form Status',
                    text: 'Error Deleting User!!',
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
