<?php include_once("../../config.php") ?>

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

    <div class="form_container">
        <h2 class="text-center mb-4">Formulario de Compra</h2>
        <form>
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" placeholder="Ingrese su correo electrónico">
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" placeholder="Ingrese su contraseña">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Realizar la compra</button>
        </form>
    </div>

    <?php include_once("../../includes/scripts.php") ?>
</body>

</html>