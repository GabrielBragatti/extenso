<?php
require("../../../config/connection.php");
require("../../validate/replace.php");

$connection = new Database();

$id = isset($_POST['id']) ? $_POST['id'] : null;
$title = isset($_POST['title']) ? replaceString($_POST['title']) : null;
$init_date = isset($_POST['init_date']) ? $_POST['init_date'] : null;
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;
$text = isset($_POST['text']) ? replaceString($_POST['text']) : null;
$vices_id = isset($_POST['vices_id']) ? $_POST['vices_id'] : null;
$fixed = isset($_POST['fixed']) ? $_POST['fixed'] : null;

$response = new stdClass();
$response->error = false;
$response->msg = null;

if (!$id) {
    $response->error = true;
    $response->msg = "Dica não encontrada!";
    echo json_encode($response);
    return;
}

if (!$title) {
    $response->error = true;
    $response->msg = "Informe o título!";
    echo json_encode($response);
    return;
}

if (mb_strlen($title) > 100) {
    $response->error = true;
    $response->msg = "Digite até 100 caracteres!";
    echo json_encode($response);
    return;
}

if (!$text) {
    $response->error = true;
    $response->msg = "Informe a descrição!";
    echo json_encode($response);
    return;
}

if (mb_strlen($text) > 2000) {
    $response->error = true;
    $response->msg = "Digite até 2000 caracteres!";
    echo json_encode($response);
    return;
}

if (!$vices_id){
    $response->error = true;
    $response->msg = "Informe o vício que a dica será vinculada!";
    echo json_encode($response);
    return;
}

if ($fixed == "1" || $fixed == 1 || $fixed == '1') {
    $fixedT = 1;
} else {
    $fixedT = 0;
}

if (!$init_date){
    $init_date = NULL;
}

if (!$end_date){
    $end_date = NULL;
}

$stmt = $connection->connection()->prepare('UPDATE `news` SET `title` = :title, `init_date` = :init_date, `end_date` = :end_date, `text` = :textn, `vices_id` = :vices_id, `fixed` = :fixed WHERE `id` = :id');
$stmt->bindParam(":title", $title, PDO::PARAM_STR);
$stmt->bindParam(":init_date", $init_date, PDO::PARAM_STR);
$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
$stmt->bindParam(":textn", $text, PDO::PARAM_STR);
$stmt->bindParam(":vices_id", $vices_id, PDO::PARAM_INT);
$stmt->bindParam(":fixed", $fixedT, PDO::PARAM_INT);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);

$stmt->execute();

echo json_encode($response);
