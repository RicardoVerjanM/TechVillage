<?php
// Incluye tu archivo de configuración de la base de datos

// Consulta para obtener productos

$sql_productos = "SELECT p.id_producto, p.nom_producto, p.precio_producto, f.foto_1 
          FROM productos p
          JOIN fotos_producto f ON p.id_producto = f.id_producto";
$query_productos = $pdo->prepare($sql_productos);
$query_productos->execute();

$productos = $query_productos->fetchALL(PDO::FETCH_ASSOC);
