<?php
include "./config/conexion.php";
$librerias = '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css"></link>  
';

function validarContrasena($contrasena)
{
    // Longitud mínima de 8 caracteres, al menos una mayúscula y al menos un número
    $patron = '/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/';

    if (preg_match($patron, $contrasena)) {
        return true; // La contraseña cumple con los criterios
    } else {
        return false; // La contraseña no cumple con los criterios
    }
}


function mostrarMensaje($titulo, $mensaje, $tipo, $redireccionar = "/pages/register.php")
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

if (!empty($_POST["nombre"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $contra = $_POST["password"];

    if (!validarContrasena($contra)) {
        mostrarMensaje("Error", "La contraseña debe de tener numeros, una mayuscula, minimmo un caracter especial y mas de ocho caracteres", "error");
        exit;
    }

    // Verificamos si el correo ya está registrado 
    $checkEmailQuery = "SELECT * FROM `usuarios` WHERE `email` = '$email'";
    $resultado = mysqli_query($conn, $checkEmailQuery);
    if ($resultado && mysqli_num_rows($resultado) == 1) {
        // Error en el registro, muestra una alerta y redirige al formulario de registro
        mostrarMensaje("Error", "Este correo ya está registrado, utiliza otro correo", "error");
    }

    // Insertamos los datos del nuevo usuario en la tabla de usuarios
    $sql = "INSERT INTO `usuarios`(`id`, `nombre`, `email`, `password`, `id_rol`) VALUES (NULL,'$nombre', '$email', '$contra', 2)";

    if (mysqli_query($conn, $sql)) {
        mostrarMensaje("Éxito", "Formulario enviado con éxito", "success", "/pages/login.php");
    } else {
        mostrarMensaje("Error", "Error al enviar el formulario", "error");
    }
} else {
    // Algunos campos están vacíos, muestra una alerta y redirige al formulario de registro
    mostrarMensaje("Error", "Los campos están vacíos", "error");
}
?>