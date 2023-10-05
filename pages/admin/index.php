<?php
include_once('./validaciones.php');
include_once('../../controllers/config/conexion.php');


$sql = "SELECT * FROM productos";
$result = mysqli_query($conn, $sql);

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

  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script> -->
</head>

<body id="page-top">

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
      <hr class="sidebar-divider my-0" />
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php echo $_SESSION['name'] ?>
                </span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../../controllers/logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesion
                </a>
              </div>
            </li>
          </ul>
        </nav>

        <div class="container">
          <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Lista de Productos</h2>
            <a href="agregarProductos.php" class="btn btn-success">Agregar productos</a>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr>';
                  echo '<td>' . $row['id'] . '</td>';
                  echo '<td>' . $row['nombre'] . '</td>';
                  echo '<td>' . $row['descripcion'] . '</td>';
                  echo '<td>' . $row['precio'] . '</td>';
                  echo '<td><a href="#" class="btn btn-primary view-image-btn" data-image="../../uploads/' . $row['imagen'] . '">Ver imagen</a></td>';
                  echo '<td>';
                  echo '<a style="margin: 0 10px;" href="#" class="btn btn-danger delete-btn" data-id="' . $row['id'] . '">Eliminar</a>';
                  echo '<a href="editarProductos.php?id=' . $row['id'] . '" class="btn btn-primary">Editar</a>';
                  echo '</td>';
                  echo '</tr>';
                }
              } else {
                echo '<tr><td colspan="7">No hay productos disponibles</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

  <script>
    $(document).ready(function () {
      $(".delete-btn").click(function (e) {
        e.preventDefault();
        const productId = $(this).data("id");

        Swal.fire({
          title: "¿Estás seguro?",
          text: "Esta acción no se puede deshacer",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Sí, eliminar",
          cancelButtonText: "Cancelar"
        }).then((result) => {
          if (result.isConfirmed) {
            // Redirige a la página de eliminación con el ID del producto
            window.location.href = "../../controllers/eliminarProducto.php?id=" + productId;
          }
        });
      });
    });

    $(".view-image-btn").click(function (e) {
      e.preventDefault();
      const imageUrl = $(this).data("image");

      Swal.fire({
        title: "Imagen del Producto",
        imageUrl: imageUrl,
        imageAlt: "Imagen del producto"
      });
    });
  </script>
</body>

</html>