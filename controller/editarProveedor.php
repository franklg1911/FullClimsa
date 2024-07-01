<?php
require_once('../config/conexion.php');

//Recibir los datos
$id = $_POST['id'];
$ruc = $_POST['ruc'];
$razon_social = $_POST['razon_social'];
$direccion = $_POST['direccion'];
$distrito = $_POST['distrito'];
$provincia = $_POST['provincia'];
$departamento = $_POST['departamento'];
$celular = $_POST['celular'];
$correo = $_POST['correo'];

$sql = "UPDATE proveedor SET ruc = '$ruc', razon_social = '$razon_social', direccion = '$direccion', distrito = '$distrito' ,  provincia = '$provincia', departamento = '$departamento' , celular = '$celular' , correo = '$correo' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "!Proveedor actualizado correctamente!";
} else {
    echo "Error al actualizar el Proveedor: " . $conn->error;
}

$conn->close();
?>