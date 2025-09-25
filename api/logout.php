<?php
session_start();
include_once '../config/database.php';
include_once '../includes/db_operations.php';
$obj = new DbOperations();

if (isset($_SESSION['user_id'])) {
    $user_token =  $_SESSION['user_token'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO user_sessions (user_id, user_token, auth_action) VALUES (:user_id, :user_token, :auth_action)";
    $params = ['user_id' => $user_id, 'user_token' => "$user_token", 'auth_action' => 0];
    $obj->insert($query, $params);

    session_unset();
    session_destroy();
    header("Location: ../login.php");
}
?>