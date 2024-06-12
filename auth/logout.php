<?php
session_start();

//Destruye todas las variables
session_unset();
session_destroy();
//Dirige a iniciar sesión
header("Location: ../login.php");
exit;
?>