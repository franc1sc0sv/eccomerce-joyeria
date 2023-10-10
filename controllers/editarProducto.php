<?php
include_once("./helpers/includes.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_GET['id']; // Obtén el ID del producto de la URL

    // Obtén los datos del formulario
    $nombre = $_POST['nombre'];
    $material = $_POST["material"];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen_nombre = $_POST['imagen_nombre'];

    // Procesa la imagen si se ha subido
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $imagen_nombre = $_FILES['imagen']['name'];
        $ruta_destino = "../uploads/" . $imagen_nombre; // Cambia esto a la ruta correcta
        move_uploaded_file($imagen_temp, $ruta_destino);
    }

    if (!validarDatos($nombre, $material, $descripcion, $precio, $imagen_nombre)) {
        mostrarMensaje("Error", "Por favor, complete todos los campos.", "error", "../pages/admin/editarProductos.php");
        exit();
    }

    // Actualiza los datos del producto en la base de datos
    $sql = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = $precio, material = '$material' ,imagen= '$imagen_nombre' WHERE id = $id_producto";

    $conn->ejecutar($sql);
    mostrarMensaje("Éxito", "Producto editado correctamente correctamente", "success", "../pages/admin/index.php");

}
?>