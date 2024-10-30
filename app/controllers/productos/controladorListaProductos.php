<?php




$sql_solicitud = "SELECT * FROM productos JOIN empresa on productos.id_empresa = empresa.nit_empresa where empresa.nit_empresa = $sesion_nit_empresa ;";
$query_solicitud = $pdo->prepare($sql_solicitud);
$query_solicitud->execute();

$productos = $query_solicitud->fetchALL(PDO::FETCH_ASSOC);

