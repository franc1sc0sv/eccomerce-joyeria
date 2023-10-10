<?php include_once("../../config.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once("../../includes/heads.php") ?>
</head>

<body>

  <div class="site-wrap">

    <?php include_once("../../includes/nav.php") ?>

    <div class="site-section" style="min-height: 100vh;min-height: 80vh;display: grid;place-items: center;">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Muchas gracias!</h2>
            <p class="lead mb-5">Tu orden se ha completado con exito. Comprobaremos los datos y te contactaremos</p>
            <p><a href="./tienda.php" class="btn btn-md height-auto px-4 py-3 btn-primary">Regresar a la tienda</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include_once("../../includes/scripts.php") ?>

</body>

</html>