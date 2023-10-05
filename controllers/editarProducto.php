<?php
session_start();
include "./config/conexion.php";

$librerias = '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css"></link>  
';

function mostrarMensaje($titulo, $mensaje, $tipo, $redireccionar = "../pages/admin/editarProductos.php")
{
    global $librerias;
    echo '
        <html>
            <head>
                ' . $librerias . '
            </head>
            <body>
                <script language="javascript">
                    swal("' . $titulo . '", "' . $mensaje . '", "' . $tipo . '").then(function() {
                        window.location.href = " ' . $redireccionar . '";
                    });
                </script>
            </body>
        </html>';
    exit;
}

function validarDatos($nombre, $material, $descripcion, $precio, $imagenNombre = " ")
{
    if (empty($nombre) || empty($material) || empty($descripcion) || empty($precio) || empty($imagenNombre)) {
        return false; // Al menos uno de los campos está vacío
    }
    return true; // Todos los campos están llenos
}

if (!isset($_SESSION['id_role']) || $_SESSION['id_role'] != 1) {
    header("Location: ../index.php");
    exit();
}

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
        mostrarMensaje("Error", "Por favor, complete todos los campos.", "error");
        exit();
    }


    // Actualiza los datos del producto en la base de datos
    $sql = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = $precio, material = '$material' ,imagen= '$imagen_nombre' WHERE id = $id_producto";

    if (mysqli_query($conn, $sql)) {
        mostrarMensaje("Éxito", "Producto agregado correctamente", "success", "../pages/admin/index.php");
        exit();
    } else {
        mostrarMensaje("Error", "Error con la solicitud", "error");
    }
}
?>