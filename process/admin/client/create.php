<?php
require("../../../config/connection.php");
require("../../validate/replace.php");

$connection = new Database();

$name = isset($_POST['name']) ? replaceString($_POST['name']) : null;
$vice_id = isset($_POST['vice_id']) ? $_POST['vice_id'] : null;
$email = isset($_POST['email']) ? replaceString($_POST['email']) : null;
$clean_days = isset($_POST['clean_days']) ? $_POST['clean_days'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : null;

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

if (!$clean_days) {
    $response->error = true;
    $response->msg = "Informe os dias limpo!";
    echo json_encode($response);
    return;
}

if (!$vice_id) {
    $response->error = true;
    $response->msg = "Selecione um vício!";
    echo json_encode($response);
    return;
}

if ($password_confirm != $password){
    $response->error = true;
    $response->msg = "As senhas não coincidem!";
    echo json_encode($response);
    return;
}

if ($password != $password_confirm){
    $response->error = true;
    $response->msg = "As senhas não coincidem!";
    echo json_encode($response);
    return;
}

$register_day = date("Y-m-d");

$stmt = $connection->connection()->prepare('INSERT INTO `client` 
(
`name`,
`email`,
`clean_days`,
`vices_id`,
`register_day`,
`password`
)
 VALUES 
(
:name,
:email,
:clean_days,
:vices_id,
:register_day,
:password
)');

$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->bindParam(":vices_id", $vice_id, PDO::PARAM_INT);
$stmt->bindParam(":clean_days", $clean_days, PDO::PARAM_INT);
$stmt->bindParam(":register_day", $register_day, PDO::PARAM_STR);
$stmt->bindParam(":password", $password, PDO::PARAM_STR);

$queryNameEquals = $connection->connection()->query("SELECT * FROM `client` WHERE `client`.`name` = '" . $name . "'");
$nameEquals = $queryNameEquals->fetchAll(PDO::FETCH_ASSOC);

if ($nameEquals) {
    $response->error = true;
    $response->msg = "Já existe um cliente com esse nome!";
    echo json_encode($response);
    return;
}

$stmt->execute();

echo json_encode($response);
