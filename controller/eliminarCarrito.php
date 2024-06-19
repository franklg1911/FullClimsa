<?php
// Incluir archivo de conexión a la base de datos
require_once("../config/conexion.php");

// Verificar si se recibió un parámetro de ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Obtener el ID del producto a eliminar
    $idProducto = $_GET['id'];
    
    // Consulta SQL para eliminar el producto del carrito
    $sql_eliminar = "DELETE FROM carrito WHERE id = ?";
    $stmt_eliminar = $conn->prepare($sql_eliminar);
    $stmt_eliminar->bind_param("i", $idProducto);
    
    if ($stmt_eliminar->execute()) {
        // Redirigir de vuelta a la página del carrito después de eliminar
        header("Location: ../view/user/carrito.php");
        exit;
    } else {
        // Manejar cualquier error que ocurra al ejecutar la consulta
        echo "Error al intentar eliminar el producto del carrito.";
    }
} else {
    // Si no se recibió un ID válido, redirigir a algún lugar apropiado
    header("Location: carrito.php");
    exit;
}
?>
