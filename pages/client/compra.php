<?php include_once("../../config.php") ?>

<?php
include_once("../../controllers/config/conexion.php");

if (!isset($_GET['id'])) {
    header("Location: ../../index.php");
}

$id = $_GET['id'];

$consulta = "SELECT * FROM productos WHERE id = $id";
$resultado = mysqli_query($conn, $consulta);
$isProduto = $resultado && mysqli_num_rows($resultado) > 0;

if (!$isProduto) {
    header("Location: ../../index.php");
}

$fila = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../../includes/heads.php") ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }

        .form_container {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 5rem auto;
        }
    </style>
</head>

<body>
    <?php include_once("../../includes/nav.php") ?>
    <div style="display: flex;gap: 3rem;max-width: 740px;margin: 5rem auto;">
        <?php include("../../includes/item.php"); ?>
        <div class="form_container" style="margin: 0 auto;">
            <h2 class="text-center mb-4">Formulario de Compra</h2>
            <form method="post" action="../../controllers/comprar.php">
                <div class="form-group">
                    <label for="email">Nombre completo: </label>
                    <input type="text" name="name" class="form-control" id="email" placeholder="Ingrese su nombre">
                </div>
                <div class="form-group">
                    <label for="email">Direccion: </label>
                    <input type="text" name="direction" class="form-control" id="email"
                        placeholder="Ingrese su direccion">
                </div>
                <div class="form-group">
                    <label for="email">Tarjeta de credito: </label>
                    <input type="text" name="card_number" class="form-control" id="email"
                        placeholder="1234567890123456 (16 digitos)">
                </div>
                <div class="form-group">
                    <label for="email">CV: </label>
                    <input type="number" name="cv" class="form-control" id="email" placeholder="2133 - 123">
                </div>
                <div class="form-group">
                    <label for="email">Fecha de vencimiento: </label>
                    <input type="date" name="date" class="form-control" id="email">
                </div>
                <input name="id" type="number" hidden value="<?php echo $id ?>">
                <button type="submit" class="btn btn-primary btn-block">Realizar la compra</button>
            </form>
        </div>
    </div>

    <?php include_once("../../includes/scripts.php") ?>
</body>

</html>