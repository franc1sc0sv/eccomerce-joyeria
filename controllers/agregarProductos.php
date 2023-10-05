<?php
session_start();
include "./config/conexion.php";

$librerias = '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css"></link>  
';

function mostrarMensaje($titulo, $mensaje, $tipo, $redireccionar = "../pages/admin/agregarProductos.php")
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

function validarDatos($nombre, $material, $descripcion, $precio, $imagenNombre)
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


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $material = $_POST["material"];
    $descripcion = $_POST["descripcion"];
    $precio = floatval($_POST["precio"]);

    // Procesar la imagen
    $imagen = $_FILES["imagen"];
    $imagenNombre = $imagen["name"];
    $imagenTmpPath = $imagen["tmp_name"];
    $imagenDestino = "../uploads/" . $imagenNombre;

    move_uploaded_file($imagenTmpPath, $imagenDestino);

    if (!validarDatos($nombre, $material, $descripcion, $precio, $imagenNombre)) {
        mostrarMensaje("Error", "Por favor, complete todos los campos.", "error");
        exit();
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO productos (nombre, descripcion, precio, material, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$material', '$imagenNombre')";

    $resultado = mysqli_query($conn, $sql);

    if ($resultado) {
        mostrarMensaje("Éxito", "Producto agregado correctamente", "success", "../pages/admin/index.php");
    } else {
        mostrarMensaje("Error", "Error con la solicitud", "error");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>