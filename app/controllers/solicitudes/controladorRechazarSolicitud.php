<?php

include('../../config.php');

$id_solicitud = $_POST['id_solicitud'];


   $sentencia=$pdo->prepare("DELETE empresa FROM empresa join solicitud_empresa on empresa.nit_empresa=solicitud_empresa.nit_empresa
   where id_solicitud =:id_solicitud");
 
 
$sentencia->bindParam(':id_solicitud',$id_solicitud);
$sentencia->execute();


session_start();
$_SESSION['mensaje']="La empresa fue rechazada con exito";
$_SESSION['icono']="success";
header('Location: '.$URL.'/admin/show_solicitudes.php');























?>