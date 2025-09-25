<?php
include_once '../config/database.php';
include_once '../includes/db_operations.php';
$obj = new DbOperations();

if (isset($_POST['form_action']) && $_POST['form_action'] == 'insert_msa_data') {
    $msa_id = htmlspecialchars($_POST['msa_id']);
    $numofoperators = $_POST['numofoperators'];
    $numoftrials = $_POST['numoftrials'];
    $numofparts = $_POST['numofparts'];
    $operators = $_POST['operators'];

    for ($i = 1; $i <= $numofoperators; $i++) {
        $operator = $operators[$i - 1];

        for ($j = 1; $j <= $numoftrials; $j++) {
            for ($k = 1; $k <= $numofparts; $k++) {
                $part_data = $_POST['part_data_' . $i . '_' . $j . '_' . $k];

                $query = "INSERT INTO msa_part_data (msa_id, operator, trial, part, part_data) VALUES(:msa_id, :operator, :trial, :part, :part_data)";
                $params = ['msa_id' => $msa_id, 'operator' => $operator, 'trial' => $j, 'part' => $k, 'part_data' => $part_data];
                $lastInsertId = $obj->insert($query, $params);

                echo isset($lastInsertId) ? 1 : 0;
            }
        }
    }

    for ($i = 1; $i <= $numofoperators; $i++) {
        $operator = $operators[$i - 1];

        for ($k = 1; $k <= $numofparts; $k++) {
            $average = $_POST['average_' . $i . '_' . $k];
            $range = $_POST['range_' . $i . '_' . $k];

            $query = "INSERT INTO avg_ran (msa_id, operator, part, average, ranges) VALUES(:msa_id, :operator, :part, :average, :ranges)";
            $params = ['msa_id' => $msa_id, 'operator' => $operator, 'part' => $k, 'average' => $average, 'ranges' => $range];
            $lastInsertId = $obj->insert($query, $params);

            echo isset($lastInsertId) ? 1 : 0;
        }
    }
    for ($i = 1; $i <= $numofparts; $i++) {
        $part_avg = $_POST['partavg_' . $i];

        $query = "INSERT INTO part_avg (msa_id, part, part_avg) VALUES(:msa_id, :part, :part_avg)";
        $params = ['msa_id' => $msa_id, 'part' => $i, 'part_avg' => $part_avg];

        $lastInsertId = $obj->insert($query, $params);
        echo isset($lastInsertId) ? 1 : 0;
    }

    for ($i = 1; $i <= $numofoperators; $i++) {
        $dou_avg = $_POST['douaverage_' . $i];
        $dou_range = $_POST['dourange_' . $i];
        $operator = $operators[$i - 1];

        $query = "INSERT INTO double_avg_range (msa_id, operator, double_avg, double_range) VALUES(:msa_id, :operator, :double_avg, :double_range)";
        $params = ['msa_id' => $msa_id, 'operator' => $operator, 'double_avg' => $dou_avg, 'double_range' => $dou_range];

        $lastInsertId = $obj->insert($query, $params);
        echo isset($lastInsertId) ? 1 : 0;
    }

    $rp = $_POST['partrange'];
    $r = $_POST['rangeavg'];
    $xdiff = $_POST['xdiff'];
    $k1 = $_POST['k1'];
    $ev = $_POST['ev'];
    $k2 = $_POST['k2'];
    $av = $_POST['av'];
    $r_r = $_POST['r_r'];
    $k3 = $_POST['k3'];
    $pv = $_POST['pv'];
    $tv = $_POST['tv'];
    $pctev = $_POST['pctev'];
    $pctav = $_POST['pctav'];
    $pctrr = $_POST['pctrr'];
    $pctpv = $_POST['pctpv'];

    $query = "INSERT INTO msa_additional_data(msa_id, Rp, R, xdiff, k1, ev, k2, av, r_r, k3, pv, tv, pct_ev, pct_av, pct_r_r, pct_pv) VALUES(:msa_id, :Rp, :R, :xdiff, :k1, :ev, :k2, :av, :r_r, :k3, :pv, :tv, :pct_ev, :pct_av, :pct_r_r, :pct_pv)";
    $params = ['msa_id' => $msa_id, 'Rp' => $rp, 'R' => $r, 'xdiff' => $xdiff, 'k1' => $k1, 'ev' => $ev, 'k2' => $k2, 'av' => $av, 'r_r' => $r_r, 'k3' => $k3, 'pv' => $pv, 'tv' => $tv, 'pct_ev' => $pctev, 'pct_av' => $pctav, 'pct_r_r' => $pctrr, 'pct_pv' => $pctpv];

    $lastInsertId = $obj->insert($query, $params);
    echo isset($lastInsertId) ? 1 : 0;
}

