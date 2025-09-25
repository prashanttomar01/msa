<?php
include_once 'config/database.php';
include_once 'db_operations.php';
$obj = new DbOperations();
// class Common_functions
// {
function signup()
{
    $obj = new DbOperations();
    if (isset($_POST['signupbtn'])) {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)";
        $params = ['username' => "$username", 'email' => "$email", 'password_hash' => "$hashed_password"];
       
        $lastInsertId = $obj->insert($query, $params);

        if ($lastInsertId) {
            header("Location: login.php");
        }
    }
}
function login()
{

    $obj = new DbOperations();
    if (isset($_POST['loginbtn'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $user_token = bin2hex(openssl_random_pseudo_bytes(16));
       
        $query = "SELECT * FROM users WHERE username = :username";
        $params = ['username' => $username];

        $user = $obj->fetchOne($query, $params);

        if ($user) {

            if (password_verify($password, $user['password_hash'])) {
                $query = "INSERT INTO user_sessions (user_id, user_token, auth_action) VALUES (:user_id, :user_token, :auth_action)";
                $params = ['user_id' => $user['id'], 'user_token' => "$user_token", 'auth_action' => 1];
                $obj->insert($query, $params);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_token'] = $user_token;
                $_SESSION['created_at'] = $user['created_at'];
                // header("Location: " . __DIR__ . '/index.php');
                 header("Location: index.php");
                exit();
            } else {
                echo "Invalid username or password!";
            }
        } else {
            echo "User not found!";
        }
    }
}
