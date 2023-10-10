<?php

include_once('./validaciones.php');
include_once('../../controllers/config/conexion.php');

$sql = "SELECT * FROM pedidos";
$orders = $conn->consultar($sql);

$productos = [];

foreach ($orders as $order) {
    $productos[] = json_decode($order["productos"]);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Joyeria ADMIN</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />


    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

</head>


<body>

    <div id="wrapper">
        <ul style="background-color: #212529" class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-text mx-3">Joyeria Online</div>
            </a>
            <hr class="sidebar-divider my-0" />

            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <span>Productos</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="ordenes.php">
                    <span>Ordenes</span></a>
            </li>
            <hr class="sidebar-divider my-0" />
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $_SESSION['name'] ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../../controllers/logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesion
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container">
                    <h2>Lista de Órdenes</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Productos</th> <!-- Nueva columna para mostrar productos -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($orders as $order) {
                                $productos = json_decode($order["productos"]);



                                echo '<tr>';
                                echo '<td>' . $order['id'] . '</td>';
                                echo '<td>' . $order['nombre'] . '</td>';
                                echo '<td>' . $order['direccion'] . '</td>';
                                echo '<td><ul>';
                                foreach ($productos as $item) {
                                    $dato = $conn->consultar("SELECT nombre FROM productos WHERE id = $item->id")[0];
                                    echo "<li>" . $dato['nombre'] . " - " . $item->cantidad . "</li>";
                                }
                                echo '</ul></td>';
                                echo '<td><button class="btn btn-danger" onclick="deleteOrder(' . $order['id'] . ')">Eliminar Orden</button></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>

            function deleteOrder(orderId) {
                Swal.fire({
                    title: 'Eliminar Orden',
                    text: '¿Estás seguro de que deseas eliminar esta orden?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        await fetch(`/controllers/eliminarOrden.php?id=${orderId}`)
                        Swal.fire({
                            title: 'Orden Eliminada',
                            text: 'La orden ha sido eliminada correctamente.',
                            icon: 'succes',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'ok'
                        }).then(async (result) => {
                            location.reload();
                        })
                    }
                });
            }
        </script>

</body>

</html>