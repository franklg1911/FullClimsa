<?php
require_once('../../config/conexion.php');

//Funcion para obtener los usuarios de la tabla
function getAllProveedor(){
    global $conn;

    $sql = "SELECT * FROM proveedor";
    $result = $conn->query($sql);

    $proveedor = [];
     if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $proveedor[] = $row;
        }
    }
    return $proveedor;
}

?>