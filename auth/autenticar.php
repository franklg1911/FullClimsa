<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Conexion a la bd
    $servername = "brc9cbwy6gdnfx0ibqhn-mysql.services.clever-cloud.com";
    $username = "u2uhzjl9vvbeejwu";
    $password = "1ynHEVRW6BsH70EoNSRZ";
    $dbname = "brc9cbwy6gdnfx0ibqhn";

    //Crear conexion
    $conn = new mysqli($servername, $username, $password, $dbname);
    //Verificar conexion
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    //Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];


    //Consulta SQL para verificar el usuario y contraseña
    $sql = "SELECT id, nombre, email, tipo FROM usuarios WHERE (nombre = '$usuario' OR email = '$usuario') AND contraseña = '$contraseña'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        //Usuario autenticado correctamente
        $row = $result->fetch_assoc();
        // Almacenar datos del usuario en la sesión
        $_SESSION['id'] = $row['id'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['tipo'] = $row['tipo'];

        error_log("Usuario autenticado: " . $_SESSION['nombre']);
        error_log("Tipo de usuario: " . $_SESSION['tipo']);

        // Redirigir según el tipo de usuario
        if ($_SESSION['tipo'] == 'admin') {
            header("Location: ../view/admin/admin.php");
        } elseif ($_SESSION['tipo'] == 'usuario') {
            header("Location: ../view/user/index.php");
        } else if ($_SESSION['tipo'] == 'empleado') {
            header("Location: ../view/empleado/empleado.php");
        }

    } else { 
        //En caso escriba contraseña incorrecta o usuario
        header("Location: ../login.php");
    }

    //Cerramos conexion
    $conn->close();
} else {
    //Si intenta acceder sin escribir datos
    header("Location: ../login.php");
}

?>