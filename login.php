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
                <a class="nav-link" href="nosotros.php">NOSOTROS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">PRODUCTOS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="login.php">INICIAR SESIÓN</a>
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
    <main class="form-signin">
      <form action="auth/autenticar.php" method="POST">
        <h1 class="h3 mb-3 fw-bold">INICIAR SESIÓN</h1>
        <div class="form-floating">
          <input
            type="usuario"
            class="form-control"
            id="usuario"
            name="usuario"
            placeholder="Usuario"
            autocomplete="off"
          />
          <label for="floatingInput">Usuario o Correo</label>
        </div>
        <div class="form-floating">
          <input
            type="password"
            class="form-control"
            id="contraseña"
            name="contraseña"
            placeholder="Contraseña"
            autocomplete="off"
          />
          <label for="floatingPassword">Contraseña</label>
        </div>
        <button class="w-100 btn btn-lg btn-FullClimsa-Secondary" type="submit">
          Ingresar
        </button>
        <p class="mt-3 text-center" style="color: black">
          ¿NO TIENES UNA CUENTA?
          <a href="register.php" style="color: #3f00fb">REGISTRATE</a>
        </p>
      </form>
    </main>
    <hr class="featurette-divider" />

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
