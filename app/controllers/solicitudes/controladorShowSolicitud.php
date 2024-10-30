<?php

$id_solicitud_get = $_GET['id'];


$sql_solicitud = "SELECT * FROM empresa JOIN solicitud_empresa on empresa.nit_empresa = solicitud_empresa.nit_empresa where solicitud_empresa.id_solicitud = $id_solicitud_get";


$query_solicitud = $pdo->prepare($sql_solicitud);
$query_solicitud->execute();
$datos_solicitud = $query_solicitud->fetchALL(PDO::FETCH_ASSOC);

foreach ($datos_solicitud as $dato_solicitud) {
    $id_solicitud = $dato_solicitud['id_solicitud'];
    $nit_empresa = $dato_solicitud['nit_empresa'];
    $nom_empresa = $dato_solicitud['nom_empresa'];
    $nom_propietario = $dato_solicitud['nom_propietario'];
    $correo = $dato_solicitud['correo'];
    $tel_contacto = $dato_solicitud['tel_contacto'];
    $estado = $dato_solicitud['estado'];
    $fyh_solicitud = $dato_solicitud['fyh_solicitud'];
}
