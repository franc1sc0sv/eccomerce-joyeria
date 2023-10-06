<?php
session_start();
include "./config/conexion.php";
$librerias = '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css"></link>  
';
// Función para mostrar mensajes
function mostrarMensaje($titulo, $mensaje, $tipo, $redireccionar)
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

// Función para limpiar y escapar input
function limpiarInput($data)
{
    global $conn;
    $data = trim($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['id'])) {
        print_r($_POST);
        exit;
    }
    $id_producto = limpiarInput($_POST["id"]);
    $redireccionar = "../pages/client/compra.php?id=" . $id_producto;
    // Validar campos no vacíos
    if (empty($_POST["name"]) || empty($_POST["direction"]) || empty($_POST["card_number"]) || empty($_POST["cv"]) || empty($_POST["date"])) {
        mostrarMensaje("Error", "Por favor, complete todos los campos.", "error", $redireccionar);
    }

    // Limpiar y escapar los datos
    $name = limpiarInput($_POST["name"]);
    $direction = limpiarInput($_POST["direction"]);
    $cardNumber = limpiarInput($_POST["card_number"]);
    $cv = limpiarInput($_POST["cv"]);
    $date = limpiarInput($_POST["date"]);

    // Validar tarjeta de crédito (solo dígitos, longitud y otros criterios pueden agregarse según el formato deseado)
    if (!preg_match('/^[0-9]{16}$/', $cardNumber)) {
        mostrarMensaje("Error", "Número de tarjeta de crédito no válido.", "error", $redireccionar);
    }

    // Validar CV (debe ser un número de 3 o 4 dígitos)
    if (!preg_match('/^[0-9]{3,4}$/', $cv)) {
        mostrarMensaje("Error", "CV no válido. Debe tener 3 o 4 dígitos.", "error", $redireccionar);
    }

    $fecha_actual = date('Y-m-d');
    if ($date <= $fecha_actual) {
        mostrarMensaje("Error", "La fecha de vencimiento debe ser mayor a la fecha actual.", "error", $redireccionar);
    }

    // Insertar datos en la base de datos (asumiendo que tienes una tabla llamada "compras")
    $query = "INSERT INTO compras (name, direccion, id_producto) 
              VALUES ('$name', '$direction', $id_producto)";

    if (mysqli_query($conn, $query)) {
        mostrarMensaje("Éxito", "Compra realizada exitosamente.", "success", "../index.php");
    } else {
        mostrarMensaje("Error", "Error al realizar la compra. Por favor, inténtelo de nuevo.", "error", "../index.php");
    }
}
?>