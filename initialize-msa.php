<?php
session_start();
require_once "includes/common_functions.php";
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
$page = 'initialize-msa';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="assets/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="assets/lib/bootstrap/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/lib/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/lib/toast-simple-notify/simple-notify.min.css" />
</head>

<body>
    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/navbar.php'; ?>
    <div class="content mt-5">
        <div class="col-md-12 text-center">
            <h2>Msa form</h2>
        </div>
        <hr>
        <form id="msa-form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="gauge-name" id="gauge-name" class="form-control">
                        <label for="gauge-name">Gauge name :</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="gauge-type" id="gauge-type" class="form-control">
                        <label for="gauge-type">Gauge type :</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="number" name="gauge-number" id="gauge-number" class="form-control">
                        <label for="gauge-number">Gauge Number :</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="operators" id="operators">
                        <label for="operators">No. of Operators :</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="trials" id="trials">
                        <label for="trials">No. of Trials :</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="parts" id="parts">
                        <label for="parts">No. of Parts :</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="characteristic" id="characteristic" class="form-control">
                        <label for="characteristic">Characteristics :</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="specification" id="specification" class="form-control">
                        <label for="specification">Specification :</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="number" name="test-number" id="test-num" class="form-control">
                        <label for="test-num">Test number :</label>
                    </div>
                </div>
            </div>
            <input type="hidden" name="form_action" id="form_action" value="create_msa">
            <div class="text-center">
                <button type="reset" class="btn btn-secondary" id="btn-reset">Cancel</button>
                <button type="submit" class="btn btn-primary" name="btn-submit" id="btn-submit">Submit</button>
            </div>
        </form>
    </div>
    <?php // include 'includes/footer.php'; ?>
    <script src="assets/js/validation.js"></script>
    <script src="assets/js/msa-form.js"></script>
    <script src="assets/lib/toast-simple-notify/simple-notify.min.js"></script>
</body>

</html>