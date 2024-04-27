<?php
require("../../../config/connection.php");

$connection = new Database();

$id = isset($_POST['id']) ? $_POST['id'] : null;

$response = new stdClass();
$response->error = false;
$response->msg = null;

if (!$id) {
    $response->error = true;
    $response->msg = "Vício não encontrado!";
    echo json_encode($response);
    return;
}

$queryNews = $connection->connection()->prepare('SELECT count(`id`) AS `total` FROM `news` WHERE `vices_id` = :id');
$queryNews->execute(array(':id' => $id));
$countNews = $queryNews->fetch(PDO::FETCH_ASSOC);

if($countNews['total'] > 0){
    $response->error = true;
    $response->msg = "Há notícia(s) com o vício vinculado!";
    echo json_encode($response);
    return;
}

$queryClient = $connection->connection()->prepare('SELECT count(`id`) AS `total` FROM `client` WHERE `vices_id` = :id');
$queryClient->execute(array(':id' => $id));
$countClient = $queryClient->fetch(PDO::FETCH_ASSOC);

if($countClient['total'] > 0){
    $response->error = true;
    $response->msg = "Há cliente(s) com o vício vinculado!";
    echo json_encode($response);
    return;
}

$stmt = $connection->connection()->prepare('DELETE FROM `vices` WHERE `id` = :id');
$stmt->execute(array(':id' => $id));

echo json_encode($response);
