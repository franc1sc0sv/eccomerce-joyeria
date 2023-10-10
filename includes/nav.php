<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/index.php">Joyeria Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="/index.php">Inicio</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Tienda</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/pages/client/tienda.php">Todos los productos</a></li>

                    </ul>
                </li>

            </ul>
            <div class="icons" style="display: flex;gap: 1rem;">
                <a style="text-decoration: none;color: black;" href="/pages/client/cart.php"
                    class="icons-btn d-inline-block bag">
                    <img style="height:28px" src="/assets/images/shopping-cart.png" alt="">
                    <span id="amount_shopping" class="number">0</span>
                </a>
                <?php if (!$isLoged) { ?>
                    <div>
                        <a class="btn btn-outline-dark" href="/pages/login.php">
                            Iniciar Sesion
                        </a>
                        <a class="btn btn-outline-dark" href="/pages/register.php">
                            Registrarse
                        </a>
                    </div>
                <?php } ?>

                <?php if ($isLoged) { ?>
                    <div style="display: flex;gap: 12px;align-items: center;">

                        <span style="font-size: large;font-weight: bold;"
                            class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <?php echo $_SESSION['name'] ?>
                        </span>
                        <a class="btn btn-outline-dark" href="/controllers/logout.php">
                            Cerrar Sesion
                        </a>
                    </div>

                <?php } ?>
            </div>

        </div>
    </div>
</nav>