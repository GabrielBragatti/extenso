<?php
require("../../../config/connection.php");
require("../../validate/replace.php");

$connection = new Database();

$name = isset($_POST['name']) ? replaceString($_POST['name']) : null;
$type_id = isset($_POST['type_id']) ? replaceString($_POST['type_id']) : null;

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

if (!$type_id) {
    $response->error = true;
    $response->msg = "Selecione um tipo!";
    echo json_encode($response);
    return;
}


$stmt = $connection->connection()->prepare('INSERT INTO `vices` 
(
`name`,
`type_id`
)
 VALUES 
(
:name,
:type_id
)');

$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":type_id", $type_id, PDO::PARAM_INT);

$queryNameEquals = $connection->connection()->query("SELECT * FROM `vices` WHERE `vices`.`name` = '" . $name . "'");
$nameEquals = $queryNameEquals->fetchAll(PDO::FETCH_ASSOC);

if ($nameEquals) {
    $response->error = true;
    $response->msg = "Já existe um vício com esse nome!";
    echo json_encode($response);
    return;
}

$stmt->execute();

echo json_encode($response);
