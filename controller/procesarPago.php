<?php
require_once("../config/conexion.php");

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit;
}

// Obtener ID de usuario de la sesión
$userId = $_SESSION['id'];

// Obtener información de pago del formulario
$cardNumber = $_POST['cardNumber'];
$cardExpiration = $_POST['cardExpiration'];
$cardCVC = $_POST['cardCVC'];

// Validar información de pago (aquí puedes agregar validaciones adicionales si es necesario)

// Calcular el total del carrito
$total = 0;

// Obtener productos del carrito
$sql_carrito = "SELECT carrito.id_producto, carrito.cantidad, productos.precio FROM carrito 
                INNER JOIN productos ON carrito.id_producto = productos.id
                WHERE carrito.id_usuario = ?";
$stmt_carrito = $conn->prepare($sql_carrito);
$stmt_carrito->bind_param("i", $userId);
$stmt_carrito->execute();
$result_carrito = $stmt_carrito->get_result();

while ($row = $result_carrito->fetch_assoc()) {
    $total += $row['precio'] * $row['cantidad'];
}

// Guardar orden en la base de datos
$conn->begin_transaction();

try {
    // Insertar en la tabla ordenes
    $sql_orden = "INSERT INTO ordenes (id_usuario, fecha, total_pago) VALUES (?, NOW(), ?)";
    $stmt_orden = $conn->prepare($sql_orden);
    $stmt_orden->bind_param("id", $userId, $total);
    $stmt_orden->execute();
    
    $orden_id = $conn->insert_id;

    // Insertar en la tabla detalle_ordenes
    $sql_detalle = "INSERT INTO detalle_ordenes (id_orden, id_producto, cantidad, precio) VALUES (?, ?, ?, ?)";

    $stmt_detalle = $conn->prepare($sql_detalle);

    // Reiniciar el puntero del resultado del carrito para volver a iterar
    $result_carrito->data_seek(0);

    while ($row = $result_carrito->fetch_assoc()) {
        $stmt_detalle->bind_param("iiid", $orden_id, $row['id_producto'], $row['cantidad'], $row['precio']);
        $stmt_detalle->execute();
    }

    // Vaciar el carrito
    $sql_vaciar_carrito = "DELETE FROM carrito WHERE id_usuario = ?";
    $stmt_vaciar_carrito = $conn->prepare($sql_vaciar_carrito);
    $stmt_vaciar_carrito->bind_param("i", $userId);
    $stmt_vaciar_carrito->execute();

    $conn->commit();

    // Redirigir a una página de confirmación de pago
    header("Location: ../view/user/confirmacion.php");
    exit;
} catch (Exception $e) {
    $conn->rollback();
    // Manejar el error adecuadamente
    echo "Error al procesar el pago: " . $e->getMessage();
}
?>
