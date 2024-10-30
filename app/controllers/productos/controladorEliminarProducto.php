<?php


include('../../config.php');

$id_producto=$_POST['id_producto'];


$sentencia=$pdo->prepare("DELETE FROM productos WHERE id_producto=:id_producto");


$sentencia->bindParam('id_producto',$id_producto);
$sentencia->execute();


session_start();
$_SESSION['mensaje']="Se elimino el producto de manera correcta";
$_SESSION['icono']="success";
header('Location: '.$URL.'/empresas/perfil/lista_productos.php');






?>