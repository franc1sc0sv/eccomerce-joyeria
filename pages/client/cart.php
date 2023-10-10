<?php include_once("../../config.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once("../../includes/heads.php") ?>
</head>

<body>

  <div class="site-wrap">
    <?php include_once("../../includes/nav.php") ?>


    <div style="padding:5rem 0;max-width: 720px;margin: 0 auto;display: flex;gap: 2rem;justify-content: center;"
      class="site-section">
      <form class="col-md-12" method="post">
        <div class="site-blocks-table">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="product-thumbnail">Imagen</th>
                <th class="product-name">Producto</th>
                <th class="product-price">Precio</th>
                <th class="product-quantity">Cantidad</th>
                <th class="product-total">Total</th>
                <th class="product-remove">Remover</th>
              </tr>
            </thead>
            <tbody id="products_container">

            </tbody>
          </table>
        </div>
      </form>
      <div class="col-md-6 pl-5">
        <div class="row justify-content-end">
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Total del carrtito</h3>
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-md-6">
                <span class="text-black">Subtotal</span>
              </div>
              <div class="col-md-6 text-right">
                <strong id="subtotal" class="text-black">$230.00</strong>
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-md-6">
                <span class="text-black">Total</span>
              </div>
              <div class="col-md-6 text-right">
                <strong id="total" class="text-black">$230.00</strong>
              </div>
            </div>

            <div class="row">
              <button class="btn btn-primary btn-lg btn-block" onclick="goCheckOut()">
                Proceder con el pago
              </button>
            </div>
          </div>
        </div>
      </div>
      <p id="message"></p>
    </div>

  </div>
  <?php include_once("../../includes/scripts.php") ?>
  <script src=" /assets/js/CRUD_CART.js"></script>

</body>

</html>