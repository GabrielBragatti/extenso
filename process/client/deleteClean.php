<?php
require("../../config/connection.php");
require("../validate/replace.php");

$connection = new Database();

$id = isset($_POST['id']) ? $_POST['id'] : null;

$response = new stdClass();
$response->error = false;
$response->msg = null;

if (!$id) {
    $response->error = true;
    $response->msg = "Cliente não encontrado!";
    echo json_encode($response);
    return;
}

$clean = 0;
$register_day = date("Y-m-d");

$stmt = $connection->connection()->prepare('UPDATE `client` SET `clean_days` = :clean_days, `register_day` = :register_day WHERE `id` = :id');
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->bindParam(":clean_days", $clean, PDO::PARAM_INT);
$stmt->bindParam(":register_day", $register_day, PDO::PARAM_STR);

$stmt->execute();

echo json_encode($response);
