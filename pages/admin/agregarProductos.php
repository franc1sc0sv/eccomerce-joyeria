<?php
include_once('./validaciones.php');
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

        <div class="container-fluid">
          <div class="d-flex flex-column justify-content-center">
            <h1 class="h3 mb-4 text-gray-800">Agregar productos</h1>
            <form style="width:100%" action="../../controllers/agregarProductos.php" method="post"
              enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nombre">Nombre del producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                  </div>
                  <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="precio">Precio</label>
                    <input max="99999999.99" type="number" class="form-control" id="precio" name="precio" step="0.01">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Material</label>
                    <input type="text" class="form-control" id="nombre" name="material">
                  </div>
                  <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*">
                  </div>


                  <button type="submit" class="btn btn-primary">Agregar Producto</button>
                </div>
              </div>
            </form>
          </div>
        </div>


      </div>

    </div>
  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>