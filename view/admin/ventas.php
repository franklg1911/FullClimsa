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

//Consulta para el historial de ventas
require_once("../../controller/ordenesController.php");
$ventas = getSalesHistory();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - FullClimsa</title>
        <!-- Icono de la pestaña -->
        <link rel="shortcut icon" href="../../img/icono/iconoPestaña.png" type="image/x-icon"/>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <!-- Estilos del admin -->
        <link href="../../assets/css/admin.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Datatable -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="admin.php">FullClimsa</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="?logout=1">Salir</a></li> <!--Salir de sesión-->
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Complementos</div>
                            <a class="nav-link" href="productos.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                Productos
                            </a>
                            <a class="nav-link" href="usuarios.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Usuarios
                            </a>
                            <a class="nav-link" href="usuarios.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-file-circle-question"></i></div>
                                Consultar
                            </a>
                            <a class="nav-link" href="proveedor.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-truck"></i></div>
                                Proveedor
                            </a>
                            <a class="nav-link" href="ventas.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-coins"></i></div>
                                Reporte ventas
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Historial de ventas</h1>
                         <div class="card mb-4">
                            <div class="card-body">
                                <table id="tablaVentas" class="table"  cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ORDEN DE COMPRA</th>
                                            <th>CLIENTE</th>
                                            <th>PRODUCTO</th>
                                            <th>CANTIDAD</th>
                                            <th>PRECIO</th>
                                            <th>TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach($ventas as $venta): ?>
                                            <tr>
                                                <td><?php echo $venta['orden_id']; ?></td>
                                                <td><?php echo $venta['cliente']; ?></td>
                                                <td><?php echo $venta['producto']; ?></td>
                                                <td><?php echo $venta['cantidad']; ?></td>
                                                <td><?php echo $venta['precio']; ?></td>
                                                <td><?php echo $venta['total_pago']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                       
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; FullClimsa 2024</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../assets/js/admin/ventas.js"></script>
    </body>
</html>
