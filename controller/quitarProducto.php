<?php
session_start();
require_once("../config/conexion.php");

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $userId = $_SESSION['id'];

    // Verificar si el producto está en el carrito del usuario
    $sql_delete = "DELETE FROM carrito WHERE id_usuario = ? AND id_producto = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("ii", $userId, $productId);
    $stmt_delete->execute();

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
