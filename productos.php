<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FullClimsa</title>
    <!-- Icono de pestaña -->
    <link
      rel="shortcut icon"
      href="img/icono/iconoPestaña.png"
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
    <link rel="stylesheet" href="assets/css/style.css" />
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
                <a class="nav-link" href="login.php">INICIAR SESIÓN</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"
                  ><i class="fa-solid fa-cart-shopping"></i
                ></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <div class="container marketing">
        <hr class="featurette-divider" />
        <div class="row featurette">
          <div class="col text-center">
            <h2 class="featurette-heading mb-4" style="margin-top: 1px">
              ¡COMPRA UNA VARIEDAD DE PRODUCTOS!
            </h2>
          </div>
        </div>
        <!-- Primera fila de productos -->
        <div class="row mb-4">
          <div class="col-md-3 offset-md-1">
            <img
              src="img/productos/detergentes/sapolio_4kg.png"
              alt="Sapolio 4kg"
              class="img-fluid"
            />
            <h3 class="offset-md-2">DETERGENTE</h3>
            <p class="offset-md-2">SAPOLIO 4KG - <strong>S/28.00</strong></p>
              <a href="login.php" class="btn btn-FullClimsa-Secondary btn-lg offset-md-2">
                Agregar
              </a>
          </div>
          <div class="col-md-3 offset-md-1">
            <img
              src="img/productos/articulos/hude_rojo.png"
              alt="Hude rojo"
              class="img-fluid"
            />
            <h3 class="offset-md-2">LIMPIAVIDRIOS</h3>
            <p class="offset-md-2">HUDE ROJO - <strong>S/15.50</strong></p>
              <a href="login.php" class="btn btn-FullClimsa-Secondary btn-lg offset-md-2">
                Agregar
              </a>
          </div>
          <div class="col-md-3 offset-md-1">
            <img
              src="img/productos/jabon_liquido/aval_almendra_400ML.png"
              alt="Jabón Liquido"
              class="img-fluid"
            />
            <h3 class="offset-md-2">JABÓN LIQUIDO</h3>
            <p class="offset-md-2">
              AVAL ALMENDRA 400 ML - <strong>S/6.00</strong>
            </p>
              <a href="login.php" class="btn btn-FullClimsa-Secondary btn-lg offset-md-2">
                Agregar
              </a>
          </div>
        </div>

        <!-- Segunda fila de productos -->
        <div class="row mb-4">
          <div class="col-md-3 offset-md-1">
            <img
              src="img/productos/shampoo/head_shoulders_375ML.png"
              alt="Sapolio 4kg"
              class="img-fluid"
            />
            <h3 class="offset-md-2">SHAMPOO</h3>
            <p class="offset-md-2">
              HEAD&SHOULDERS 375 ML - <strong>S/17.90</strong>
            </p>
              <a href="login.php" class="btn btn-FullClimsa-Secondary btn-lg offset-md-2">
                Agregar
              </a>
          </div>
          <div class="col-md-3 offset-md-1">
            <img
              src="img/productos/desinfectantes/mr_musculo_500ML.png"
              alt="Hude rojo"
              class="img-fluid"
            />
            <h3 class="offset-md-2">DESINFECTANTE</h3>
            <p class="offset-md-2">
              MR. MÚSCULO 500 ML - <strong>S/17.00</strong>
            </p>
              <a href="login.php" class="btn btn-FullClimsa-Secondary btn-lg offset-md-2">
                Agregar
              </a>
          </div>
          <div class="col-md-3 offset-md-1">
            <img
              src="img/productos/articulos/hude_escobeta.png"
              alt="Jabón Liquido"
              class="img-fluid"
            />
            <h3 class="offset-md-2">ESCOBA</h3>
            <p class="offset-md-2">
              HUDE ESCOBESTIA - <strong>S/19.50</strong>
            </p>
              <a href="login.php" class="btn btn-FullClimsa-Secondary btn-lg offset-md-2">
                Agregar
              </a>
          </div>
        </div>

        <!-- Terecera fila de productos -->
        <div class="row mb-5">
          <div class="col-md-3 offset-md-1">
            <img
              src="img/productos/ambientadores/sapolio_1Galon.png"
              alt="Sapolio 4kg"
              class="img-fluid"
            />
            <h3 class="offset-md-2">LIMPIATODO</h3>
            <p class="offset-md-2">
              SAPOLIO 1 GALÓN - <strong>S/20.50</strong>
            </p>
              <a href="login.php" class="btn btn-FullClimsa-Secondary btn-lg offset-md-2">
                Agregar
              </a>
          </div>
          <div class="col-md-3 offset-md-1">
            <img
              src="img/productos/desinfectantes/sapolio_1L.png"
              alt="Hude rojo"
              class="img-fluid"
            />
            <h3 class="offset-md-2">LEJIA</h3>
            <p class="offset-md-2">SAPOLIO 1L - <strong>S/4.40</strong></p>
              <a href="login.php" class="btn btn-FullClimsa-Secondary btn-lg offset-md-2">
                Agregar
              </a>
          </div>
          <div class="col-md-3 offset-md-1">
            <img
              src="img/productos/desinfectantes/plop_forte_300ML.png"
              alt="Jabón Liquido"
              class="img-fluid"
            />
            <h3 class="offset-md-2">INSECTICIDA</h3>
            <p class="offset-md-2">
              PLOP FORTE 300 ML - <strong>S/15.90</strong>
            </p>
              <a href="login.php" class="btn btn-FullClimsa-Secondary btn-lg offset-md-2">
                Agregar
              </a>
          </div>
        </div>
        <hr class="featurette-divider" />
        <!-- /END THE FEATURETTES -->
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
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</html>
