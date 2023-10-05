<?php

session_start();
$isLoged = false;

$id = null;
$name = null;
$email = null;

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $isLoged = true;

}

?>