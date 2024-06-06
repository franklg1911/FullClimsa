<?php
require_once('../config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio']; 
    $stock = $_POST['stock']; 
    $categoria = $_POST['categoria'];

    //Comprobar si se cargó la imagen
    if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
        $imagen = $_FILES['imagen']['name'];
        $imagen_temporal = $_FILES['imagen']['tmp_name'];

        // Mover la imagen al directorio
        move_uploaded_file($imagen_temporal, "../img/uploads/" . $imagen);
    } else {
        // Manejar en caso no se suba ninguna imagen
        $imagen = ""; // imagen predeterminada o en blanco
    }

    // Verificar campos requeridos
    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($categoria)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Preparar la consulta de inserción
    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$categoria', '$imagen')";

    if ($conn->query($sql) === TRUE) {
        echo "¡Producto agregado correctamente!";
    } else {
        echo "Error al agregar el producto: " . $conn->error;
    }

    $conn->close();
}
?>
