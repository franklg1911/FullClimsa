<?php
require_once('../config/conexion.php');

// Verificamos si la solicitud es tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    // Validamos los datos
    if (!empty($nombre) && !empty($correo) && !empty($mensaje)) {
        $sql = "INSERT INTO consultas (nombre, correo, mensaje) VALUES ('$nombre', '$correo', '$mensaje')";

        // Ejecutamos la consulta
        if ($conn->query($sql) === TRUE) {
            // Enviamos una respuesta JSON de éxito
            echo json_encode(array("success" => true, "message" => "Consulta enviada correctamente"));
        } else {
            echo json_encode(array("success" => false, "message" => "Error al enviar la consulta: " . $conn->error));
        }

        $conn->close();

    } else {
        // Si faltan datos en el formulario, devolvemos un mensaje de error
        echo json_encode(array("success" => false, "message" => "Todos los campos son obligatorios"));
    }
} else {
    // Si la solicitud no es de tipo POST, devolvemos un mensaje de error
    echo json_encode(array("success" => false, "message" => "Solicitud no válida"));
}
?>
