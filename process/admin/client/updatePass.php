<?php
require("../../../config/connection.php");
require("../../validate/replace.php");

$connection = new Database();

$id = isset($_POST['id']) ? $_POST['id'] : null;
$newPassword = isset($_POST['newPassword']) ? replaceString($_POST['newPassword']) : null;
$newPasswordConfirm = isset($_POST['newPasswordConfirm']) ? replaceString($_POST['newPasswordConfirm']) : null;
$passwordConfirm = isset($_POST['passwordConfirm2']) ? replaceString($_POST['passwordConfirm2']) : null;

$response = new stdClass();
$response->error = false;
$response->msg = null;

if (!$id) {
    $response->error = true;
    $response->msg = "Cliente não encontrado!";
    echo json_encode($response);
    return;
}

if (!$newPassword) {
    $response->error = true;
    $response->msg = "Informe a nova senha!";
    echo json_encode($response);
    return;
}

if (!$newPasswordConfirm) {
    $response->error = true;
    $response->msg = "Confirme a nova senha!";
    echo json_encode($response);
    return;
}

if ($newPassword != $newPasswordConfirm) {
    $response->error = true;
    $response->msg = "As senhas não coincidem!";
    echo json_encode($response);
    return;
}

if (!$passwordConfirm) {
    $response->error = true;
    $response->msg = "Informe a senha do cliente!";
    echo json_encode($response);
    return;
} else {

    $queryIdEquals = $connection->connection()->query("SELECT `password` FROM `client` WHERE `client`.`id` = '" . $id . "'");
    $idEquals = $queryIdEquals->fetch(PDO::FETCH_ASSOC);

    $passwordConfirmCod = $passwordConfirm;

    if ($passwordConfirmCod != $idEquals['password']) {
        $response->error = true;
        $response->msg = "Senha do cliente incorreta!";
        echo json_encode($response);
        return;
    }

    $newPasswordCod = $newPassword;
}

$stmt = $connection->connection()->prepare('UPDATE `client` SET 
`password` = :password
WHERE `id` = :id');
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->bindParam(":password", $newPasswordCod, PDO::PARAM_STR);

$stmt->execute();

echo json_encode($response);
