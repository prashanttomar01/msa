<?php
include_once __DIR__ . '/config/database.php';
include_once __DIR__ . '/includes/db_operations.php';
$obj = new DbOperations();
$form_action = htmlspecialchars($_POST['formaction']);

if(isset($form_action) && $form_action == 'check_username'){
    $username = htmlspecialchars($_POST['username']);
    $query = "SELECT * FROM users WHERE username = :username";
    $params = ['username' => $username];  
    $user = $obj->fetchOne($query, $params);

    if(count($user) == 0){
        echo 0;
    } else{
        echo 1;
    }
}
?>
