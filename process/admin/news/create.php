<?php
require("../../../config/connection.php");
require("../../validate/replace.php");

$connection = new Database();

$title = isset($_POST['title']) ? replaceString($_POST['title']) : null;
$init_date = isset($_POST['init_date']) ? $_POST['init_date'] : NULL;
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : NULL;
$text = isset($_POST['text']) ? replaceString($_POST['text']) : null;
$vice_id = isset($_POST['vice_id']) ? $_POST['vice_id'] : null;
$fixed = isset($_POST['fixed']) ? $_POST['fixed'] : 0;


$response = new stdClass();
$response->error = false;
$response->msg = null;

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

if (!$vice_id){
    $response->error = true;
    $response->msg = "Informe o vício que a dica será vinculada!";
    echo json_encode($response);
    return;
}

if (!$init_date){
    $init_date = NULL;
}

if (!$end_date){
    $end_date = NULL;
}

if ($fixed == "1" || $fixed == 1 || $fixed == '1') {
    $fixedT = 1;
} else {
    $fixedT = 0;
}

$stmt = $connection->connection()->prepare('INSERT INTO `news` 
(
`title`,
`text`,
`vices_id`,
`init_date`,
`end_date`,
`fixed`
)
 VALUES 
(
:title,
:textn,
:vices_id,
:init_date,
:end_date,
:fixed
)');

$stmt->bindParam(":title", $title, PDO::PARAM_STR);
$stmt->bindParam(":vices_id", $vice_id, PDO::PARAM_INT);
$stmt->bindParam(":init_date", $init_date, PDO::PARAM_STR);
$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
$stmt->bindParam(":textn", $text, PDO::PARAM_STR);
$stmt->bindParam(":fixed", $fixedT, PDO::PARAM_INT);

$stmt->execute();

echo json_encode($response);
