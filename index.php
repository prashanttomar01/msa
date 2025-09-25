<?php
session_start();
require_once "includes/common_functions.php";
if (isset($_SESSION['user_id'])) {
    header('location: dashboard.php');
} else{
    header('location: login.php');
}
?>