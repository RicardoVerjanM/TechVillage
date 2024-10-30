<?php

include('../../config.php');
include('../../controllers/clientes/sesionClientes.php');


// Obtener el id_producto a eliminar
$id_producto = $_GET['id'];
 // Asegúrate de que el ID se pasa a través de la URL

// Preparar la consulta para eliminar el producto del carrito
$sql = "DELETE FROM carrito WHERE id_cliente = :id_cliente AND id_producto = :id_producto";
$query = $pdo->prepare($sql);
$query->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
$query->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);

// Ejecutar la consulta
if ($query->execute()) {
    // Si la eliminación es exitosa, establece un mensaje de éxito
    session_start();
    $_SESSION['mensaje'] = "Producto eliminado del carrito exitosamente.";
    $_SESSION['icon'] = "success";
    header('Location: ' . $URL . '/mi_carrito.php');
    exit();
} else {
    // Si hay un error, establece un mensaje de error
    session_start();
    $_SESSION['mensaje'] = "Error al eliminar el producto del carrito.";
    $_SESSION['icon'] = "error";
    header('Location: ' . $URL . '/mi_carrito.php');
    exit();
}

// Redirigir de vuelta a la lista del carrito
header('Location: ' . $URL . '/mi_carrito.php');
exit();
