<?php
session_start();
include "./config/conexion.php";
$librerias = '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css"></link>  
';

function mostrarMensaje($titulo, $mensaje, $tipo, $redireccionar = "/pages/login.php")
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

function limpiarInput($data)
{
    global $conn;
    $data = trim($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos vacíos
    if (!isset($_POST["email"]) || !isset($_POST["password"])) {
        mostrarMensaje("Error", "Campos requeridos", "error");
    }

    if (empty($_POST["email"]) || empty($_POST["password"])) {
        mostrarMensaje("Error", "Por favor, complete todos los campos.", "error");
    }
    $correo = limpiarInput($_POST["email"]);
    $contrasena = limpiarInput($_POST["password"]);

    // Consulta para verificar el usuario y la contraseña
    $consulta = "SELECT id, id_rol, nombre FROM usuarios WHERE email = '$correo' AND password = '$contrasena'";
    $resultado = mysqli_query($conn, $consulta);

    if ($resultado && mysqli_num_rows($resultado) == 1) {
        // Inicio de sesión exitoso
        $fila = mysqli_fetch_assoc($resultado);
        $_SESSION["id_role"] = $fila["id_rol"];
        $_SESSION['id'] = $fila['id'];
        $_SESSION['name'] = $fila["nombre"];
        $_SESSION['email'] = $correo;

        $ruta = $fila["id_rol"] == 1 ? "../pages/admin/index.php" : "../index.php";
        mostrarMensaje("Éxito", "Has iniciado sesion correctamente", "success", $ruta);
    } else {
        mostrarMensaje("Error", "Usuario o contraseña incorrectos", "error");
    }
}
?>