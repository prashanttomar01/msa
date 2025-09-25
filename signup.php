<?php
session_start();
require_once __DIR__ . "/includes/common_functions.php";

if (isset($_SESSION['user_id'])) {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/css/signup.css">
    <link href="assets/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="assets/lib/bootstrap/bootstrap.bundle.min.js"></script>

    <script src="assets/lib/jquery/jquery.min.js"></script>

</head>

<body>

    <div class="container w-50">
        <h1>Sign Up</h1>
        <?php echo signup(); ?>
        <form action="signup.php" method="POST" id="signupform" class="form-horizontal">
            <fieldset class="content-group">

                <label for="username" class="control-label col-lg">User Name:</label>
                <div class="form-group" id="username-field">
                    <input type="text" id="username" name="username" placeholder="Enter your user name" class="form-control " onkeyup="checkUsername(this.value)">
                </div>

                <label for="email" class="control-label col-lg">Email:</label>
                <div class="form-group" id="email-field">

                    <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control ">
                </div>

                <label for="password" class="control-label col-lg">Password:</label>
                <div class="form-group" id="password-field">
                    <input type="password" id="password" name="password" placeholder="Enter your password"
                        class="form-control ">
                </div>

                <label for="confirm_password" class="control-label col-lg">Confirm Password:</label>
                <div class="form-group" id="con-password-field">
                    <input type="password" id="confirm_password" name="confirm_password"
                        placeholder="Confirm your password" class="form-control">
                </div>
                <input type="hidden" id="user_exist">
            </fieldset>
            <div class="text-center">
                <button type="submit" name="signupbtn" id="signupbtn" class="btn btn-primary btn-lg">Sign Up</button>
            </div>
        </form>
        <p class="text-center">Already have an account? <a href="login.php" class="text-decoration-none">login</a></p>
        <!-- <button class="login-button">Login</button> -->
    </div>

    <script src="assets/js/signup.js"></script>

</body>

</html>