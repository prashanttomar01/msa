$("#loginform").on("submit", function (e) {
    var validForm = true;
    let username = password = msg = '';

    username = $('#username').val();
    $('#usernamemsg').remove()
    if (username == "") {  
        validForm = false;              
        msg = '<p class="text-danger" id="usernameerror"> Username is required! </p>';
        $('#username-field').after('<span class="text-danger" id="usernamemsg">' + msg + '</span>');
    }

    password = $('#password').val();
    $('#passmsg').remove();
    if (password == "") { 
        validForm = false;             
        msg = '<p class="text-danger" id="passworderror"> Password is required! </p>';
        $('#password-field').after('<span class="text-danger" id="passmsg">' + msg + '</span>');
    }
    if(validForm){
        return true;
    }
    else{
        e.preventDefault();
        return false;
    }
});
    $('#username').on('keyup', function () {
    let username = $('#username').val();
    if (username != "") {
        $('#usernameerror').text('');
    }
});
$('#password').on('keyup', function () {
    let password = $('#password').val();
    if (password != "") {
        $('#passworderror').text('');
    }
});
