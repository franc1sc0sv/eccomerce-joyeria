<?php
// Iniciamos la sesión para acceder a las variables de sesión
session_start();

// Destruimos la sesión para cerrar sesión
session_destroy();

header("Location: /index.php");
exit();
?>