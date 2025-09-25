<?php
session_start();
include_once "config/database.php";
include_once "includes/db_operations.php";
require_once "includes/common_functions.php";
$obj = new DbOperations();
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
$page = 'msa-view';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSA Table</title>
    <link href="assets/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/lib/datatable/datatable.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="assets/lib/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/lib/toast-simple-notify/simple-notify.min.css" />
    
</head>

<body>
    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/navbar.php'; ?>
    <div class="main-page">
    <div class="content mt-5">
        <div class="col-md-12" style="display: flex; justify-content: space-between; align-items: center;">
            <h4>MSA Table</h4>
        </div>
        <hr>

        <table class="table table-bordered" id="msa-table">
            <thead>
                <th class="text-center">Gauge Name</th>
                <th class="text-center">Gauge Type</th>
                <th class="text-center">Gauge Number</th>
                <th class="text-center">No. of Operators</th>
                <th class="text-center">No. of Trials</th>
                <th class="text-center">No. of Parts</th>
                <th class="text-center">Characteristics</th>
                <th class="text-center">Specifications</th>
                <th class="text-center">Test number</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM msa_form_new ORDER BY msa_id DESC";
                $msaDts = $obj->select($query);
                
                foreach ($msaDts as $msaDt) {
                ?>
                    <tr class="text-center">
                        <td><?php echo $msaDt['gauge_name']; ?></td>
                        <td><?php echo $msaDt['gauge_type']; ?></td>
                        <td><?php echo $msaDt['gauge_number']; ?></td>
                        <td><?php echo $msaDt['operators']; ?></td>
                        <td><?php echo $msaDt['trials']; ?></td>
                        <td><?php echo $msaDt['parts']; ?></td>
                        <td><?php echo $msaDt['characteristic']; ?></td>
                        <td><?php echo $msaDt['specification']; ?></td>
                        <td><?php echo $msaDt['test_number']; ?></td>
                        <td><?php echo $msaDt['status']; ?></td>
                        <td><a href="msa_report.php?msa_id=<?php echo $msaDt['msa_id']; ?>"><i class="fa fa-eye"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>

    <?php // include 'includes/footer.php'; ?>
    <script src="assets/lib/datatable/datatable.min.js"></script>
    <script src="assets/lib/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validation.js"></script>
    <script src="assets/js/gauge.js"></script>
    <script src="assets/lib/toast-simple-notify/simple-notify.min.js"></script>
    <script>
        var table = $('#msa-table').DataTable({
            orderCellsTop: false,
            language: {
                search: '<span>Filter:</span> _INPUT_',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {
                    'first': 'First',
                    'last': 'Last',
                    'next': '&rarr;',
                    'previous': '&larr;'
                },
                "emptyTable": "No Data Found",
            }
        });
    </script>
</body>

</html>