<?php
require_once("config/conexion.php");

// Realizamos la consulta con filtro opcional por categoría
$sql = "SELECT * FROM productos";
if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
  $categoria = $_GET['categoria'];
  $sql .= " WHERE categoria = '$categoria'";
}
$result = $conn->query($sql);

// Verificar si hay productos
if ($result->num_rows > 0) {
  // Almacenar los productos en un array
  $productos = array();
  while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
  }
} else {
  $productos = array(); // Si no hay productos, inicializar un array vacío
}
?>
