<?php
require_once('../config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña']; 
    $tipo = $_POST['tipo'];

    //Verificar si los campos estan vacios
    if (empty($nombre) || empty($email) || empty($contraseña) || empty($tipo)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Preparar la consulta de inserción
    $sql = "INSERT INTO usuarios (nombre, email, contraseña, tipo) VALUES ('$nombre', '$email', '$contraseña', '$tipo')";

    if ($conn->query($sql) === TRUE) {
        echo "¡Usuario agregado correctamente!";
    } else {
        echo "Error al agregar el usuario: " . $conn->error;
    }

    $conn->close();
}
?>