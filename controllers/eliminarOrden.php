<?php
include_once("./helpers/includes.php");


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM pedidos WHERE id = $id";

    $conn->ejecutar($sql);

} else {
    echo "ID de producto no válido.";
}
?>