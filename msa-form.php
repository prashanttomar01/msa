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
$numofoperators =  $msaDts['operators'];
$numoftrials =  $msaDts['trials'];
// echo '<pre>';
// print_r($msaDts);
// die;
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
// echo '<pre>';
// print_r($msa_part_data);
// die;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/navbar.php'; ?>
    <div class="main-page">
        <div class="content mt-5">
            <div class="col-md-12 text-center">
                <h2>R & R DATA SHEET</h2>
            </div>
            <hr>
            <form id="msa_part_data">
                <input type="hidden" name="msa_id" id="msa_id" value="<?php echo $msa_id; ?>">
                <input type="hidden" name="numoftrials" id="numoftrials" value="<?php echo $numoftrials; ?>">
                <input type="hidden" name="numofparts" id="numofparts" value="<?php echo $numofparts; ?>">
                <input type="hidden" name="numofoperators" id="numofoperators" value="<?php echo $numofoperators; ?>">

                <table class="table table-bordered">

                    <!-- for operator 1 -->

                    <thead>
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
                        <?php if (count($msa_part_data) == 0) { ?>
                            <input type="hidden" name="form_action" id="form_action" value="insert_msa_data">
                            <?php for ($k = 1; $k <= $numofoperators; $k++) {  ?>
                                <tr>
                                    <td rowspan="<?php echo $numoftrials + 1; ?>" class="align-middle text-center">
                                        <?php
                                        $query = "SELECT * FROM users WHERE status = :status";
                                        $params = ["status" => 'active'];
                                        $operatorDts = $obj->select($query, $params);
                                        ?>
                                        <select name="operators[]" id="operators" class="form-select">
                                            <?php foreach ($operatorDts as $operatorDt) {   ?>
                                                <option value="<?php echo $operatorDt["id"]; ?>"> <?php echo $operatorDt["first_name"] . " " . $operatorDt["last_name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>

                                <!-- trials -->
                                <?php for ($trial = 1; $trial <= $numoftrials; $trial++) { ?>
                                    <tr>
                                        <th class="text-center"><?php echo $trial; ?> </th>
                                        <?php for ($j = 1; $j <= $numofparts; $j++) { ?>
                                            <td><input type="number" name="part_data_<?php echo $k; ?>_<?php echo $trial; ?>_<?php echo $j; ?>" id="partDt_<?php echo $k; ?>_<?php echo $trial; ?>_<?php echo $j; ?>" onchange="calAvg(<?php echo $k; ?>, <?php echo $trial; ?>, <?php echo $j; ?>); calRange(<?php echo $k; ?>, <?php echo $trial; ?>, <?php echo $j; ?>); calPartavg(<?php echo $k; ?>, <?php echo $j; ?>); caldouavg(<?php echo $k; ?>); caldouRange(<?php echo $k; ?>); partRange(<?php echo $i; ?>); ranAvg(<?php echo $k; ?>); avgRange(<?php echo $k; ?>); getValue(); calcEV(); calcAV(); calcRR(); calcPV(); calcTV(); pctEV(); pctAV(); pctRR(); pctPV()" class="form-control partDt partDt2_<?php echo $k; ?>_<?php echo $j; ?> required"></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>

                                <!-- average -->
                                <tr>
                                    <th class="text-center">Average</th>
                                    <td>&nbsp;</td>
                                    <?php

                                    for ($i = 1; $i <= $numofparts; $i++) { ?>
                                        <td><input type="number" name="average_<?php echo $k; ?>_<?php echo $i; ?>" id="avg_<?php echo $k; ?>_<?php echo $i; ?>" class="form-control average partsavg_<?php echo $i; ?> doubavg_<?php echo $k; ?>" readonly></td>
                                    <?php } ?>


                                    <td>X<?php echo $k; ?>=</td>
                                    <td><input type="number" name="douaverage_<?php echo $k; ?>" id="douavg_<?php echo $k; ?>" class="averages" readonly></td>
                                </tr>

                                <!-- range -->
                                <tr>
                                    <th class="text-center">Range</th>
                                    <td>&nbsp;</td>
                                    <?php
                                    for ($i = 1; $i <= $numofparts; $i++) { ?>
                                        <td><input type="number" name="range_<?php echo $k; ?>_<?php echo $i; ?>" id="ran_<?php echo $k; ?>_<?php echo $i; ?>" class="form-control partsrange_<?php echo $k ?>" readonly></td>
                                    <?php } ?>
                                    <td>R<?php echo $k; ?>=</td>
                                    <td><input type="number" name="dourange_<?php echo $k; ?>" id="dourange_<?php echo $k; ?>" class="ranges" readonly></td>
                                </tr>

                                <tr>
                                    <td colspan="<?php echo $numofparts + 4; ?>">&nbsp;</td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <input type="hidden" name="form_action" id="form_action" value="update_msa_data">
                            <?php foreach ($dou_avg_ran as $dou_key => $dou_data) { ?>

                                <tr>
                                    <td rowspan="<?php echo $numoftrials + ($numoftrials + 2); ?>" class="align-middle text-center">
                                        <?php
                                        $query = "SELECT * FROM users WHERE status = :status";
                                        $params = ["status" => 'active'];
                                        $operatorDts = $obj->select($query, $params);
                                        ?>
                                        <select name="operators[]" id="operators" class="form-select">
                                            <?php foreach ($operatorDts as $operator_key => $operatorDt) {
                                                $selected = ($operatorDt["id"] == $selected_op[$dou_key]) ? 'selected' : ''; ?>
                                                <option value="<?php echo $operatorDt["id"]; ?>" <?php echo $selected; ?>> <?php echo $operatorDt["first_name"] . " " . $operatorDt["last_name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- <tr> -->
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

                                        <td><input type="number" name="part_data_<?php echo $dou_key; ?>_<?php echo $trial; ?>_<?php echo $part_key; ?>" id="partDt_<?php echo $dou_key; ?>_<?php echo $trial; ?>_<?php echo $part_key + 1; ?>" onchange="calAvg(<?php echo $dou_key; ?>, <?php echo $trial; ?>, <?php echo $part_key + 1; ?>); calRange(<?php echo $dou_key; ?>, <?php echo $trial; ?>, <?php echo $part_key + 1; ?>); calPartavg(<?php echo $dou_key; ?>, <?php echo $part_key + 1; ?>); caldouavg(<?php echo $dou_key; ?>); caldouRange(<?php echo $dou_key; ?>); partRange(<?php echo $part_key + 1; ?>); ranAvg(<?php echo $dou_key; ?>); avgRange(<?php echo $dou_key; ?>); getValue(); calcEV(); calcAV(); calcRR(); calcPV(); calcTV(); pctEV(); pctAV(); pctRR(); pctPV()" class="form-control partDt partDt2_<?php echo $dou_key; ?>_<?php echo $part_key + 1; ?> required" value="<?php echo $partDt['part_data']; ?>"></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            </tr>

                            <!-- average -->

                            <tr>
                                <th class="text-center">Average</th>
                                <td>&nbsp;</td>
                                <?php
                                if (count($avg_ran) == 0) {
                                    for ($i = 1; $i <= $numofparts; $i++) { ?>
                                        <td><input type="number" name="average_<?php echo $dou_key; ?>_<?php echo $i; ?>" id="avg_<?php echo $dou_key; ?>_<?php echo $i; ?>" class="form-control average partsavg_<?php echo $i; ?> doubavg_<?php echo $dou_key; ?>" readonly></td>
                                    <?php } ?>
                                    <?php } else {
                                    for ($i = 1; $i <= $numofparts; $i++) {
                                        $query = "SELECT * FROM avg_ran WHERE msa_id = $msa_id AND operator = '$dou_data[operator]' AND part = '$i'";
                                        $avg_ran_data = $obj->fetchOne($query); ?>

                                        <input type="hidden" name="avg_ran_id_<?php echo $dou_key; ?>_<?php echo $i; ?>" value="<?php echo $avg_ran_data['id']; ?>">

                                        <td><input type="number" name="average_<?php echo $dou_key; ?>_<?php echo $i; ?>" id="avg_<?php echo $dou_key; ?>_<?php echo $i; ?>" class="form-control average partsavg_<?php echo $i; ?> doubavg_<?php echo $dou_key; ?>" value="<?php echo $avg_ran_data['average'] ?>" readonly></td>
                                    <?php } ?>

                                    <?php
                                    $query = "SELECT * FROM double_avg_range WHERE msa_id = $msa_id AND operator = '$dou_data[operator]'";
                                    $dou_avg_range = $obj->fetchOne($query); ?>
                                    <td>X<?php echo $dou_key + 1; ?>=</td>

                                    <input type="hidden" name="dou_avg_ran_id_<?php echo $dou_key; ?>" value="<?php echo $dou_avg_range['id']; ?>">

                                    <td><input type="number" name="douaverage_<?php echo $dou_key; ?>" id="douavg_<?php echo $dou_key; ?>" class="averages" value="<?php echo $dou_avg_range['double_avg'] ?>" readonly></td>
                                <?php } ?>
                            </tr>
                            <!-- range -->
                            <tr>
                                <th class="text-center">Range</th>
                                <td>&nbsp;</td>
                                <?php
                                if (count($avg_ran) == 0) {
                                    for ($i = 1; $i <= $numofparts; $i++) { ?>
                                        <td><input type="number" name="range_<?php echo $dou_key; ?>_<?php echo $i; ?>" id="ran_<?php echo $dou_key; ?>_<?php echo $i; ?>" class="form-control partsrange_<?php echo $dou_key ?>" readonly></td>
                                    <?php } ?>
                                    <?php } else {
                                    for ($i = 1; $i <= $numofparts; $i++) {
                                        $query = "SELECT * FROM avg_ran WHERE msa_id = $msa_id AND operator = '$dou_data[operator]' AND part = '$i'";
                                        $avg_ran_data = $obj->fetchOne($query); ?>
                                        <td><input type="number" name="range_<?php echo $dou_key; ?>_<?php echo $i; ?>" id="ran_<?php echo $dou_key; ?>_<?php echo $i; ?>" class="form-control partsrange_<?php echo $dou_key ?>" value="<?php echo $avg_ran_data['ranges'] ?>" readonly></td>
                                    <?php } ?>

                                    <?php
                                    $query = "SELECT * FROM double_avg_range WHERE msa_id = $msa_id AND operator = '$dou_data[operator]'";
                                    $dou_avg_range = $obj->fetchOne($query); ?>
                                    <td>R<?php echo $dou_key + 1; ?>=</td>
                                    <td><input type="number" name="dourange_<?php echo $dou_key; ?>" id="dourange_<?php echo $dou_key; ?>" class="ranges" value="<?php echo $dou_avg_range['double_range'] ?>" readonly></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td colspan="<?php echo $numofparts + 4; ?>">&nbsp;</td>
                            </tr>
                        <?php } ?>
                    <?php } ?>

                    <!-- part average -->

                    <tr>
                        <th colspan="2" class="text-center">Part Average</th>
                        <?php
                        if (count($part_avg) == 0) {
                            for ($i = 1; $i <= $numofparts; $i++) { ?>
                                <td><input type="number" name="partavg_<?php echo $i; ?>" id="partavg_<?php echo $i; ?>" class="form-control partranges" readonly></td>
                            <?php } ?>
                            <?php } else {
                            foreach ($part_avg as $part_key => $part_avg_data) { ?>

                                <input type="hidden" name="part_avg_id_<?php echo $part_key; ?>" value="<?php echo $part_avg_data['id']; ?>">

                                <td><input type="number" name="partavg_<?php echo $part_key; ?>" id="partavg_<?php echo $part_key; ?>" class="form-control partranges" value="<?php echo $part_avg_data['part_avg']; ?>" readonly></td>
                            <?php } ?>
                        <?php } ?>
                        <td>Rp=</td>

                        <input type="hidden" name="additional_id" value="<?php echo $additional['id']; ?>">

                        <td><input type="number" name="partrange" id="partrange" value="<?php echo $additional["Rp"]; ?>" readonly></td>
                    </tr>

                    <!-- data -->
                    <tr>
                        <td colspan="<?php echo $numofparts + 2; ?>">&nbsp;</td>
                        <td>R =</td>
                        <td><input type="number" name="rangeavg" id="rangeavg" value="<?php echo $additional["R"]; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="<?php echo $numofparts + 2; ?>">&nbsp;</td>
                        <td class="text-center">X Diff =</td>
                        <td><input type="number" name="xdiff" id="avgrange" value="<?php echo $additional["xdiff"]; ?>" readonly></td>
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
                        <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">R =<input type="number" name="" id="copyrangeavg" value="<?php echo $additional["R"]; ?>" readonly></td>
                        <td colspan="<?php echo ($numofparts + 5) / 2; ?>">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">K1 =<input type="number" name="k1" id="" placeholder="<?php echo $k1; ?>" value="<?php echo $additional["k1"]; ?>" readonly></td>
                        <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">%EV = 100[EV/TV]</td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">EV= R X K1</td>
                        <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">=%<input type="number" name="pctev" id="pctev" value="<?php echo $additional["pct_ev"]; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>"><input type="number" name="ev" id="equipvar" value="<?php echo $additional["ev"]; ?>" readonly></td>
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
                        <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">X Diff= <input type="number" name="" id="copyavgrange" value="<?php echo $additional["xdiff"]; ?>" readonly> n= No. of Parts <input type="number" name="" id="" placeholder="<?php echo $numofparts; ?>" readonly></td>
                        <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">%AV = 100[AV/TV]</td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">K2= <input type="number" name="k2" id="" placeholder="<?php echo $k2; ?>" value="<?php echo $additional["k2"]; ?>" readonly> r= No. of Trials <input type="number" name="" id="" placeholder="<?php echo $numoftrials; ?>" readonly></td>
                        <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">=%<input type="number" name="pctav" id="pctav" value="<?php echo $additional["pct_av"]; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">AV = Sqrt of[(X Diff X K2)^2 - (EV^2/nr)] <input type="number" name="av" id="apprvar" value="<?php echo $additional["av"]; ?>" readonly></td>
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
                        <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>"><input type="number" name="r_r" id="randr" value="<?php echo $additional["r_r"]; ?>" readonly></td>
                        <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">=%<input type="number" name="pctrr" id="pctrr" value="<?php echo $additional["pct_r_r"]; ?>" readonly></td>
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
                        <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">Rp = <input type="number" name="" id="copypartrange" value="<?php echo $additional["Rp"]; ?>" readonly> K3 = <input type="number" name="k3" id="" placeholder="<?php echo $k3; ?>" value="<?php echo $additional["k3"]; ?>" readonly></td>
                        <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">% PV = 100[PV/TV]</td>
                    </tr>
                    <tr>
                        <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center">PV = Rp x K3</td>
                        <td class="text-center" colspan="<?php echo ($numofparts + 5) / 2; ?>">=%<input type="number" name="pctpv" id="pctpv" value="<?php echo $additional["pct_pv"]; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="<?php echo ($numofparts + 5) / 2; ?>" class="text-center"><input type="number" name="pv" id="partvariation" value="<?php echo $additional["pv"]; ?>" readonly></td>
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
                        <td class="text-center" colspan="<?php echo $numofparts + 4; ?>"><input type="number" name="tv" id="totalvar" value="<?php echo $additional["tv"]; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="<?php echo $numofparts + 4; ?>">&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function calAvg(operators, trials, parts) {
            let sum = 0;
            $('.partDt2_' + operators + '_' + parts).each(function() {
                sum += parseFloat($(this).val()) || 0;
            });
            let rowCount = <?php echo $numoftrials; ?>;

            let avg = (sum / rowCount).toFixed(2);
            $('#avg_' + operators + '_' + parts).val(avg);
        }

        function calRange(operators, trials, parts) {
            const arrval = [];
            $('.partDt2_' + operators + '_' + parts).each(function() {
                let value = parseFloat($(this).val()) || 0;
                arrval.push(value);
            });
            const max = Math.max(...arrval);
            const min = Math.min(...arrval);
            let range = (max - min).toFixed(2);
            $('#ran_' + operators + '_' + parts).val(range);
        }

        function calPartavg(operators, parts) {
            let avgsum = 0;
            $('.partsavg_' + parts).each(function() {
                avgsum += parseFloat($(this).val() || 0);
            });
            let avgrow = <?php echo $numofoperators; ?>;
            let partavg = (avgsum / avgrow).toFixed(2);
            $('#partavg_' + parts).val(partavg);
            partRange();
        }

        function caldouavg(operators) {
            let avgrsum = 0;
            $('.doubavg_' + operators).each(function() {
                avgrsum += parseFloat($(this).val() || 0);
            });
            let avgcount = <?php echo $numofparts; ?>;
            let douavg = (avgrsum / avgcount).toFixed(2);
            $('#douavg_' + operators).val(douavg);
        }

        function caldouRange(operators) {
            let avgrsum = 0;
            $('.partsrange_' + operators).each(function() {
                avgrsum += parseFloat($(this).val() || 0);
            });
            let avgcount = <?php echo $numofparts; ?>;
            let douavg = (avgrsum / avgcount).toFixed(2);
            $('#dourange_' + operators).val(douavg);
            ranAvg();
        }

        function partRange(parts) {
            const arrval = [];
            $('.partranges').each(function() {
                let value = parseFloat($(this).val()) || 0;
                arrval.push(value);
            });
            const max = Math.max(...arrval);
            const min = Math.min(...arrval);
            let range = (max - min).toFixed(2);
            $('#partrange').val(range);
        }

        function ranAvg() {
            let avgrsum = 0;
            $('.ranges').each(function() {
                avgrsum += parseFloat($(this).val() || 0);
            });
            let avgcount = <?php echo $numofoperators; ?>;
            let douavg = (avgrsum / avgcount).toFixed(2);
            $('#rangeavg').val(douavg);
        }

        function avgRange(operators) {
            const arrval = [];
            $('.averages').each(function() {
                let value = parseFloat($(this).val()) || 0;
                arrval.push(value);
            });
            const max = Math.max(...arrval);
            const min = Math.min(...arrval);
            let range = (max - min).toFixed(2);
            $('#avgrange').val(range);
        }

        function getValue() {
            let valueR = document.getElementById("rangeavg").value;
            document.getElementById("copyrangeavg").value = valueR;
            let valueXDiff = document.getElementById("avgrange").value;
            document.getElementById("copyavgrange").value = valueXDiff;
            let partrange = document.getElementById("partrange").value;
            document.getElementById("copypartrange").value = partrange;
        }

        function calcEV() {
            let valueR = document.getElementById("rangeavg").value;
            let equipvar = (valueR * <?php echo $k1; ?>).toFixed(2);
            $('#equipvar').val(equipvar);
        }

        function calcAV() {
            let xd = document.getElementById("avgrange").value;
            let ev = document.getElementById("equipvar").value;
            let apprvar = (Math.sqrt([(xd * <?php echo $k2; ?>) ** 2] - [(ev ** 2) / (<?php echo $numofparts; ?> * <?php echo $numoftrials; ?>)])).toFixed(2);
            $('#apprvar').val(apprvar);
            // alert(xd);
        }

        function calcRR() {
            let ev = document.getElementById("equipvar").value;
            let av = document.getElementById("apprvar").value;
            let RandR = (Math.sqrt(ev ** 2 + av ** 2)).toFixed(2);
            $('#randr').val(RandR);
        }

        function calcPV() {
            let partran = document.getElementById("partrange").value;
            let partvar = (partran * <?php echo $k3; ?>).toFixed(2);
            $('#partvariation').val(partvar);
        }

        function calcTV() {
            let rr = document.getElementById("randr").value;
            let pv = document.getElementById("partvariation").value;
            let tv = (Math.sqrt(rr ** 2 + pv ** 2)).toFixed(2);
            $('#totalvar').val(tv);
        }

        function pctEV() {
            let ev = document.getElementById("equipvar").value;
            let tv = document.getElementById("totalvar").value;
            let evpercent = ((ev / tv) * 100).toFixed(0);
            $('#pctev').val(evpercent);
        }

        function pctAV() {
            let av = document.getElementById("apprvar").value;
            let tv = document.getElementById("totalvar").value;
            let avpercent = ((av / tv) * 100).toFixed(0);
            $('#pctav').val(avpercent);
        }

        function pctRR() {
            let rr = document.getElementById("randr").value;
            let tv = document.getElementById("totalvar").value;
            let rrpercent = ((rr / tv) * 100).toFixed(0);
            $('#pctrr').val(rrpercent);
        }

        function pctPV() {
            let pv = document.getElementById("partvariation").value;
            let tv = document.getElementById("totalvar").value;
            let pvpercent = ((pv / tv) * 100).toFixed(0);
            $('#pctpv').val(pvpercent);
        }
    </script>
    <!-- <?php //include 'includes/footer.php'; 
            ?> -->
    <script src="assets/lib/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validation.js"></script>
    <script src="assets/js/partdata.js"></script>
    <script src="assets/lib/toast-simple-notify/simple-notify.min.js"></script>
</body>

</html>