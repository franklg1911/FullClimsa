<?php
require_once('../config/conexion.php');

//Recibir los datos
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contraseña = $_POST['contraseña'];
$tipo = $_POST['tipo'];

$sql = "UPDATE usuarios SET nombre = '$nombre', email = '$email', contraseña = '$contraseña', tipo = '$tipo' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "¡Usuario actualizado correctamente!";
} else {
    echo "Error al actualizar el usuario: " . $conn->error;
}

$conn->close();
?>