<?php
session_start();
require_once("../config/conexion.php");

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $userId = $_SESSION['id'];

    // Verificar si el producto ya está en el carrito del usuario
    $sql_check = "SELECT id FROM carrito WHERE id_usuario = ? AND id_producto = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ii", $userId, $productId);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Si ya existe, incrementar la cantidad
        $sql_update = "UPDATE carrito SET cantidad = cantidad + 1 WHERE id_usuario = ? AND id_producto = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $userId, $productId);
        $stmt_update->execute();
    } else {
        // Si no existe, agregar nuevo registro al carrito
        $sql_insert = "INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, 1)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ii", $userId, $productId);
        $stmt_insert->execute();
    }

    // Obtener total de ítems en el carrito para actualizar el contador
    $sql_count = "SELECT COUNT(*) AS totalItems FROM carrito WHERE id_usuario = ?";
    $stmt_count = $conn->prepare($sql_count);
    $stmt_count->bind_param("i", $userId);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $row_count = $result_count->fetch_assoc();

    // Devolver respuesta con el total de ítems en el carrito
    $response = [
        'totalItems' => $row_count['totalItems']
    ];
    echo json_encode($response);
} else {
    echo json_encode(['error' => 'No se recibió el ID del producto']);
}
?>
