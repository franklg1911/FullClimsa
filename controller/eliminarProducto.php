<?php
require_once('../config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del producto a eliminar
    $id = $_POST['id'];

    $sql = "DELETE FROM productos WHERE id = $id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "¡Producto eliminado correctamente!";
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }

    $conn->close();
}
?>