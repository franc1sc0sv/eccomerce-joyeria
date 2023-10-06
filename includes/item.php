<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</link>
<script>
    $(document).ready(function () {
        // Función para verificar si el usuario está logeado
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
</script>


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
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center">
                <p data-product-id=<?php echo $fila["id"] ?> class="comprarBtn btn btn-outline-dark mt-auto">
                    Comprar</p>
            </div>
        </div>
    </div>
</div>