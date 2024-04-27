<?php
require("../../../config/connection.php");
require("../../validate/replace.php");

$connection = new Database();

$id = isset($_POST['id']) ? $_POST['id'] : null;
$type_id = isset($_POST['type_id']) ? $_POST['type_id'] : null;
$name = isset($_POST['name']) ? replaceString($_POST['name']) : null;

$response = new stdClass();
$response->error = false;
$response->msg = null;

if (!$id) {
    $response->error = true;
    $response->msg = "Vício não encontrado!";
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

if (!$type_id) {
    $response->error = true;
    $response->msg = "Selecione um tipo de vício!";
    echo json_encode($response);
    return;
}

$stmt = $connection->connection()->prepare('UPDATE `vices` SET `type_id` = :type_id, `name` = :name WHERE `id` = :id');
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->bindParam(":type_id", $type_id, PDO::PARAM_INT);
$stmt->bindParam(":name", $name, PDO::PARAM_STR);

$queryNameEquals = $connection->connection()->query("SELECT * FROM `vices` WHERE `vices`.`name` = '" . $name . "'");
$nameEquals = $queryNameEquals->fetchAll(PDO::FETCH_ASSOC);

$queryIdEquals = $connection->connection()->query("SELECT * FROM `vices` WHERE `vices`.`id` = '" . $id . "'");
$idEquals = $queryIdEquals->fetchAll(PDO::FETCH_ASSOC);

if (!$idEquals) {
    if ($nameEquals) {
        $response->error = true;
        $response->msg = "Já existe um vício com esse nome!";
        echo json_encode($response);
        return;
    }
}

$stmt->execute();

echo json_encode($response);
