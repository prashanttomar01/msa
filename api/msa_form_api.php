<?php
include_once '../config/database.php';
include_once '../includes/db_operations.php';
$obj = new DbOperations();

if (isset($_POST['form_action']) && $_POST['form_action'] == 'create_msa') {
    $gauge_name = htmlspecialchars($_POST['gauge-name']);
    $gauge_type = htmlspecialchars($_POST['gauge-type']);
    $gauge_number = htmlspecialchars($_POST['gauge-number']);
    $operators = htmlspecialchars($_POST['operators']);
    $trials = htmlspecialchars($_POST['trials']);
    $parts = htmlspecialchars($_POST['parts']);
    $characteristic = htmlspecialchars($_POST['characteristic']);
    $specification = htmlspecialchars($_POST['specification']);
    $test_number = htmlspecialchars($_POST['test-number']);

    $query = "INSERT INTO msa_form_new (gauge_name, gauge_type, gauge_number, operators, trials, parts, characteristic, specification, test_number) VALUES (:gauge_name, :gauge_type, :gauge_number, :operators, :trials, :parts, :characteristic, :specification, :test_number) ";
    $params = ['gauge_name' => "$gauge_name", 'gauge_type' => "$gauge_type", 'gauge_number' => $gauge_number, 'operators' => $operators, 'trials' => $trials, 'parts' => $parts, 'characteristic' => "$characteristic", 'specification' => "$specification", 'test_number' => $test_number];

    $lastInsertId = $obj->insert($query, $params);

    echo isset($lastInsertId) ? 1 : 0;
}
