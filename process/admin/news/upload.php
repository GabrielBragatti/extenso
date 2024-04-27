<?php
require("../../../config/connection.php");

$connection = new Database();

$id = isset($_POST['id']) ? $_POST['id'] : null;
$img = isset($_FILES["img"]) ? $_FILES["img"] : null;

$response = new stdClass();
$response->error = false;
$response->msg = null;

if (!$id) {
    $response->error = true;
    $response->msg = "Dica não encontrada!";
    echo json_encode($response);
    return;
}

if (!$img) {
    $response->error = true;
    $response->msg = "Informe a imagem!";
    echo json_encode($response);
    return;
}

if ($img['error'] == 4) {
    $response->error = true;
    $response->msg = "Informe a imagem!";
    echo json_encode($response);
    return;
}

$max_size = 2 * 1024 * 1024;

if ($img['size'] > $max_size) {
    $response->error = true;
    $response->msg = "O tamanho da imagem excede o limite de 2MB!";
    echo json_encode($response);
    return;
}

$Upload = false;
switch ($img["type"]) {

    case "image/jpg";
    case "image/jpeg";
    case "image/pjpeg";
        $Upload = true;
        break;
    case "image/png";
    case "image/x-png";
        $Upload = true;
        break;
};

if ($Upload) {
    $filename = $img["name"];

    $tempname = $img["tmp_name"];

    $folder = "../../../news/" . $filename;

    $query = $connection->connection()->prepare('SELECT `img` FROM `news` WHERE `id` = :id');
    $query->execute(array(':id' => $id));
    $news = $query->fetch(PDO::FETCH_ASSOC);

    if ($news['img']) {
        unlink("../../../news/" . $news['img']);
    }

    move_uploaded_file($tempname, $folder);

    $stmt = $connection->connection()->prepare('UPDATE `news` SET `img` = :img WHERE `id` = :id');

    $stmt->bindParam(":img", $filename, PDO::PARAM_STR);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    $stmt->execute();

    echo json_encode($response);
} else {
    $response->error = true;
    $response->msg = "Somente imagens do tipo JPEG, JPG ou PNG!";
    echo json_encode($response);
}
