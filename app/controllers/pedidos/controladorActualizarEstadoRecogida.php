<?php 

include('../../config.php');

$id_detalle=$_POST['id_detalle'];

$estado = 1;


$sentencia = $pdo->prepare("UPDATE detalle_pedido
   SET estado_recogida = :estado_recogida, fecha_recogida=:fecha_recogida
   WHERE id_detalle = :id_detalle");

$sentencia->bindParam(':estado_recogida', $estado);
$sentencia->bindParam(':fecha_recogida', $fechaHora);
$sentencia->bindParam(':id_detalle', $id_detalle);
$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "¡El estado de recogida se actualizo con exito!";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/empresas/perfil/lista_pedidos.php');
exit();

?>
