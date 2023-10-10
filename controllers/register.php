<?php
include_once("./helpers/includes.php");

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

if (!empty($_POST["nombre"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $contra = $_POST["password"];


    if (!validarContrasena($contra)) {
        mostrarMensaje("Error", "La contraseña debe de tener numeros, una mayuscula y mas de ocho caracteres", "error", "/pages/register.php");
        exit;
    }

    $sqlEmail = "SELECT * FROM `usuarios` WHERE `email` = '$email'";
    $rowCountEmail = $conn->rowCount($sqlEmail);

    if ($rowCountEmail > 0) {
        mostrarMensaje("Error", "Este correo ya está registrado, utiliza otro correo", "error", "/pages/register.php");
        exit;
    }

    $sql = "INSERT INTO `usuarios`(`id`, `nombre`, `email`, `password`, `id_rol`) VALUES (NULL,'$nombre', '$email', '$contra', 2)";

    if ($conn->ejecutar($sql)) {
        mostrarMensaje("Éxito", "Formulario enviado con éxito", "success", "/pages/login.php");
    } else {
        mostrarMensaje("Error", "Error al enviar el formulario", "error", "/pages/register.php");
    }
} else {
    mostrarMensaje("Error", "Los campos están vacíos", "error", "/pages/register.php");
}
?>