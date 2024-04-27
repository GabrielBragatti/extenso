<?php
require("../../config/connection.php");
require("../validate/replace.php");

$connection = new Database();

$email = isset($_POST['email']) ? replaceString($_POST['email']) : null;
$password = isset($_POST['password']) ? replaceString($_POST['password']) : null;

$response = new stdClass();
$response->error = false;
$response->msg = null;

if (!$email) {
    $response->error = true;
    $response->msg = "Informe o e-mail!";
    $response->field = "email";
    echo json_encode($response);
    return;
}

if (!$password) {
    $response->error = true;
    $response->msg = "Informe a senha!";
    $response->field = "password";
    echo json_encode($response);
    return;
}

$stmt = $connection->connection()->prepare('SELECT * FROM `user` WHERE `email` = :email AND `password` = :password');
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->bindParam(":password", $password, PDO::PARAM_STR);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $response->error = true;
    $response->msg = "Dados inválidos!";
    $response->field = "msg";
    echo json_encode($response);
    return;
} else {
    session_start();

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_permission'] = "1";
}

echo json_encode($response);
