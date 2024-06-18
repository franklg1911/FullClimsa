<?php
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
    <!-- Sweet alert 2 -->
    <link href="../../vendor/plugin/sweetalert2.min.css" rel="stylesheet" />
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
                <a class="nav-link active" href="nosotros.php">NOSOTROS</a>
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
                <a class="nav-link" style="cursor: pointer"
                  ><i class="fa-solid fa-cart-shopping"></i
                ></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              class="bd-placeholder-img"
              src="../../img/banner/Banner_5.png"
              alt="Banner 2"
            />
            <div class="container">
              <div class="carousel-caption">
                <h1>NOSOTROS</h1>
                <p>
                  Somos tu aliado confiable para mantener tu hogar y espacio
                  limpios y seguros
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container marketing">
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">NUESTRA EMPRESA</h2>
            <p class="lead">
              FULLCLIMSA es más que una empresa de productos de limpieza; somos
              un equipo comprometido con la excelencia y la satisfacción del
              cliente. Desde nuestra fundación, hemos estado dedicados a
              proporcionar productos y servicios de primera calidad que ayuden a
              nuestros clientes a mantener espacios limpios y seguros.
            </p>
          </div>
          <div class="col-md-5">
            <img
              class="img-nosotros"
              src="../../img/nosotros/imagen_1.png"
              alt="Imagen 1"
            />
          </div>
        </div>
        
        <hr class="featurette-divider" />
        
        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">EN NUESTRA ORGANIZACIÓN</h2>
            <p class="lead">
              Valoramos la confianza que nuestros clientes depositan en nosotros
              y nos esforzamos por merecerla en cada interacción. Creemos en
              construir relaciones sólidas y duraderas con nuestros clientes,
              basadas en la transparencia, la integridad y el compromiso con la
              calidad. Estamos aquí para ayudarle a alcanzar sus objetivos de
              limpieza y contribuir al éxito de su negocio.
            </p>
          </div>
          <div class="col-md-5 order-md-1">
            <img
              class="img-nosotros"
              src="../../img/nosotros/imagen_2.png"
              alt="Imagen 1"
            />
          </div>
        </div>
        <!-- Formulario de quejas y consultas -->
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Consulta y reclamos</h2>
            <form id="consultaReclamoForm">
              <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" autocomplete="off" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" autocomplete="off" required>
              </div>
              <div class="mb-3">
                <label for="message" class="form-label">Mensaje</label>
                <textarea name="mensaje" class="form-control" id="mensaje" rows="3" autocomplete="off" required></textarea>
              </div>
              <button type="submit" class="btn btn-FullClimsa-Secondary">Enviar</button>
            </form>
        </div>
        <hr class="featurette-divider" />
        <!-- /END THE FEATURETTES -->
      </div>
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
  <script src="../../assets/js/user/consulta.js"></script>
  <script src="../../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../vendor/plugin/sweetalert2.all.min.js"></script>
</html>
