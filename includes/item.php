<div class="col mb-5">
    <div class="card h-100">
        <!-- Sale badge-->
        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">En venta
        </div>
        <!-- Product image-->
        <img style="height: 250px;" class="card-img-top" src="/uploads/<?php echo $fila["imagen"] ?>" alt="..." />
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">
                    <?php echo $fila["nombre"] ?>
                </h5>
                <h6>
                    <?php echo $fila["material"] ?>
                </h6>
                <p>
                    <?php echo $fila["descripcion"] ?>
                </p>
                <!-- Product price-->
                <?php echo $fila["precio"] ?>
            </div>
        </div>
        <!-- Product actions-->
        <button onclick="addProduct(<?php echo $fila['id'] ?>)"
            style="margin:0 1rem;color: #343a40;background-color: transparent;background-image: none;border-color: #343a40;"
            class="btn">
            Agregar la carrito
        </button>
    </div>
</div>
<!-- 
<script>
    $(document).ready(function () {
        function estaLogeado(id) {
            $.ajax({
                url: '../controllers/estaLogeado.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.logeado) {
                        window.location.href = `../pages/client/compra.php?id=${id}`;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Al parecer no estas logeado!',
                            footer: '<a href="../pages/login.php">¿Quieres iniciar sesion?</a>'
                        })
                    }
                },
                error: function () {
                    console.error('Error al verificar si el usuario está logeado.');
                }
            });
        }

        $('.comprarBtn').click(function () {
            const productId = $(this).data('product-id');
            estaLogeado(productId);
        });
    });
</script> -->