<?php
require '../../config/conexionRESTful.php';

$conexion = new Conexion();
$pdo = $conexion->obtenerConexion();

// Listar proveedores y consultar por ID
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM proveedor";
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

// Insertar proveedor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ruc'], $_POST['razon_social'], $_POST['direccion'], $_POST['distrito'], $_POST['provincia'], $_POST['departamento'], $_POST['celular'], $_POST['correo'])) {
        $sql = "INSERT INTO proveedor (ruc, razon_social, direccion, distrito, provincia, departamento, celular, correo) VALUES (:ruc, :razon_social, :direccion, :distrito, :provincia, :departamento, :celular, :correo)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ruc', $_POST['ruc']);
        $stmt->bindValue(':razon_social', $_POST['razon_social']);
        $stmt->bindValue(':direccion', $_POST['direccion']);
        $stmt->bindValue(':distrito', $_POST['distrito']);
        $stmt->bindValue(':provincia', $_POST['provincia']);
        $stmt->bindValue(':departamento', $_POST['departamento']);
        $stmt->bindValue(':celular', $_POST['celular']);
        $stmt->bindValue(':correo', $_POST['correo']);
        
        if ($stmt->execute()) {
            $id = $pdo->lastInsertId();
            header("HTTP/1.1 200 OK");
            echo json_encode("Proveedor agregado correctamente con ID: " . $id);
            exit;
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode("Error al agregar proveedor");
            exit;
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode("Faltan campos requeridos");
        exit;
    }
}

// Actualizar proveedor
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $sql = "UPDATE proveedor SET ruc=:ruc, razon_social=:razon_social, direccion=:direccion, distrito=:distrito, provincia=:provincia, departamento=:departamento, celular=:celular, correo=:correo WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':ruc', $_PUT['ruc']);
    $stmt->bindValue(':razon_social', $_PUT['razon_social']);
    $stmt->bindValue(':direccion', $_PUT['direccion']);
    $stmt->bindValue(':distrito', $_PUT['distrito']);
    $stmt->bindValue(':provincia', $_PUT['provincia']);
    $stmt->bindValue(':departamento', $_PUT['departamento']);
    $stmt->bindValue(':celular', $_PUT['celular']);
    $stmt->bindValue(':correo', $_PUT['correo']);
    $stmt->bindValue(':id', $_PUT['id']);
    
    if ($stmt->execute()) {
        header("HTTP/1.1 200 OK");
        echo json_encode("Proveedor actualizado correctamente");
        exit;
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode("Error al actualizar proveedor");
        exit;
    }
}

// Eliminar proveedor
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $sql = "DELETE FROM proveedor WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_DELETE['id']);
    
    if ($stmt->execute()) {
        header("HTTP/1.1 200 OK");
        echo json_encode("Proveedor eliminado correctamente");
        exit;
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode("Error al eliminar proveedor");
        exit;
    }
}


header("HTTP/1.1 400 Bad Request");
?>
