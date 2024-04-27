<?php
require("../../../config/connection.php");
require("../../validate/replace.php");

$connection = new Database();

$id = isset($_POST['id']) ? $_POST['id'] : null;
$passwordConfirmDelete = isset($_POST['passwordConfirmDelete']) ? replaceString($_POST['passwordConfirmDelete']) : null;

$response = new stdClass();
$response->error = false;
$response->msg = null;

if (!$id) {
    $response->error = true;
    $response->msg = "Cliente não encontrado!";
    echo json_encode($response);
    return;
}

if (!$passwordConfirmDelete) {
    $response->error = true;
    $response->msg = "Informe a senha do cliente!";
    echo json_encode($response);
    return;
} else {

    $queryIdEquals = $connection->connection()->query("SELECT `password` FROM `client` WHERE `client`.`id` = '" . $id . "'");
    $idEquals = $queryIdEquals->fetch(PDO::FETCH_ASSOC);

    $passwordConfirmCod = $passwordConfirmDelete;

    if ($passwordConfirmCod != $idEquals['password']) {
        $response->error = true;
        $response->msg = "Senha do cliente incorreta!";
        echo json_encode($response);
        return;
    }
}

$stmt = $connection->connection()->prepare('DELETE FROM `client` WHERE `id` = :id');
$stmt->execute(array(':id' => $id));

echo json_encode($response);
