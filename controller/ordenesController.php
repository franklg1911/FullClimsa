<?php
require_once('../../config/conexion.php');

// Función para obtener el historial de ventas
function getSalesHistory() {
    global $conn;

    $sql = "SELECT ordenes.id AS orden_id, usuarios.nombre AS cliente, productos.nombre AS producto, detalle_ordenes.cantidad, detalle_ordenes.precio, ordenes.total_pago 
            FROM ordenes 
            INNER JOIN detalle_ordenes ON ordenes.id = detalle_ordenes.id_orden
            INNER JOIN productos ON detalle_ordenes.id_producto = productos.id
            INNER JOIN usuarios ON ordenes.id_usuario = usuarios.id
            ORDER BY ordenes.id DESC"; // Puedes ajustar el ORDER BY según tus necesidades

    $result = $conn->query($sql);

    $sales = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sales[] = $row;
        }
    }
    return $sales;
}
?>