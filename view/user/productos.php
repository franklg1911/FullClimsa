<?php
require_once("../../config/conexion.php");
require_once("../../controller/admin/consultarProducto.php");
require_once("../../controller/admin/filtrarCategoria.php");

//Iniciar sesión 
session_start();

//Verificar si se ha echo click en "salir"
if (!isset($_SESSION['id'])) {
    //Redirige al usuario a la página login.php
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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FullClimsa</title>
    <!-- Icono de pestaña -->
    <link
      rel="shortcut icon"
      href="../../img/icono/iconoPestaña.png"
      type="image/x-icon"
    />
    <!-- Bootstrap 5.0.2 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <!-- Estilos pagina web -->
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <!-- Iconos FontAwesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Estilos imagen -->
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-FullClimsa">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">FULLCLIMSA</a>
          <button
            class="navbar-toggler"
            !
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php"
                  >INICIO</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="nosotros.php">NOSOTROS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="productos.php">PRODUCTOS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"><?php echo $_SESSION['nombre']; ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?logout=1">CERRAR SESIÓN</a>
              </li>              
              <li class="nav-item">
                <a class="nav-link active" id="cart-link" href="carrito.php">
                  <i class="fa-solid fa-cart-shopping"></i>
                  <span id="cart-counter">0</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <div class="container marketing" style="margin-top: 50px;">
        <div class="row featurette">
          <div class="col text-center">
            <h2 class="featurette-heading mb-4" style="margin-top: 1px">
              PRODUCTOS
            </h2>
          </div>
        </div>
      <!-- Filtro por categoria -->
      <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
          <form>
            <div class="input-group">
              <select name="categoria" id="categoria" class="form-select">
                <option value="">Todas las categorías</option>
                  <?php
                    // Obtener categorías disponibles
                    $sql_categorias = "SELECT DISTINCT categoria FROM productos";
                    $result_categorias = $conn->query($sql_categorias);

                    if ($result_categorias->num_rows > 0) {
                      while ($row_categoria = $result_categorias->fetch_assoc()) {
                        echo '<option value="' . $row_categoria['categoria'] . '">' . $row_categoria['categoria'] . '</option>';
                      }
                    }
                  ?>
              </select>
              <button type="submit" class="btn btn-FullClimsa-Secondary">Filtrar</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Mostrar productos -->
      <div class="row">
        <?php
        // Iterar sobre la lista de productos y mostrar cada uno
        foreach ($productos as $producto) {
        ?>
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img class="bd-placeholder-img card-img-top" width="100%" src="../../img/uploads/<?php echo $producto['imagen']; ?>" alt="Producto">
                <div class="card-body">
                    <h3><?php echo $producto['nombre']; ?></h3>
                    <h5 class="text-black"><?php echo $producto['categoria']; ?></h5>
                    <p class="card-text"><?php echo $producto['descripcion']; ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-FullClimsa-Secondary agregar-btn" data-producto-id="<?php echo $producto['id']; ?>">Agregar</button>
                            <button type="button" class="btn btn-sm btn-danger quitar-btn" style="display:none;" data-producto-id="<?php echo $producto['id']; ?>">Quitar</button>
                        </div>
                        <small class="text-muted">S/.<?php echo $producto['precio']; ?></small>
                    </div>
                </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
      <hr class="featurette-divider" />
      <div class="container marketing" style="margin-top: 50px;">
        <div class="row featurette">
          <div class="col text-center">
            <h2 class="featurette-heading mb-4" style="margin-top: 1px">
              CARRITO DE COMPRA
            </h2>
          </div>
        </div>
        <!-- Carrito de compras -->
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered" id="tablaCarrito">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Aqui se mostrarán los productos agregados -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td style="font-weight: bold">Total:</td>
                            <td style="font-weight: bold">S/.0</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="row mt-3">
                  <div class="col text-end">
                    <button class="btn btn-FullClimsa-Secondary">Terminar Compra</button>
                  </div>
                </div>
            </div>
        </div>
      <hr class="featurette-divider" />
      </div>
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
              <i class="fa-solid fa-envelope"></i
              >&nbsp;fullcleanrygsac@hotmail.com
            </p>
            <p class="mb-0" style="color: black">
              <i class="fa-solid fa-location-dot"></i>&nbsp;Av. Argentina Nro.
              215 Int. R25 Z.I (C.C NICOLINE PASAJE 09)
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
  </body>
  <!-- Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Bootstrap 5.0.2 -->
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"
  ></script>
  <script src="../../assets/js/admin/carrito.js"></script>
  <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</html>
