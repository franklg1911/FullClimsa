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

//Consultar a la tabla usuarios
require_once("../../controller/productosController.php");
$productos = getAllProducts();

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
                        <h1 class="mt-4 mb-4">Productos</h1>
                         <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarProductoModal"><i class="fa-solid fa-cart-plus"></i> Agregar producto</button>
                            </div>
                            <div class="card-body">
                                <table id="tablaProductos" class="table"  cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ID PROVEEDOR</th>
                                            <th>NOMBRE PROVEEDOR</th>
                                            <th>NOMBRE</th>
                                            <th>DESCRIPCION</th>
                                            <th>PRECIO (S/.)</th>
                                            <th>STOCK</th>
                                            <th>CATEGORIA</th>
                                            <th>IMAGEN</th>
                                            <th>EDITAR</th>
                                            <th>ELIMINAR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($productos as $producto): ?>
                                            <tr>
                                                <td><?php echo $producto['id']; ?></td>
                                                <td><?php echo $producto['id_proveedor']; ?></td>
                                                <td><?php echo $producto['nombre_proveedor']; ?></td>
                                                <td><?php echo $producto['nombre']; ?></td>
                                                <td><?php echo $producto['descripcion']; ?></td>
                                                <td><?php echo $producto['precio']; ?></td>
                                                <td><?php echo $producto['stock']; ?></td>
                                                <td><?php echo $producto['categoria']; ?></td>
                                                <td><img src="../../img/uploads/<?php echo $producto['imagen']; ?>" alt="Imagen" style="width: 100px"></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning editarBtn" data-bs-toggle="modal" data-bs-target="#editarProductosModal" data-id="<?php echo $producto['id']; ?>">Editar</button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger eliminarBtn" data-id="<?php echo $producto['id']; ?>">Eliminar</button>
                                                </td>
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
        <!-- Modal para agregar -->
        <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agregarProductoModalLabel">Agregar Productos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="agregarProductosForm" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Proveedor</label>
                                <select id="proveedorAgregar" class="form-control" name="id_proveedor" required>
                                    <option value="">Selecciona un proveedor</option>
                                    <?php
                                        require_once('../../controller/proveedorController.php');

                                        $proveedores = getAllProveedor();
                                        foreach ($proveedores as $proveedor) {
                                            echo '<option value="' . $proveedor['id'] . '">' . $proveedor['razon_social'] . '</option>';
                                        }
                                    ?>
                                </select> 
                            </div>                           
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombreAgregar" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Descripcion</label>
                                <input type="text" class="form-control" id="descripcionAgregar" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Precio (S/.)</label>
                                <input type="text" class="form-control" id="precioAgregar" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stockAgregar" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Categoria</label>
                                <input type="text" class="form-control" id="categoriaAgregar" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Imagen</label>
                                <input type="file" class="form-control" id="imagenAgregar" autocomplete="off">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para editar -->
        <div class="modal fade" id="editarProductosModal" tabindex="-1" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarProductoModalLabel">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editarProductoForm">
                        <input type="hidden" id="userId">
                        <input type="hidden" id="proveedorId">
                        <div class="mb-3">
                            <label class="form-label">Proveedor</label>
                            <select id="proveedorEditar" class="form-control" name="id_proveedor" required>
                                <option value="">Selecciona un proveedor</option>
                                <?php
                                    require_once('../../controller/proveedorController.php');

                                    $proveedores = getAllProveedor();
                                    foreach ($proveedores as $proveedor) {
                                        echo '<option value="' . $proveedor['id'] . '">' . $proveedor['razon_social'] . '</option>';
                                    }
                                ?>
                            </select> 
                        </div>      
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio (S/.)</label>
                            <input type="text" class="form-control" id="precio" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Categoría</label>
                            <input type="text" class="form-control" id="categoria" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Imagen actual</label><br>
                            <img id="imagenActual" src="" alt="Imagen Actual" style="max-width: 100px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nueva Imagen</label>
                            <input type="file" class="form-control" id="nuevaImagen" autocomplete="off">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-warning" id="guardarCambiosBtn">Editar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../assets/js/admin/productos.js"></script>
    </body>
</html>
