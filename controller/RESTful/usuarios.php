<?php
require '../../config/conexionRESTful.php';

$conexion = new Conexion();
$pdo = $conexion->obtenerConexion();

// Listar usuarios y consultar por ID
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM usuarios";
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

// Insertar usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombre'], $_POST['email'], $_POST['contraseña'], $_POST['tipo'])) {
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, tipo) VALUES (:nombre, :email, :password, :tipo)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nombre', $_POST['nombre']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':password', $_POST['contraseña']); // Cambiado a :password
        $stmt->bindValue(':tipo', $_POST['tipo']);
        
        if ($stmt->execute()) {
            $id = $pdo->lastInsertId();
            header("HTTP/1.1 200 OK");
            echo json_encode("Usuario agregado correctamente con ID: " . $id);
            exit;
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode("Error al agregar usuario");
            exit;
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode("Faltan campos requeridos");
        exit;
    }
}


// Actualizar usuario
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $sql = "UPDATE usuarios SET nombre=:nombre, email=:email, contraseña=:password, tipo=:tipo WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nombre', $_PUT['nombre']);
    $stmt->bindValue(':email', $_PUT['email']);
    $stmt->bindValue(':password', $_PUT['contraseña']);
    $stmt->bindValue(':tipo', $_PUT['tipo']);
    $stmt->bindValue(':id', $_PUT['id']);
    
    if ($stmt->execute()) {
        header("HTTP/1.1 200 OK");
        echo json_encode("Usuario actualizado correctamente");
        exit;
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode("Error al actualizar usuario");
        exit;
    }
}

// Eliminar usuario
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $sql = "DELETE FROM usuarios WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_DELETE['id']);
    
    if ($stmt->execute()) {
        header("HTTP/1.1 200 OK");
        echo json_encode("Usuario eliminado correctamente");
        exit;
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode("Error al eliminar usuario");
        exit;
    }
}

header("HTTP/1.1 400 Bad Request");
?>
