<?php include_once("../../config.php") ?>
<?php
include_once("../../controllers/config/conexion.php");

$consulta = "SELECT * FROM productos";
$datos = $conn->consultar($consulta);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../../includes/heads.php") ?>
</head>

<body>
    <?php include_once("../../includes/nav.php") ?>
    <?php include_once("../../includes/hero.php") ?>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <?php
                foreach ($datos as $fila) {
                    include("../../includes/item.php");
                }
                ?>

            </div>
        </div>
    </section>

    <?php include_once("../../includes/footer.php") ?>
    <?php include_once("../../includes/scripts.php") ?>


</body>

</html>