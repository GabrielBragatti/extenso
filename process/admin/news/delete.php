<?php
require("../../../config/connection.php");
require("../../validate/replace.php");

$connection = new Database();

$id = isset($_POST['id']) ? $_POST['id'] : null;

$response = new stdClass();
$response->error = false;
$response->msg = null;

if (!$id) {
    $response->error = true;
    $response->msg = "Dica não encontrada!";
    echo json_encode($response);
    return;
}

$query = $connection->connection()->prepare('SELECT `img` FROM `news` WHERE `id` = :id');
$query->execute(array(':id' => $id));
$news = $query->fetch(PDO::FETCH_ASSOC);

if ($news['img']) {
    unlink("../../../news/" . $news['img']);
    $stmt = $connection->connection()->prepare('UPDATE `news` SET `img` = :img WHERE `id` = :id');

    $stmt->execute(
        array(
            ':img' => NULL,
            ':id' => $id,
        )
    );
}

$stmt = $connection->connection()->prepare('DELETE FROM `news` WHERE `id` = :id');
$stmt->execute(array(':id' => $id));

echo json_encode($response);
