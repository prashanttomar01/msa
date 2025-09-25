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
    <title>Login Page</title>
    <link href="assets/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="assets/lib/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/jquery/jquery.min.js"></script>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card p-4 shadow-lg rounded-3 w-50">
        <h3 class="text-center mb-3">Login</h3>
        <?php echo login(); ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="loginform">

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="form-group" id="username-field">
                    <input type="username" name="username" class="form-control" id="username" placeholder="Enter your username">
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="form-group" id="password-field">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                </div>
            </div>

            <button type="submit" name="loginbtn" id="loginbtn" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="text-center mt-3">
            <a href="#" class="text-decoration-none">Forgot password?</a>
        </div>
        <p class="text-center">Don't have any account? <a href="signup.php" class="text-decoration-none">SignUp</a></p>
    </div>
    <script src="assets/js/login.js"></script>
</body>

</html>