<?php
include_once("./helpers/includes.php");


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_producto = $_GET['id'];
    $sql = "DELETE FROM productos WHERE id = $id_producto";

    $conn->ejecutar($sql);
    mostrarMensaje("Éxito", "Producto eliminado correctamente", "success", "../pages/admin/index.php");

} else {
    echo "ID de producto no válido.";
}

?>