<?php

include('../../config.php');

$id_pedido = $_POST['id_pedido'];
$estado = 1;


$sentencia = $pdo->prepare("UPDATE pedidos
   SET estado_pago = :estado, fecha_aceptacionOrechazo = :fecha_aprobacion
   WHERE id_pedido = :id_pedido");

$sentencia->bindParam(':estado', $estado);
$sentencia->bindParam(':fecha_aprobacion', $fechaHora);
$sentencia->bindParam(':id_pedido', $id_pedido);
$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "¡El pago fue aprobado con éxito!";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/admin/show_pedidos_pendientes.php');
exit();

?>
