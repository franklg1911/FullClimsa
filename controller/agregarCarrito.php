<?php
require_once("../config/conexion.php");

// Verificar si se recibió el producto_id por POST
if (isset($_POST['producto_id'])) {
    // Obtener el ID del producto enviado por POST
    $productoId = $_POST['producto_id'];

    $sql = "SELECT nombre, descripcion, precio FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productoId);
    $stmt->execute();
    $stmt->bind_result($nombre, $descripcion, $precio);
    
    // Verificar si se encontró el producto
    if ($stmt->fetch()) {
        // Guardar el producto en una sesión o estructura de datos
        session_start();
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }
        $_SESSION['carrito'][] = array(
            'id' => $productoId,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio
        );

        // Devolver los datos del producto en formato JSON
        echo json_encode(array(
            'success' => true,
            'message' => 'Producto agregado al carrito.',
            'producto' => array(
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio' => $precio
            )
        ));
    } else {
        // Si no se encuentra el producto, devolver un mensaje de error
        http_response_code(404);
        echo json_encode(array(
            'success' => false,
            'message' => 'Producto no encontrado.'
        ));
    }

    $stmt->close();
    $conn->close();
} else {
    // Si no se recibió el producto_id, devolver un mensaje de error
    http_response_code(400);
    echo json_encode(array(
        'success' => false,
        'message' => 'No se recibió el ID del producto.'
    ));
}
?>
