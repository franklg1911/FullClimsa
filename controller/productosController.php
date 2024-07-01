<?php
require_once('../../config/conexion.php');

// Función para obtener todos los productos con el nombre del proveedor
function getAllProducts(){
    global $conn;

    $sql = "SELECT p.id, p.id_proveedor, p.nombre, p.descripcion, p.precio, p.stock, p.categoria, p.imagen, pr.razon_social as nombre_proveedor 
            FROM productos p
            INNER JOIN proveedor pr ON p.id_proveedor = pr.id";

    $result = $conn->query($sql);

    $products = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}
?>
