<?php
require_once('../config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Preparar y ejecutar la consulta de eliminación
    $sql = "DELETE FROM proveedor WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "¡Proveedor eliminado correctamente!";
    } else {
        echo "Error al eliminar el ¡Proveedor: " . $conn->error;
    }

    $conn->close();
}

?>