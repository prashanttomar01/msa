$("#signupform").on("submit", function(e) {
    var validForm = true;
    let username = email = password = confirm_password = msg = '';
    username = $('#username').val();
    $('#usernamemsg').remove();
    if (username == "") {
        validForm = false;
        $('#username').addClass('focusColor');
        // $('#username').addClass('focusColor');
        msg = '<p class="text-danger" id="usernameerror"> User name is required! </p>';
        $('#username-field').after('<span class="text-danger" id="usernamemsg">' + msg + '</span>');
    }
    email = $('#email').val();
    $('#emailmsg').remove()
    if (email == "") {
        validForm = false;
        msg = '<p class="text-danger" id="emailerror"> Email is required! </p>';
        $('#email-field').after('<span class="text-danger" id="emailmsg">' + msg + '</span>');
    }
    password = $('#password').val();
    $('#passmsg').remove();

    if (password == "") {
        validForm = false;
        msg = '<p class="text-danger" id="passworderror"> Password is required! </p>';
        $('#password-field').after('<span class="text-danger" id="passmsg">' + msg + '</span>');
    }
    confirm_password = $('#confirm_password').val();
    $('#conpassmsg').remove();
    if (confirm_password == "") {
        validForm = false;
        msg = '<p class="text-danger" id="confirm_passworderror"> Enter the same password! </p>';
        $('#con-password-field').after('<span class="text-danger" id="conpassmsg">' + msg + '</span>');

    }

    if($('#user_exist').val() == 1){
        validForm=false;
        msg = '<p class="text-danger" id="usernameerror"> Username already exists! </p>';
        $('#username-field').after('<span class="text-danger" id="usernamemsg">' + msg + '</span>');
    }
    if (validForm) {
        return true;
    } else {
        e.preventDefault();
        return false;
    }
});


$('#username').on('keyup', function() {
    let username = $('#username').val();
    $('#usernamemsg').remove();
    if (username != "") {
        $('#usernameerror').text('');
    }
});
$('#email').on('keyup', function() {
    let email = $('#email').val();
    if (email != "") {
        $('#emailerror').text('');
    }
});
$('#password').on('keyup', function() {
    let password = $('#password').val();
    if (password != "") {
        $('#passworderror').text('');
    }
});
$('#confirm_password').on('keyup', function() {
    let confirm_password = $('#confirm_password').val()
    if (confirm_password != "") {
        $('#confirm_passworderror').text('');
    }
});
$('#confirm_password').on('keyup', function() {
    let password = $('#password').val();
    let confirm_password = $('#confirm_password').val();
    $('#confirm_passworderror').text('');
    $('#passmatch').remove();
    if (confirm_password != password) {
        let msg = "Password does not match!";
        $('#con-password-field').after('<span class="text-danger" id="passmatch">' + msg + '</span>');
    }
});

function checkUsername(username) {
    $.ajax({
        type: "POST",
        url: "auth.php",
        data: {
            'formaction': 'check_username',
            'username': username
        },
        success: function(username) {
            if (username == 1) {
                msg = '<p class="text-danger" id="usernameerror"> Username already exists! </p>';
                $('#username-field').after('<span class="text-danger" id="usernamemsg">' + msg + '</span>');
                $('#user_exist').val(1);
            } else {
                $('#usernamemsg').remove();
                $('#user_exist').val(0);
            }
        }
    });
}