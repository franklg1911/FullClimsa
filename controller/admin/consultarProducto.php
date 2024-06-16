<?php
require_once("../../config/conexion.php");

//Realizamos la consulta
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

//Verificar si hay productos
if ($result->num_rows > 0) {
  //Almacena los productos en un array
  $productos = array();
  while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
  }
} else {
  $productos = array(); //Si no hay productos, inicializar un array en 0
}
?>