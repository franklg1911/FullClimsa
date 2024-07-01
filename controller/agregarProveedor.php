<?php
require_once('../config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del POST
    $ruc = $_POST['ruc'];
    $razon_social = $_POST['razon_social'];
    $direccion = $_POST['direccion'];
    $distrito = $_POST['distrito'];
    $provincia = $_POST['provincia'];
    $departamento = $_POST['departamento'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];

    // Verificar si los campos están vacíos
    if (empty($ruc) || empty($razon_social) || empty($direccion) || empty($distrito) || empty($provincia) || empty($departamento) || empty($celular) || empty($correo)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Preparar la consulta de inserción
    $sql = "INSERT INTO proveedor (ruc, razon_social, direccion, distrito, provincia, departamento, celular, correo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $ruc, $razon_social, $direccion, $distrito, $provincia, $departamento, $celular, $correo);

    // Ejecutar la consulta y verificar el resultado
    if ($stmt->execute()) {
        echo "¡Proveedor agregado correctamente!";
    } else {
        echo "Error al agregar al proveedor: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
