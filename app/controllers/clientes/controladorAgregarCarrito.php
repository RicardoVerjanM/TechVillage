<?php

include('../../config.php');
include('../clientes/sesionClientes.php');

$id_producto = $_POST['id_producto'];

if ($validar_sesion == true) {

    // Preparar la sentencia SQL
    $sentencia = $pdo->prepare("INSERT INTO carrito (id_cliente, id_producto) VALUES (:id_cliente, :id_producto)");

    // Vincular los parámetros con los valores correctos
    $sentencia->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $sentencia->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);  // Corrige aquí

    $sentencia->execute();


    session_start();
    $_SESSION['mensaje'] = "Producto agregado al carrito exitosamente";
    $_SESSION['icon'] = "success";
    header('Location: ' . $URL . '/detalle_producto.php?id=' . $id_producto);
    exit();
} else {
    header('Location: ' . $URL . '/clientes/login_cliente.php');
    exit();
}
