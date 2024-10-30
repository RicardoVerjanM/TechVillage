<?php 

include('../../config.php');

$id_detalle=$_POST['id_detalle'];

$estado = 1;


$sentencia = $pdo->prepare("UPDATE detalle_pedido
   SET estado_producto = :estado_producto
   WHERE id_detalle = :id_detalle");

$sentencia->bindParam(':estado_producto', $estado);
$sentencia->bindParam(':id_detalle', $id_detalle);
$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "¡El estado de producto se actualizo con exito!";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/empresas/perfil/lista_pedidos.php');
exit();

?>
