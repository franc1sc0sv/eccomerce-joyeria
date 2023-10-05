<?php
session_start();

function estaLogeado()
{
    return isset($_SESSION['id']) && !empty($_SESSION['id']);
}

$response = array();

if (estaLogeado()) {
    $response['logeado'] = true;
} else {
    $response['logeado'] = false;
}

header('Content-Type: application/json');
echo json_encode($response);
?>