if (isset($_POST['form_action']) && $_POST['form_action'] == 'update_msa_data') {
    // echo "submitted";
    $msa_id = htmlspecialchars($_POST['msa_id']);
    $numofoperators = $_POST['numofoperators'];
    $numoftrials = $_POST['numoftrials'];
    $numofparts = $_POST['numofparts'];
    $operators = $_POST['operators'];
    // echo '<pre>';
    // print_r($_POST);
    // die;

    for ($i = 0; $i < $numofoperators; $i++) {

        for ($j = 1; $j <= $numoftrials; $j++) {
            for ($k = 0; $k < $numofparts; $k++) {
                $part_id = $_POST['part_ids_' . $i . '_' . $j . '_' . $k];
                $part_data = $_POST['part_data_' . $i . '_' . $j . '_' . $k];

                $query = "UPDATE msa_part_data SET part_data=:part_data WHERE id=:part_id";
                $params = ['part_data' => $part_data, 'part_id' => $part_id];
                $updated = $obj->update($query, $params);
            }
        }
    }

    for ($i = 0; $i < $numofoperators; $i++) {

        for ($k = 0; $k < $numofparts; $k++) {
            $average = $_POST['average_' . $i . '_' . $k];
            $range = $_POST['range_' . $i . '_' . $k];
            $avg_ran_id = $_POST['avg_ran_id_' . $i . '_' . $k];

            $query = "UPDATE avg_ran  SET average=:average, ranges=:ranges WHERE id=:avg_ran_id";
            $params = ['average' => $average, 'ranges' => $range, 'avg_ran_id' => $avg_ran_id];
            $updated = $obj->update($query, $params);
        }
    }
    for ($i = 0; $i < $numofparts; $i++) {
        $part_avg = $_POST['partavg_' . $i];
        $part_id = $_POST['part_avg_id_' . $i];

        $query = "UPDATE part_avg SET part_avg=:part_avg WHERE id=:part_id";
        $params = ['part_avg' => $part_avg, 'part_id' => $part_id];
        $updated = $obj->update($query, $params);
    }

    for ($i = 0; $i < $numofoperators; $i++) {
        $dou_avg = $_POST['douaverage_' . $i];
        $dou_range = $_POST['dourange_' . $i];
        $dou_avg_ran_id = $_POST['dou_avg_ran_id_' . $i];

        $query = "UPDATE double_avg_range SET double_avg=:double_avg, double_range=:double_range WHERE id=:dou_avg_ran_id";
        $params = ['msa_id' => $msa_id, 'operator' => $operator, 'double_avg' => $dou_avg, 'double_range' => $dou_range];
        $updated = $obj->update($query, $params);
    }

    $rp = $_POST['partrange'];
    $r = $_POST['rangeavg'];
    $xdiff = $_POST['xdiff'];
    $k1 = $_POST['k1'];
    $ev = $_POST['ev'];
    $k2 = $_POST['k2'];
    $av = $_POST['av'];
    $r_r = $_POST['r_r'];
    $k3 = $_POST['k3'];
    $pv = $_POST['pv'];
    $tv = $_POST['tv'];
    $pctev = $_POST['pctev'];
    $pctav = $_POST['pctav'];
    $pctrr = $_POST['pctrr'];
    $pctpv = $_POST['pctpv'];
    $additional_id = $_POST['additional_id'];

    $query = "UPDATE msa_additional_data SET Rp=:Rp, R=:R, xdiff=:xdiff, k1=:k1, ev=:ev, k2=:k2, av=:av, r_r=:r_r, k3=:k3, pv=:pv, tv=:tv, pct_ev=:pct_ev, pct_av=:pct_av, pct_r_r=:pct_r_r, pct_pv=:pct_pv WHERE id=:additional_id";
    $params = ['Rp' => $rp, 'R' => $r, 'xdiff' => $xdiff, 'k1' => $k1, 'ev' => $ev, 'k2' => $k2, 'av' => $av, 'r_r' => $r_r, 'k3' => $k3, 'pv' => $pv, 'tv' => $tv, 'pct_ev' => $pctev, 'pct_av' => $pctav, 'pct_r_r' => $pctrr, 'pct_pv' => $pctpv, 'additional_id' => $additional_id];
    $updated = $obj->update($query, $params);
}
