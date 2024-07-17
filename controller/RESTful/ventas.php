<?php
require_once('../../config/conexionRESTful.php');

$conexion = new Conexion();
$pdo = $conexion->obtenerConexion();

// Determinar el método de solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Consultar ventas
if ($method === 'GET') {
    $sql = "SELECT ordenes.id AS orden_id, usuarios.nombre AS cliente, productos.nombre AS producto, detalle_ordenes.cantidad, detalle_ordenes.precio, ordenes.total_pago 
            FROM ordenes 
            INNER JOIN detalle_ordenes ON ordenes.id = detalle_ordenes.id_orden
            INNER JOIN productos ON detalle_ordenes.id_producto = productos.id
            INNER JOIN usuarios ON ordenes.id_usuario = usuarios.id
            ORDER BY ordenes.id DESC"; // Puedes ajustar el ORDER BY según tus necesidades

    // Si se especifica un ID de orden, filtrar por ese ID
    if (isset($_GET['id'])) {
        $sql .= " WHERE ordenes.id = :id";
        $params[':id'] = $_GET['id'];
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params ?? null);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        echo json_encode($stmt->fetchAll());
    } else {
        header("HTTP/1.1 404 Not Found");
        echo json_encode(array('message' => 'No se encontraron ventas.'));
    }
    exit;
}

// Si no coincide con ningún método de solicitud, devolver Bad Request
header("HTTP/1.1 400 Bad Request");
?>
