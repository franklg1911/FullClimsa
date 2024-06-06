<?php
require_once('../../config/conexion.php');

//Funcion para obtener los usuarios de la tabla
function getAllProducts(){
    global $conn;

    $sql = "SELECT * FROM productos";
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