<?php
include_once '../config/database.php'; 
include_once '../includes/db_operations.php';
$obj = new DbOperations();

if(isset($_POST['form_action']) && $_POST['form_action'] == 'create_msa') {
    $gaugename = htmlspecialchars($_POST['gauge_name']);
    $gaugetype = htmlspecialchars($_POST['gauge_type']);
    $gaugenumber = htmlspecialchars($_POST['gauge_number']);
    $operators = htmlspecialchars($_POST['operators']);
    $trials = htmlspecialchars($_POST['trials']);
    $parts = htmlspecialchars($_POST['parts']);
    $characteristic = htmlspecialchars($_POST['characteristic']);
    $specification = htmlspecialchars($_POST['specification']);
    $testnumber = htmlspecialchars($_POST['test_number']);

    $query = "INSERT INTO msa_form_new (gauge_name, gauge_type, gauge_number, operators, trials, parts, characteristic, specification, test_number) VALUES (:gauge_name, :gauge_type, :gauge_number, :operators, :trials, :parts, :characteristic, :specification, :test_number)";
    $params = ['gauge_name' => "$gaugename", 'gauge_type' => "$gaugetype", 'gauge_number' => $gaugenumber, 'operators' => $operators, 'trials' => $trials, 'parts' => $parts, 'characteristic' => "$characteristic", 'specification' => "$specification", 'test_number' => $testnumber];

    $lastInsertId = $obj->insert($query, $params);

    echo isset($lastInsertId) ? 1 :0;
}
if(isset($_POST['form_action']) && $_POST['form_action'] == 'fetch_msa'){
    $msa_id = htmlspecialchars($_POST['msa_id']);
    $query = "SELECT * FROM msa_form_new where msa_id = $msa_id";

    $msaDts = $obj->fetchOne($query);
    echo json_encode($msaDts);
}
if(isset($_POST['form_action']) && $_POST['form_action'] == 'remove_msa'){
    $msa_id = htmlspecialchars($_POST['msa_id']);
    $query = "DELETE FROM msa_form_new where msa_id = $msa_id";
    $msaDts = $obj->fetchOne($query);
}
if(isset($_POST['form_action']) && $_POST['form_action'] == 'update_msa') {
    $gaugename = htmlspecialchars($_POST['gauge_name']);
    $gaugetype = htmlspecialchars($_POST['gauge_type']);
    $gaugenumber = htmlspecialchars($_POST['gauge_number']);
    $operators = htmlspecialchars($_POST['operators']);
    $trials = htmlspecialchars($_POST['trials']);
    $parts = htmlspecialchars($_POST['parts']);
    $characteristic = htmlspecialchars($_POST['characteristic']);
    $specification = htmlspecialchars($_POST['specification']);
    $testnumber = htmlspecialchars($_POST['test_number']);
    $msa_id = htmlspecialchars($_POST['msa_id']);
    // echo '<pre>';
    // print_r($_POST);
    // die;
    if(isset($password) ) {
        $query = "UPDATE msa_form_new SET gauge_name=:gauge_name, gauge_type=:gauge_type, gauge_number=:gauge_number, operators=:operators, trials=:trials, parts=:parts, characteristic=:characteristic, specification=:specification, test_number=:test_number WHERE msa_id=:msa_id";
        $params = ['gauge_name' => "$gaugename", 'gauge_type' => "$gaugetype", 'gauge_number' => $gaugenumber, 'operators' => $operators, 'trials' => $trials, 'parts' => $parts, 'characteristic' => "$characteristic", 'specification' => "$specification", 'test_number' => $testnumber];
    } else {
        $query = "UPDATE msa_form_new SET gauge_name=:gauge_name, gauge_type=:gauge_type, gauge_number=:gauge_number, operators=:operators, trials=:trials, parts=:parts, characteristic=:characteristic, specification=:specification, test_number=:test_number WHERE msa_id='$msa_id'";
        $params = ['gauge_name' => "$gaugename", 'gauge_type' => "$gaugetype", 'gauge_number' => $gaugenumber, 'operators' => $operators, 'trials' => $trials, 'parts' => $parts, 'characteristic' => "$characteristic", 'specification' => "$specification", 'test_number' => $testnumber];

    }

    $lastInsertId = $obj->update($query, $params);

    echo isset($lastInsertId) ? 1 :0;
}
?>