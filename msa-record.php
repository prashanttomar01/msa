<?php
session_start();
include_once "config/database.php";
include_once "includes/db_operations.php";
require_once "includes/common_functions.php";
$obj = new DbOperations();
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
$page = 'msa-record';
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
            <button type="button" class="btn btn-primary" id="btn-modal"><i class="fa fa-plus"></i>&nbsp; MSA</button>
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
                        <td><a href="msa-form.php?msa_id=<?php echo $msaDt['msa_id']; ?>"><i class="fa fa-eye"></i></a></td>
                        <!-- <td><i class="fa fa-pencil text-info" onclick="msaEdit(<?php echo $msaDt['msa_id']; ?>)" id="icon-modal"></i>&nbsp;<i class="fa fa-trash text-danger" onclick="msaDelete(<?php echo $msaDt['msa_id']; ?>)" id="del-user"></i></td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="msa-modal" tabindex="-1" aria-labelledby="msaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="msaModalLabel">Add MSA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="msa-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="gauge_name" id="gauge_name" class="form-control required">
                                    <label for="gauge_name">Gauge Name:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="gauge_type" id="gauge_type" class="form-control required">
                                    <label for="gauge_type">Gauge Type:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="gauge_number" id="gauge_number" class="form-control required">
                                    <label for="gauge_number">Gauge Number:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="operators" id="operators" class="form-control required">
                                    <label for="operators">Operators:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="trials" id="trials" class="form-control required">
                                    <label for="trials">Trials:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="parts" id="parts" class="form-control required">
                                    <label for="parts">Parts:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="characteristic" id="characteristic" class="form-control required">
                                    <label for="characteristic">Characteristic:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="specification" id="specification" class="form-control required">
                                    <label for="specification">Specification:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="test_number" id="test_number" class="form-control required">
                                    <label for="test_number">Test Number:</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="form_action" id="form_action" value="create_msa">
                        <input type="hidden" name="msa_id" id="msa_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-submit">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete modal -->

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="del-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="text-bold">Delete Confirmation!!</h6>
                </div>
                <div class="modal-body">
                    <p class="modal-title fs-5" id="userModalLabel">Are you sure??</p>
                    <input type="text" name="msa_id" id="del_msa_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="modal-btn-no" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-yes" onclick="removeUser()">Yes</button>
                </div>
            </div>
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