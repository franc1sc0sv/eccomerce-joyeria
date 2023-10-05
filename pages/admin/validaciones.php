<?php

session_start();


if (!isset($_SESSION['id_role'])) {
    header("Location: ../../index.php");
}

if ($_SESSION['id_role'] != 1) {
    header("Location: ../../index.php");
}

?>