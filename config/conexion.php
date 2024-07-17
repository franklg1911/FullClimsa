<?php
$servername = "localhost";
$username = "u2uhzjl9vvbeejwu";
$password = "1ynHEVRW6BsH70EoNSRZ";
$dbname = "brc9cbwy6gdnfx0ibqhn";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>