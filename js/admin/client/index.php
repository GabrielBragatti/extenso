<?php
$response = new stdClass();
$response->error = true;
$response->msg = "Acesso negado!";

echo json_encode($response);