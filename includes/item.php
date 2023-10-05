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
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Comprar</a>
            </div>
        </div>
    </div>
</div>