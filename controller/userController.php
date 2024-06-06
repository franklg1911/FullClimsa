<?php
require_once('../../config/conexion.php');

//Funcion para obtener los usuarios de la tabla
function getAllUsers(){
    global $conn;

    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    $users = [];
     if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    return $users;
}

?>