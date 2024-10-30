<?php


$sql_solicitud = "SELECT * FROM empresa JOIN solicitud_empresa ON empresa.nit_empresa = solicitud_empresa.nit_empresa where solicitud_empresa.estado is null;";
$query_solicitud = $pdo->prepare($sql_solicitud);
$query_solicitud->execute();

$solicitudes = $query_solicitud->fetchALL(PDO::FETCH_ASSOC);
