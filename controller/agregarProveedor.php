<?php
require_once('../config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ruc = $_POST['ruc'];
    $razon_social = $_POST['razon_social'];
    $direccion = $_POST['direccion'];
    $distrito = $_POST['distrito'];
    $provincia = $_POST['provincia'];
    $departamento = $_POST['departamento'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo']; 
    $direccion = $_POST['direccion'];

    //Verificar si los campos estan vacios
    if (empty($ruc) || empty($razon_social) || empty($direccion)  || empty($distrito) || empty($provincia) || empty($departamento) || empty($celular) || empty($correo) || empty($direccion)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Preparar la consulta de inserción
    $sql = "INSERT INTO proveedor (ruc, razon_social, direccion, distrito, provincia, departamento, celular, correo) VALUES ('$ruc', '$razon_social', '$direccion' , '$distrito', '$provincia', '$departamento', '$celular', '$correo')";

    if ($conn->query($sql) === TRUE) {
        echo "¡Proveedor agregado correctamente!";
    } else {
        echo "Error al agregar al Proveedor: " . $conn->error;
    }

    $conn->close();
}
?>