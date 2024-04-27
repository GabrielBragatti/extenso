<?php
require("../../../config/connection.php");
require("../../validate/replace.php");

$connection = new Database();

$id = isset($_POST['id']) ? $_POST['id'] : null;
$name = isset($_POST['name']) ? replaceString($_POST['name']) : null;
$email = isset($_POST['email']) ? replaceString($_POST['email']) : null;
$vice_id = isset($_POST['vice_id']) ? $_POST['vice_id'] : null;
$clean = isset($_POST['clean']) ? $_POST['clean'] : null;
$password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : null;

$response = new stdClass();
$response->error = false;
$response->msg = null;

if (!$id) {
    $response->error = true;
    $response->msg = "Cliente não encontrado!";
    echo json_encode($response);
    return;
}

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

if (!$vice_id) {
    $response->error = true;
    $response->msg = "Informe o vício!";
    echo json_encode($response);
    return;
}

if (!$clean) {
    $response->error = true;
    $response->msg = "Informe os dias limpo!";
    echo json_encode($response);
    return;
}

if (!$password_confirm) {
    $response->error = true;
    $response->msg = "Digite a senha do usuário para salvar as alterações!";
    echo json_encode($response);
    return;
}

$stmt = $connection->connection()->prepare('UPDATE `client` SET `vices_id` = :vices_id, `email` = :email, `clean_days` = :clean_days, `name` = :name WHERE `id` = :id');
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->bindParam(":vices_id", $vice_id, PDO::PARAM_INT);
$stmt->bindParam(":clean_days", $clean, PDO::PARAM_INT);

$queryNameEquals = $connection->connection()->query("SELECT * FROM `client` WHERE `client`.`name` = '" . $name . "'");
$nameEquals = $queryNameEquals->fetchAll(PDO::FETCH_ASSOC);

$queryIdEquals = $connection->connection()->query("SELECT * FROM `client` WHERE `client`.`id` = '" . $id . "'");
$idEquals = $queryIdEquals->fetchAll(PDO::FETCH_ASSOC);

if (!$idEquals) {
    if ($nameEquals) {
        $response->error = true;
        $response->msg = "Já existe um cliente com esse nome!";
        echo json_encode($response);
        return;
    }
}

$queryPasswordEquals = $connection->connection()->query("SELECT `password` FROM `client` WHERE `client`.`id` = '" . $id . "'");
$passwordEquals = $queryPasswordEquals->fetch(PDO::FETCH_ASSOC);

if ($password_confirm != $passwordEquals['password']) {
    $response->error = true;
    $response->msg = "Senha do usuário incorreta!";
    echo json_encode($response);
    return;
}

$stmt->execute();

echo json_encode($response);
