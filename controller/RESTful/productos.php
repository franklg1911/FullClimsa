<?php
require_once('../../config/conexionRESTful.php');

$conexion = new Conexion();
$pdo = $conexion->obtenerConexion();

// Determinar el método de solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Listar productos y consultar por ID
if ($method === 'GET') {
    $sql = "SELECT * FROM productos";
    $params = [];

    if (isset($_GET['id'])) {
        $sql .= " WHERE id=:id";
        $params[':id'] = $_GET['id'];
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($stmt->fetchAll());
    exit;
}

// Insertar producto
if ($method === 'POST') {
    // Verificar campos requeridos
    if (isset($_POST['id_proveedor'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['stock'], $_POST['categoria'])) {
        $sql = "INSERT INTO productos (id_proveedor, nombre, descripcion, precio, stock, categoria, imagen) VALUES (:id_proveedor, :nombre, :descripcion, :precio, :stock, :categoria, :imagen)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_proveedor', $_POST['id_proveedor']);
        $stmt->bindValue(':nombre', $_POST['nombre']);
        $stmt->bindValue(':descripcion', $_POST['descripcion']);
        $stmt->bindValue(':precio', $_POST['precio']);
        $stmt->bindValue(':stock', $_POST['stock']);
        $stmt->bindValue(':categoria', $_POST['categoria']);

        // Comprobar y manejar la carga de imagen
        $imagen = "";
        if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
            $imagen = $_FILES['imagen']['name'];
            $imagen_temporal = $_FILES['imagen']['tmp_name'];
            move_uploaded_file($imagen_temporal, "../../img/uploads/" . $imagen);
        }

        $stmt->bindValue(':imagen', $imagen);

        if ($stmt->execute()) {
            $id = $pdo->lastInsertId();
            header("HTTP/1.1 200 OK");
            echo json_encode("Producto agregado correctamente con ID: " . $id);
            exit;
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode("Error al agregar producto");
            exit;
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode("Faltan campos requeridos");
        exit;
    }
}

// Actualizar producto
if ($method === 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);

    $sql = "UPDATE productos SET id_proveedor=:id_proveedor, nombre=:nombre, descripcion=:descripcion, precio=:precio, stock=:stock, categoria=:categoria";

    // Verificar si se está actualizando la imagen
    if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
        $imagen = $_FILES['imagen']['name'];
        $imagen_temporal = $_FILES['imagen']['tmp_name'];
        move_uploaded_file($imagen_temporal, "../../img/uploads/" . $imagen);

        $sql .= ", imagen=:imagen";
    }

    $sql .= " WHERE id=:id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_proveedor', $_PUT['id_proveedor']);
    $stmt->bindValue(':nombre', $_PUT['nombre']);
    $stmt->bindValue(':descripcion', $_PUT['descripcion']);
    $stmt->bindValue(':precio', $_PUT['precio']);
    $stmt->bindValue(':stock', $_PUT['stock']);
    $stmt->bindValue(':categoria', $_PUT['categoria']);
    $stmt->bindValue(':id', $_PUT['id']);

    if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
        $stmt->bindValue(':imagen', $imagen);
    }

    if ($stmt->execute()) {
        header("HTTP/1.1 200 OK");
        echo json_encode("Producto actualizado correctamente");
        exit;
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode("Error al actualizar producto");
        exit;
    }
}

// Eliminar producto
if ($method === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);

    $sql = "DELETE FROM productos WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_DELETE['id']);

    if ($stmt->execute()) {
        header("HTTP/1.1 200 OK");
        echo json_encode("Producto eliminado correctamente");
        exit;
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode("Error al eliminar producto");
        exit;
    }
}

// Si no coincide con ningún método de solicitud, devolver Bad Request
header("HTTP/1.1 400 Bad Request");
?>
