<?php
require_once('../config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];

    // Comprobar si se ha cargado una nueva imagen
    if (isset($_FILES['nuevaImagen']) && !empty($_FILES['nuevaImagen']['name'])) {
        $nuevaImagen = $_FILES['nuevaImagen']['name'];
        $nuevaImagenTemporal = $_FILES['nuevaImagen']['tmp_name'];

        // Mover la nueva imagen al directorio de imágenes
        move_uploaded_file($nuevaImagenTemporal, "../img/uploads/" . $nuevaImagen);
        
        // Actualizar la imagen en la base de datos
        $sqlUpdateImagen = "UPDATE productos SET imagen = '$nuevaImagen' WHERE id = $id";
        if (!$conn->query($sqlUpdateImagen)) {
            echo "Error al actualizar la imagen del producto: " . $conn->error;
            exit;
        }
    }

    // Actualizar los demás campos del producto
    $sqlUpdateProducto = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', stock = '$stock', categoria = '$categoria' WHERE id = $id";
    if ($conn->query($sqlUpdateProducto) === TRUE) {
        echo "¡Producto actualizado correctamente!";
    } else {
        echo "Error al actualizar el producto: " . $conn->error;
    }

    $conn->close();
}
?>
