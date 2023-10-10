<?php
include_once("./helpers/includes.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre"];
    $material = $_POST["material"];
    $descripcion = $_POST["descripcion"];
    $precio = floatval($_POST["precio"]);

    $imagen = $_FILES["imagen"];
    $imagenNombre = $imagen["name"];
    $imagenTmpPath = $imagen["tmp_name"];
    $imagenDestino = "../uploads/" . $imagenNombre;

    move_uploaded_file($imagenTmpPath, $imagenDestino);

    if (!validarDatos($nombre, $material, $descripcion, $precio, $imagenNombre)) {
        mostrarMensaje("Error", "Por favor, complete todos los campos.", "error", "../pages/admin/agregarProductos.php");
        exit();
    }


    $sql = "INSERT INTO productos (nombre, descripcion, precio, material, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$material', '$imagenNombre')";

    if ($conn->ejecutar($sql)) {
        mostrarMensaje("Éxito", "Producto agregado correctamente", "success", "../pages/admin/index.php");
    } else {
        mostrarMensaje("Error", "Error con la solicitud", "error", "../pages/admin/agregarProductos.php");
    }
}
?>