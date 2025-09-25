<?php
session_start();
include "includes/db_operations.php";
$obj = new DbOperations();
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
$page = 'msa-report';

$msa_id = htmlspecialchars($_GET['msa_id']);
$query = "SELECT * FROM msa_form_new WHERE msa_id = $msa_id";
$msaDts = $obj->fetchOne($query);

$gauge_name = $msaDts['gauge_name'];
$gauge_type = $msaDts['gauge_type'];
$gauge_number =  $msaDts['gauge_number'];
$numofoperators =  $msaDts['operators'];
$numoftrials =  $msaDts['trials'];
$numofparts =  $msaDts['parts'];
$characteristic =  $msaDts['characteristic'];
$specification =  $msaDts['specification'];
$test_number =  $msaDts['test_number'];
$k1 = 4.56;
$k2 = 3.65;
$k3 = 1.62;
$query = "SELECT * FROM msa_part_data WHERE msa_id = $msa_id";
$msa_part_data = $obj->select($query);
$query = "SELECT * FROM avg_ran WHERE msa_id = $msa_id";
$avg_ran = $obj->select($query);
$query = "SELECT * FROM part_avg WHERE msa_id = $msa_id";
$part_avg = $obj->select($query);
$query = "SELECT * FROM double_avg_range WHERE msa_id = $msa_id";
$dou_avg_ran = $obj->select($query);
$selected_op = array_column($dou_avg_ran, 'operator');
$query = "SELECT * FROM msa_additional_data WHERE msa_id = $msa_id";
$additional = $obj->fetchone($query);
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
    <div class="main-page">
    <div class="content mt-5">
        <button class="btn btn-primary" onclick="createPDF()"> Print</button>
        <div id="msa_part_data">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <td colspan="<?php echo $numofparts + 4; ?>" class="text-center text-bold ">
                            <h2>R & R DATA SHEET</h2>
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">Operators</th>
                        <th class="align-middle text-center">Trials no.</th>
                        <th colspan="<?php echo $numofparts; ?>" class="align-middle text-center">Parts</th>
                        <th colspan="2" class="align-middle text-center">Average</th>
                    </tr>

                    <!-- parts -->

                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <?php
                        for ($i = 1; $i <= $numofparts; $i++) { ?>
                            <th><?php echo $i; ?></th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody>
                    <input type="hidden" name="form_action" id="form_action" value="update_msa_data">
                    <?php foreach ($dou_avg_ran as $dou_key => $dou_data) { ?>

                        <!-- operators -->

                        <tr>
                            <td rowspan="<?php echo $numoftrials + ($numoftrials + 2); ?>" class="align-middle text-center">
                                <?php
                                $query = "SELECT * FROM users WHERE id= :user_id AND status = :status";
                                $params = ["user_id" => $dou_data['operator'], "status" => 'active'];
                                $operatorDt = $obj->fetchOne($query, $params);

                                echo $operatorDt['first_name'] . " " . $operatorDt['last_name'];
                                ?>
                            </td>
                        </tr>
                        <tr>

                            <!-- part data -->

                            <?php for ($trial = 1; $trial <= $numoftrials; $trial++) { ?>
                        <tr>
                            <?php $query = "SELECT * FROM msa_part_data WHERE msa_id = :msa_id AND operator = :operator AND trial = :trial";
                                $params = ["msa_id" => $msa_id, "operator" => $dou_data['operator'], "trial" => $trial];
                                $partDts = $obj->select($query, $params);
                            ?>
                        </tr>
                        <tr>
                            <th class="text-center"><?php echo $trial; ?> </th>
                            <?php foreach ($partDts as $part_key => $partDt) { ?>

                                <input type="hidden" name="part_ids_<?php echo $dou_key; ?>_<?php echo $trial; ?>_<?php echo $part_key; ?>" value="<?php echo $partDt['id']; ?>">

                                <td class="text-center"><?php echo $partDt['part_data']; ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    </tr>

                    <!-- average -->

                    <tr>
                        <th class="text-center">Average</th>
                        <td>&nbsp;</td>
                        <?php for ($i = 1; $i <= $numofparts; $i++) {
                            $query = "SELECT * FROM avg_ran WHERE msa_id = $msa_id AND operator = '$dou_data[operator]' AND part = '$i'";
                            $avg_ran_data = $obj->fetchOne($query); ?>

                            <input type="hidden" name="avg_ran_id_<?php echo $dou_key; ?>_<?php echo $i; ?>" value="<?php echo $avg_ran_data['id']; ?>">

                            <td class="text-center"><?php echo $avg_ran_data['average'] ?></td>
                        <?php } ?>

                        <?php
                        $query = "SELECT * FROM double_avg_range WHERE msa_id = $msa_id AND operator = '$dou_data[operator]'";
                        $dou_avg_range = $obj->fetchOne($query); ?>
                        <td>X<?php echo $dou_key + 1; ?>=</td>

                        <input type="hidden" name="dou_avg_ran_id_<?php echo $dou_key; ?>" value="<?php echo $dou_avg_range['id']; ?>">

                        <td class="text-center"> <?php echo $dou_avg_range['double_avg'] ?></td>
                    </tr>

                    <!-- range -->

                    <tr>
                        <th class="text-center">Range</th>
                        <td>&nbsp;</td>

                        <?php for ($i = 1; $i <= $numofparts; $i++) {
                            $query = "SELECT * FROM avg_ran WHERE msa_id = $msa_id AND operator = '$dou_data[operator]' AND part = '$i'";
                            $avg_ran_data = $obj->fetchOne($query); ?>
                            <td class="text-center"><?php echo $avg_ran_data['ranges'] ?></td>
                        <?php } ?>

                        <?php
                        $query = "SELECT * FROM double_avg_range WHERE msa_id = $msa_id AND operator = '$dou_data[operator]'";
                        $dou_avg_range = $obj->fetchOne($query); ?>
                        <td>R<?php echo $dou_key + 1; ?>=</td>
                        <td class="text-center"> <?php echo $dou_avg_range['double_range'] ?></td>

                    </tr>
                    <tr>
                        <td colspan="<?php echo $numofparts + 4; ?>">&nbsp;</td>
                    </tr>
                <?php } ?>


                <!-- part average -->

                <tr>
                    <th colspan="2" class="text-center">Part Average</th>
                    <?php foreach ($part_avg as $part_key => $part_avg_data) { ?>

                        <input type="hidden" name="part_avg_id_<?php echo $part_key; ?>" value="<?php echo $part_avg_data['id']; ?>">

                        <td class="text-center"><?php echo $part_avg_data['part_avg']; ?></td>
                    <?php } ?>
                    <td>Rp=</td>

                    <input type="hidden" name="additional_id" value="<?php echo $additional['id']; ?>">

                    <td class="text-center"> <?php echo $additional["Rp"]; ?></td>
                </tr>

                <!-- data -->

                <tr>
                    <td colspan="<?php echo $numofparts + 2; ?>">&nbsp;</td>
                    <td>R =</td>
                    <td class="text-center"> <?php echo $additional["R"]; ?></td>
                </tr>
                <tr>
                    <td colspan="<?php echo $numofparts + 2; ?>">&nbsp;</td>
                    <td class="text-center">X Diff =</td>
                    <td class="text-center"> <?php echo $additional["xdiff"]; ?></td>
                </tr>
                <tr>
                    <td colspan="<?php echo $numofparts + 4; ?>">&nbsp;</td>
                </tr>

                <!-- measurement report/ equipment variation -->

                <tr>
                    <td colspan="<?php echo $numofparts + 4; ?>" class="text-center"><b>MEASUREMENT REPORT</b></td>
                </tr>
                <tr>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center"><b>MEASUREMENT UNIT ANALYSIS</b></td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center"><b>% PROCESS VARIATION</b></td>
                </tr>
                <tr>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center"><b>REPEATIBILITY - EQUIPMENT VARIATION(EV)</b></td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>">&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">R = <?php echo $additional["R"]; ?></td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>">&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">K1 =<?php echo $additional["k1"]; ?></td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">%EV = 100[EV/TV]</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">EV= R X K1</td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">= <?php echo $additional["pct_ev"]; ?> %</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>"> = <?php echo $additional["ev"]; ?></td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>">&nbsp;</td>
                </tr>

                <!-- appraiser variation -->

                <tr>
                    <td colspan="<?php echo $numofparts + 4; ?>">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center"><b>REPRODUCIBILITY - APPRAISER VARIATION(AV)</b></td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>">&nbsp;</td>

                </tr>
                <tr>
                    <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">X Diff= <?php echo $additional["xdiff"]; ?> n= No. of Parts = <?php echo $numofparts; ?></td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">%AV = 100[AV/TV]</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">K2= <?php echo $additional["k2"]; ?>, r= No. of Trials = <?php echo $numoftrials; ?></td>
                    <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">= <?php echo $additional["pct_av"]; ?> %</td>
                </tr>
                <tr>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">AV = Sqrt of[(X Diff X K2)^2 - (EV^2/nr)] = <?php echo $additional["av"]; ?></td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="<?php echo $numofparts + 4; ?>">&nbsp;</td>
                </tr>

                <!-- R & R -->

                <tr>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center"><b>REPRODUCIBILITY & REPEATABILITY (R & R)</b></td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">R & R = Sqrt of(EV^2 + AV^2)</td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">% R&R = 100[R&R/TV]</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">= <?php echo $additional["r_r"]; ?></td>
                    <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">= <?php echo $additional["pct_r_r"]; ?> %</td>
                </tr>
                <tr>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>">&nbsp;</td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="<?php echo $numofparts + 4; ?>">&nbsp;</td>
                </tr>

                <!-- part variation -->

                <tr>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center"><b>PART VARIATION(PV)</b></td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>">&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">Rp = <?php echo $additional["Rp"]; ?>, K3 = <?php echo $additional["k3"]; ?></td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">% PV = 100[PV/TV]</td>
                </tr>
                <tr>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">PV = Rp x K3</td>
                    <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">= <?php echo $additional["pct_pv"]; ?> %</td>
                </tr>
                <tr>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">= <?php echo $additional["pv"]; ?></td>
                    <td colspan="<?php echo ($numofparts + 5) / 2; ?>">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="<?php echo $numofparts + 4; ?>">&nbsp;</td>
                </tr>

                <!-- total variation -->

                <tr>
                    <td colspan="<?php echo $numofparts + 4; ?>" class="text-center"><b>TOTAL VARIATION(TV)</b></td>
                </tr>
                <tr>
                    <td colspan="<?php echo $numofparts + 4; ?>" class="text-center">TV = Sqrt of (R&R^2 + PV^2)</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="<?php echo $numofparts + 4; ?>">= <?php echo $additional["tv"]; ?></td>
                </tr>
                <tr>
                    <td colspan="<?php echo $numofparts + 4; ?>">&nbsp;</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <?php // include 'includes/footer.php'; ?>
    <script src="assets/lib/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validation.js"></script>
    <script src="assets/js/partdata.js"></script>
    <script src="assets/lib/toast-simple-notify/simple-notify.min.js"></script>

    <!-- PDF Generate -->
    <script src="https://cdn.bootcss.com/html2pdf.js/0.9.1/html2pdf.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>
    <script>
        function createPDF() {
            var element = document.getElementById('msa_part_data');
            html2pdf(element, {
                margin: 1,
                padding: 0,
                filename: 'MSA Part Data.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2,
                    logging: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A3',
                    orientation: 'L'
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                }, // Adjust page break settings
                class: createPDF
            });
        };
    </script>
    <!-- End PDF Generate -->

</body>

</html>