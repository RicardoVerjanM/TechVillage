<?php

$sql_pedido = "SELECT *, clientes.nombres 
FROM pedidos 
JOIN clientes ON clientes.cedula = pedidos.id_cliente 
WHERE pedidos.estado_pago IS NOT NULL";  // Cambio realizado aquí
$query_pedido = $pdo->prepare($sql_pedido);
$query_pedido->execute();

$pedidos = $query_pedido->fetchAll(PDO::FETCH_ASSOC);

?>
