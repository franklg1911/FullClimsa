<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: ../../login.php");
    exit;
}

//Verificar si se ha echo click en "salir"
if (isset($_GET['logout'])) {
    //Destruimos la sesión
    session_destroy();
    //Redirige al usuario al inicio de sesión
    header("Location: ../../login.php");
    exit; 
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pago</title>
    <!-- Icono de pestaña -->
    <link rel="shortcut icon" href="../../img/icono/iconoPestaña.png" type="image/x-icon"/>
    <!-- Bootstrap 5.0.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Iconos FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-FullClimsa">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">FULLCLIMSA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">INICIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="nosotros.php">NOSOTROS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="productos.php">PRODUCTOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active"><?php echo $_SESSION['nombre']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?logout=1">CERRAR SESIÓN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="cart-link" href="carrito.php">
                            <span id="cart-counter">VER CARRITO</span>
                            <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container" style="margin-top: 80px;">
        <div class="row featurette">
            <div class="col text-center">
                <h2 class="featurette-heading mb-4 text-black" style="margin-top: 1px">
                    Confirmación de Pago
                </h2>
                <p class="lead">Gracias por su compra. Su pedido ha sido procesado exitosamente verificar su email.</p>
                <i class="fas fa-check-circle" style="color: green; font-size: 3em;"></i><br><br>
                <a href="productos.php" class="btn btn-primary">Seguir Comprando</a>
                <a href="index.php" class="btn btn-secondary">Volver al Inicio</a>
            </div>
        </div>
        <hr class="featurette-divider" />
    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-3 fw-bold">CONTÁCTANOS</h3>
                    <p class="mb-1" style="color: black">
                        <i class="fa-solid fa-mobile-screen-button"></i>&nbsp;981458957
                    </p>
                    <p class="mb-1" style="color: black">
                        <i class="fa-solid fa-envelope"></i>&nbsp;fullcleanrygsac@hotmail.com
                    </p>
                    <p class="mb-0" style="color: black">
                        <i class="fa-solid fa-location-dot"></i>&nbsp;Av. Argentina Nro. 215 Int. R25 Z.I (C.C NICOLINE PASAJE 09)
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h3 class="mb-3 fw-bold">Redes Sociales</h3>
                    <div class="social-icons">
                        <a href="https://www.facebook.com" class="social-icon me-3">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.tiktok.com" class="social-icon">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap 5.0.2 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
