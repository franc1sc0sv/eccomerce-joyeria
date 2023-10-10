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
    <form id="form_check" style="display: flex;gap: 3rem;max-width: 800px;margin: 5rem auto;">
        <div class="form_container" style="margin: 0;">
            <h2 class="text-center mb-4">Formulario de Compra</h2>
            <div>
                <div class=" form-group">
                    <label for="email">Nombre completo: </label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Ingrese su nombre">
                </div>
                <div class="form-group">
                    <label for="email">Direccion: </label>
                    <input type="text" name="direction" class="form-control" id="direction"
                        placeholder="Ingrese su direccion">
                </div>
                <div class="form-group">
                    <label for="email">Tarjeta de credito: </label>
                    <input type="text" name="card_number" class="form-control" id="card_number"
                        placeholder="1234567890123456 (16 digitos)">
                </div>
                <div class="form-group">
                    <label for="email">CV: </label>
                    <input type="number" name="cv" class="form-control" id="cv" placeholder="2133 - 123">
                </div>
                <div class="form-group">
                    <label for="email">Fecha de vencimiento: </label>
                    <input type="date" name="date" class="form-control" id="date">
                </div>
            </div>
        </div>
        <div class="form_container" style="margin: 0;">
            <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Tu pedido</h2>
                <div class="p-3 border">
                    <table class="table site-block-order-table mb-5">
                        <thead>
                            <th>Producto</th>
                            <th>Total</th>
                        </thead>
                        <tbody id="products_container">
                        </tbody>
                    </table>

                    <div class="form-group">
                        <button type="s" class="btn btn-primary btn-lg btn-block">Realizar
                            pedido</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php include_once("../../includes/scripts.php") ?>
    <script src="/assets/js/checkout.js"></script>

    <script>
        const form = document.getElementById('form_check');

        form.addEventListener('submit', async e => {
            e.preventDefault();

            const name = document.getElementById('name').value;
            const direction = document.getElementById('direction').value;
            const card_number = document.getElementById('card_number').value;
            const cv = document.getElementById('cv').value;
            const date = document.getElementById('date').value;

            const productsData = JSON.parse(localStorage.getItem('carritoJoyeria'))

            const formData = {
                name,
                direction,
                card_number,
                cv,
                date,
                productos: productsData
            };

            try {
                const response = await fetch('/controllers/comprar.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const responseData = await response.json();

                if (responseData.success) {
                    localStorage.setItem("carritoJoyeria", JSON.stringify([]))
                    Swal.fire({
                        title: 'Transaccion exitosa',
                        text: responseData.message,
                        type: 'success'
                    }).then(() => {
                        window.location = 'thankyou.php';
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: responseData.message,
                        type: 'error'
                    });
                }

            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred. Please try again later.',
                    type: 'error'
                });
            }

        });
    </script>

</body>

</html>