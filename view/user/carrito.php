<?php
require_once("../../config/conexion.php");

session_start();

if (!isset($_SESSION['id'])) {
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

// Obtener ID de usuario de la sesión
$userId = $_SESSION['id'];

// Consulta para obtener los productos en el carrito del usuario
$sql_carrito = "SELECT carrito.id, productos.nombre, productos.descripcion, productos.precio, productos.imagen, carrito.cantidad FROM carrito 
INNER JOIN productos ON carrito.id_producto = productos.id WHERE carrito.id_usuario = ?";
$stmt_carrito = $conn->prepare($sql_carrito);
$stmt_carrito->bind_param("i", $userId);
$stmt_carrito->execute();
$result_carrito = $stmt_carrito->get_result();

// Obtener todos los productos en un array
$productos_carrito = [];
while ($row = $result_carrito->fetch_assoc()) {
    $productos_carrito[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
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
                            <a class="nav-link"><?php echo $_SESSION['nombre']; ?></a>
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
    <div class="container marketing" style="margin-top: 50px;">
        <div class="row featurette">
          <div class="col text-center">
            <h2 class="featurette-heading mb-4" style="margin-top: 1px">
              CARRITO DE COMPRAS
            </h2>
        </div>
    </div>
    <!-- Carrito de compras -->
    <main class="container" style="margin-top: 80px;">
        <div class="row">
             <?php foreach ($productos_carrito as $producto) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="../../img/uploads/<?php echo $producto['imagen']; ?>" class="card-img-top" alt="Producto">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
                            <p class="card-text"><?php echo $producto['descripcion']; ?></p>
                            <p class="card-text">Cantidad: <?php echo $producto['cantidad']; ?></p>
                            <p class="card-text">Precio unitario: S/. <?php echo $producto['precio']; ?></p>
                            <a href="../../controller/eliminarCarrito.php?id=<?php echo $producto['id']; ?>" class="btn btn-danger">Eliminar del carrito</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Total a pagar -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p class="text-black">Lugar de recojo: Tienda física Nro 215 R25 Av. Argentina</p>
                        <?php
                        $total = 0;
                        // Iterar sobre los productos en el carrito y sumar los precios
                        foreach ($productos_carrito as $producto) {
                            $subtotal = $producto['precio'] * $producto['cantidad'];
                            $total += $subtotal;
                        }
                        ?>
                        <p class="text-black">Total a pagar: S/. <?php echo number_format($total, 2); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end mt-4">
            <a href="productos.php" class="btn btn-FullClimsa-Secondary">Continuar Comprando</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">Pagar</button>
        </div>
    <hr class="featurette-divider" />
    </main>
    <!-- Footer -->
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
    <!-- Modal de pago -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="paymentForm" method="POST" action="../../controller/procesarPago.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">Información de Pago</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">Número de Tarjeta</label>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="cardExpiration" class="form-label">Fecha de Expiración (MM/AA)</label>
                            <input type="text" class="form-control" id="cardExpiration" name="cardExpiration" required>
                        </div>
                        <div class="mb-3">
                            <label for="cardCVC" class="form-label">CVC</label>
                            <input type="password" class="form-control" id="cardCVC" name="cardCVC" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Pagar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap 5.0.2 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
