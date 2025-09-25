<?php
session_start();
include "includes/db_operations.php";
$obj = new DbOperations();
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
$page = 'msa-form';

$msa_id = htmlspecialchars($_GET['msa_id']);
$query = "SELECT * FROM msa_form_new WHERE msa_id = $msa_id";
$msaDts = $obj->fetchOne($query);

$gauge_name = $msaDts['gauge_name'];
$gauge_type = $msaDts['gauge_type'];
$gauge_number =  $msaDts['gauge_number'];
$operators =  $msaDts['operators'];
$trials =  $msaDts['trials'];
$parts =  $msaDts['parts'];
$characteristic =  $msaDts['characteristic'];
$specification =  $msaDts['specification'];
$test_number =  $msaDts['test_number'];
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
            <h2>R & R DATA SHEET</h2>
        </div>
        <hr>

        <table class="table table-bordered">

            <!-- for operator 1 -->

            <thead>
                <tr>
                    <th rowspan="2" class="align-middle">Operators</th>
                    <th rowspan="2" class="align-middle text-center">Trials no.</th>
                    <th colspan="10" class="text-center">Parts</th>
                    <th colspan="2" rowspan="2" class="align-middle text-center">Average</th>
                </tr>
                <?php 
                for($i=1; $i<=$parts; $i++) { ?>
                <tr>
                    <th><?php echo $i; ?></th>
                </tr>
                <?php } ?>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="3" class="align-middle text-center"> 
                            <?php
                            $query = "SELECT * FROM users WHERE status = :status";
                            $params = ["status"=>'active'];
                            $operators = $obj->select($query, $params); 
                             ?>
                        <select name="operators[]" id="operators" class="form-select">
                            <?php 
                            foreach($operators as $operator) {

                            ?>
                            <option value="<?php echo $operator["id"]; ?>"> <?php echo $operator["first_name"]. " " .$operator["last_name"]; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>1</td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td colspan="2">&nbsp;</td>

                </tr>

                <!-- average section -->

                <tr>
                    <th class="text-center">Average</th>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>

                </tr>

                <!-- Range -->

                <tr>
                    <th class="text-center">Range</th>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>

           
                <!-- part average -->

                <tr>
                    <td colspan="14">&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="2" class="text-center">Part Average</th>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td><input type="number" name="" id="" class="form-control"></td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <!-- dynamic -->
                 
                <tr>
                    <th class="text-center">Average</th>
                    <?php
                    for ($i = 1; $i <= $parts; $i++) { ?>
                        <td><input type="number" name="" id="" class="form-control"></td>
                    <?php } ?>

                </tr>
                <tr>
                    <th class="text-center">Range</th>
                    <?php
                    for ($i = 1; $i <= $parts; $i++) { ?>
                        <td><input type="number" name="" id="" class="form-control"></td>
                    <?php } ?>
                </tr>

                <!-- part average -->

                <tr>
                    <td colspan="14">&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="2" class="text-center">Part Average</th>
                    <?php
                    for ($i = 1; $i <= $parts; $i++) { ?>
                        <td><input type="number" name="" id="" class="form-control"></td>
                    <?php } ?>
                </tr>
                <!-- end -->
                <tr>
                    <td colspan="14">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="12">&nbsp;</td>
                    <td>R =</td>
                    <td><input type="number" name="rangeavg" id="rangeavg" placeholder="0"></td>
                </tr>
                <tr>
                    <td colspan="12">&nbsp;</td>
                    <td class="text-center">X Diff =</td>
                    <td class="text-center"><input type="number" name="diff" id="diff" placeholder="#DIV/01"></td>
                </tr>
                <tr>
                    <td colspan="14">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="14" class="text-center"><b>MEASUREMENT REPORT</b></td>
                </tr>
                <tr>
                    <td colspan="7" class="text-center"><b>MEASUREMENT UNIT ANALYSIS</b></td>
                    <td colspan="7" class="text-center"><b>% PROCESS VARIATION</b></td>
                </tr>
                <tr>
                    <td colspan="7" class="text-center"><b>REPEATIBILITY - EQUIPMENT VARIATION(EV)</b></td>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <!-- <td rowspan="2">&nbsp;</td> -->
                    <td class="text-center" colspan="7">R =<input type="number" name="" id=""></td>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="7">K1 =<input type="number" name="" id=""></td>
                    <td colspan="7" class="text-center">%EV = 100[EV/TV]</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="7">EV= R X K1</td>
                    <td colspan="7" class="text-center"><input type="number" name="" id="" placeholder="=25.71"></td>
                </tr>
                <tr>
                    <td class="text-center" colspan="7"><input type="number" name="" id="" placeholder="2687.80"></td>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="14">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="7" class="text-center"><b>REPRODUCIBILITY - APPRAISER VARIATION(EV)</b></td>
                    <td colspan="7">&nbsp;</td>

                </tr>
                <tr>
                    <td class="text-center" colspan="7">X Diff= <input type="number" name="" id="" placeholder="5.60"> n= No. of Parts <input type="number" name="" id="" placeholder="5"></td>
                    <td colspan="7" class="text-center">%AV = 100[AV/TV]</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="7">K2= <input type="number" name="" id="" placeholder="1800"> r= No. of Trials <input type="number" name="" id="" placeholder="2"></td>
                    <td class="text-center" colspan="7"><input type="number" name="" id="" placeholder="= 965078.27"></td>
                </tr>
                <tr>
                    <td colspan="7" class="text-center">AV = Sqrt of[(X Diff X K2)^2 - (EV^2/nr)] <input type="number" name="" id="" placeholder="= 100883973.1"></td>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="14">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-center"><b>REPRODUCIBILITY & REPEATABILITY (R & R)</b></td>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-center">R & R = Sqrt of(EV^2 + AV^2)</td>
                    <td colspan="7" class="text-center">% R&R = 100[R&R/TV]</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="7"><input type="number" name="" id="" placeholder="10397.51"></td>
                    <td class="text-center" colspan="7"><input type="number" name="" id="" placeholder="=99.46"></td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="14">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-center"><b>PART VARIATION(PV)</b></td>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="7">Rp = <input type="number" name="" id="" placeholder="36.00"> K3 = <input type="number" name="" id="" placeholder="30"></td>
                    <td colspan="7" class="text-center">% PV = 100[PV/TV]</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-center">PV = Rp x K3</td>
                    <td class="text-center" colspan="7"><input type="number" name="" id="" placeholder="=10.33"></td>
                </tr>
                <tr>
                    <td colspan="7" class="text-center"><input type="number" name="" id="" placeholder="=1080.00"></td>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="14">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="14" class="text-center"><b>TOTAL VARIATION(TV)</b></td>
                </tr>
                <tr>
                    <td colspan="14" class="text-center">TV = Sqrt of (R&R^2 + PV^2)</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="14"><input type="number" name="" id="" placeholder="=10453.45"></td>
                </tr>
                <tr>
                    <td colspan="14">&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/validation.js"></script>
    <script src="assets/js/msa-form.js"></script>
    <script src="assets/lib/toast-simple-notify/simple-notify.min.js"></script>
</body>

</html>