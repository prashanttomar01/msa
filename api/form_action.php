<?php
include_once '../config/database.php';
include_once '../includes/db_operations.php';
$obj = new DbOperations();

if (isset($_POST['form_action']) && $_POST['form_action'] == 'create_msa') {
    $operators = htmlspecialchars($_POST['operators']);
    $trials = htmlspecialchars($_POST['trials']);
    $parts = htmlspecialchars($_POST['parts']);

    $query = "INSERT INTO msa_form (operators, trials, parts) VALUES (:operators, :trials, :parts)";
    $params = ['operators' => $operators, 'trials' => $trials, 'parts' => $parts];

    $lastInsertId = $obj->insert($query, $params);

    echo isset($lastInsertId) ? 1 : 0;
}
