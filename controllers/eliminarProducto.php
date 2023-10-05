<?php
session_start();
include "./config/conexion.php";

$librerias = '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css"></link>  
';

function mostrarMensaje($titulo, $mensaje, $tipo, $redireccionar = "../pages/admin/index.php")
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

if (!isset($_SESSION['id_role']) || $_SESSION['id_role'] != 1) {
    header("Location: ../index.php");
    exit();
}


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Query para eliminar el producto
    $sql = "DELETE FROM productos WHERE id = $id_producto";
    if (mysqli_query($conn, $sql)) {
        mostrarMensaje("Éxito", "Producto eliminado correctamente", "success");
        exit();
    } else {
        mostrarMensaje("Error", "Error con la solicitud", "error");
    }
} else {
    echo "ID de producto no válido.";
}
?>