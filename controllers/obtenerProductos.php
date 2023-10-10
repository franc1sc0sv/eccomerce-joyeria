<?php

include_once("./helpers/includes.php");


$productos = json_decode($_GET['productos']);

if (empty($productos)) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT * FROM productos WHERE id IN (" . implode(',', $productos) . ")";

$data = $conn->consultar($sql);

echo json_encode($data);



?>