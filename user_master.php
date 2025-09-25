<?php
session_start();
include_once "config/database.php";
include_once "includes/db_operations.php";
require_once "includes/common_functions.php";
$obj = new DbOperations();
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Master</title>
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
                <h4>User Master</h4>
                <button type="button" class="btn btn-primary" id="btn-modal"><i class="fa fa-plus"></i>&nbsp; User</button>
            </div>
            <hr>

            <table class="table table-bordered" id="user-table">
                <thead>
                    <th class="text-center">Name</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM users";

                    $userDts = $obj->select($query);
                    foreach ($userDts as $userDt) {
                    ?>
                        <tr class="text-center">
                            <td><?php echo $userDt['first_name'] . $userDt['last_name']; ?></td>
                            <td><?php echo $userDt['username']; ?></td>
                            <td><?php echo $userDt['email']; ?></td>
                            <td><?php echo $userDt['phone']; ?></td>
                            <td><?php echo $userDt['status']; ?></td>
                            <td><i class="fa fa-pencil text-info" onclick="userEdit(<?php echo $userDt['id'] ?>)" id="icon-modal"></i>&nbsp;<i class="fa fa-trash text-danger del-user" onclick="showModal()" id="del-user"></i></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="user-modal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userModalLabel">Add User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="user-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="first_name" id="first_name" class="form-control required">
                                    <label for="first_name">First name:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="last_name" id="last_name" class="form-control required">
                                    <label for="last_name">Last name:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="username" id="username" class="form-control required">
                                    <label for="username">Username:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" id="password" class="form-control required">
                                    <label for="password">Password:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="email" id="email" class="form-control required">
                                    <label for="email">Email:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="phone" id="phone" class="form-control required">
                                    <label for="phone">Phone:</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="form_action" id="form_action" value="create_user">
                        <input type="hidden" name="user_id" id="user_id">
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

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userModalLabel">Are you sure??</h1>
                    <button type="button" class="close text-right" aria-label="Close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="modal-btn-yes" onclick="removeUser(<?php echo $userDt['id'] ?>)">yes</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-no" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <?php // include 'includes/footer.php'; ?>
    <script src="assets/lib/datatable/datatable.min.js"></script>
    <script src="assets/lib/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validation.js"></script>
    <script src="assets/js/user.js"></script>
    <script src="assets/lib/toast-simple-notify/simple-notify.min.js"></script>
</body>

</html>