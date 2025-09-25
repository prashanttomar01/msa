<?php
include_once '../config/database.php'; 
include_once '../includes/db_operations.php';
$obj = new DbOperations();

if(isset($_POST['form_action']) && $_POST['form_action'] == 'create_user') {
    $firstname = htmlspecialchars($_POST['first_name']);
    $lastname = htmlspecialchars($_POST['last_name']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (first_name, last_name, username, password_hash, email, phone) VALUES (:first_name, :last_name, :username, :password_hash, :email, :phone)";
    $params = ['first_name' => "$firstname", 'last_name' => "$lastname", 'username' => "$username", 'password_hash' => $hashed_password, 'email' => "$email", 'phone' => $phone];

    $lastInsertId = $obj->insert($query, $params);

    echo isset($lastInsertId) ? 1 :0;
}
if(isset($_POST['form_action']) && $_POST['form_action'] == 'fetch_user'){
    $user_id = htmlspecialchars($_POST['user_id']);
    $query = "SELECT * FROM users where id = $user_id";

    $userDts = $obj->fetchOne($query);
    echo json_encode($userDts);
}
if(isset($_POST['form_action']) && $_POST['form_action'] == 'remove_user'){
    $user_id = htmlspecialchars($_POST['user_id']);
    $query = "DELETE FROM users where id = $user_id";
    $userDts = $obj->fetchOne($query);
}
if(isset($_POST['form_action']) && $_POST['form_action'] == 'update_user') {
    $firstname = htmlspecialchars($_POST['first_name']);
    $lastname = htmlspecialchars($_POST['last_name']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $user_id = htmlspecialchars($_POST['user_id']);
    // echo '<pre>';
    // print_r($_POST);
    // die;
    if(isset($password) ) {
        $query = "UPDATE users SET first_name=:first_name, last_name=:last_name, username=:username, password_hash=:password_hash, email=:email, phone=:phone WHERE id=:user_id";
        $params = ['first_name' => "$firstname", 'last_name' => "$lastname", 'username' => "$username", 'password_hash' => $hashed_password, 'email' => "$email", 'phone' => $phone, 'user_id' => $user_id];
    } else {
        $query = "UPDATE users SET first_name=:firstname, last_name=:lastname, username=:username, email=:email, phone=:phone WHERE id='$user_id'";
        $params = ['first_name' => "$firstname", 'last_name' => "$lastname", 'username' => "$username", 'email' => "$email", 'phone' => $phone];

    }

    $lastInsertId = $obj->update($query, $params);

    echo isset($lastInsertId) ? 1 :0;
}
?>