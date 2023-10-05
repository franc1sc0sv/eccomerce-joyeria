<?php include_once("config.php") ?>
<?php
include_once("./controllers/config/conexion.php");

$consulta = "SELECT * FROM productos ORDER BY id DESC LIMIT 2";
$resultado = mysqli_query($conn, $consulta);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("includes/heads.php") ?>
</head>

<body>
    <?php include_once("includes/nav.php") ?>
    <?php include_once("includes/hero.php") ?>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">

                <?php

                // Verificar si se obtuvieron resultados
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        include("includes/item.php");
                    }
                } else {
                    echo "No se encontraron productos.";
                }
                ?>
                <a class="col mb-5" href="/pages/client/tienda.php" style="text-decoration: none;">
                    <div class="card h-50 bg-dark "
                        style="color: white;font-weight: 500;display: grid;place-items: center;">

                        Ver mas productos →
                    </div>
                </a>
            </div>
        </div>
    </section>

    <?php include_once("includes/footer.php") ?>
    <?php include_once("includes/scripts.php") ?>


</body>

</html>