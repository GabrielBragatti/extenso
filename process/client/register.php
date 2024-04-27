<?php
require("../../config/connection.php");
require("../validate/replace.php");

$connection = new Database();

$name = isset($_POST['name']) ? replaceString($_POST['name']) : null;
$email = isset($_POST['email']) ? replaceString($_POST['email']) : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$passwordConfirm = isset($_POST['passwordConfirm']) ? $_POST['passwordConfirm'] : null;
$vice_id = isset($_POST['vice_id']) ? $_POST['vice_id'] : null;


$response = new stdClass();
$response->error = false;
$response->msg = null;

if (!$name) {
    $response->error = true;
    $response->msg = "Informe o nome!";
    echo json_encode($response);
    return;
}

if (mb_strlen($name) > 100) {
    $response->error = true;
    $response->msg = "Digite até 100 caracteres!";
    echo json_encode($response);
    return;
}

if (!$email) {
    $response->error = true;
    $response->msg = "Informe o e-mail!";
    echo json_encode($response);
    return;
}

if (mb_strlen($email) > 100) {
    $response->error = true;
    $response->msg = "Digite até 100 caracteres!";
    echo json_encode($response);
    return;
}


if ($passwordConfirm != $password) {
    $response->error = true;
    $response->msg = "As senhas não coincidem!";
    echo json_encode($response);
    return;
}

if ($password != $passwordConfirm) {
    $response->error = true;
    $response->msg = "As senhas não coincidem!";
    echo json_encode($response);
    return;
}

if (!$vice_id) {
    $response->error = true;
    $response->msg = "Selecione um vício!";
    echo json_encode($response);
    return;
}

$register_day = date("Y-m-d");

$stmt = $connection->connection()->prepare('INSERT INTO `client` 
(
`name`,
`email`,
`password`,
`vices_id`,
`register_day`
)
 VALUES 
(
:name,
:email,
:password,
:vices_id,
:register_day
)');

$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->bindParam(":password", $password, PDO::PARAM_STR);
$stmt->bindParam(":vices_id", $vice_id, PDO::PARAM_INT);
$stmt->bindParam(":register_day", $register_day, PDO::PARAM_STR);

$stmt->execute();

$queryEmail = $connection->connection()->query("SELECT * FROM `client` WHERE `client`.`email` = '" . $email . "'");
$Email = $queryEmail->fetch(PDO::FETCH_ASSOC);

session_start();

$_SESSION['user_id'] = $Email['id'];
$_SESSION['user_name'] = $Email['name'];
$_SESSION['user_permission'] = "2";

echo json_encode($response);
