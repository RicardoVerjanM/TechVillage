<?php

include('../../config.php');

$id_solicitud = $_POST['id_solicitud'];
$estado=1;

   $sentencia=$pdo->prepare("UPDATE solicitud_empresa
   SET estado=:estado 
   where id_solicitud =:id_solicitud");
 

$sentencia->bindParam(':estado',$estado);
$sentencia->bindParam(':id_solicitud',$id_solicitud);
$sentencia->execute();

$sentenciaStatus=$pdo->prepare("UPDATE empresa JOIN solicitud_empresa ON empresa.nit_empresa = solicitud_empresa.nit_empresa 
   SET empresa.status=:status,
       empresa.fyh_unionOrechazo=:fyh_unionOrechazo
   where id_solicitud =:id_solicitud");
 
 
$sentenciaStatus->bindParam(':status',$estado);
$sentenciaStatus->bindParam(':fyh_unionOrechazo',$fechaHora);
$sentenciaStatus->bindParam(':id_solicitud',$id_solicitud);
$sentenciaStatus->execute();


session_start();
$_SESSION['mensaje']="La empresa fue aceptada con exito";
$_SESSION['icono']="success";
header('Location: '.$URL.'/admin/show_solicitudes.php');


?>