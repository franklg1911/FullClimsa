<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Conexion a la bd
    $servername = "brc9cbwy6gdnfx0ibqhn-mysql.services.clever-cloud.com";
    $username = "u2uhzjl9vvbeejwu";
    $password = "1ynHEVRW6BsH70EoNSRZ";
    $dbname = "brc9cbwy6gdnfx0ibqhn";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    // Verificar si el usuario o el email ya existen
    $sql = "SELECT id FROM usuarios WHERE nombre = '$usuario' OR email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario o email ya existen
        echo "El usuario o el correo electrónico ya están registrados.";
    } else {
        // Insertar el nuevo usuario
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, tipo) VALUES ('$usuario', '$email', '$contraseña', 'usuario')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso";
            header("Location: ../login.php");
            exit();
        } else { 
            echo "Error:" .$sql . "<br>" . $conn->error;
        }
    }

    //Cerramos la conexion
    $conn->close();

} else {
    // Redirigir si se intenta acceder directamente al script
    header("Location: ../register.php");
    exit();
}
?>