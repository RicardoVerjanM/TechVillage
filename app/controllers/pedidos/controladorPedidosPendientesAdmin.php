
<?php

$sql_pedido = "SELECT *, clientes.nombres 
FROM pedidos 
JOIN clientes ON clientes.cedula = pedidos.id_cliente 
WHERE estado_pago IS NULL";
$query_pedido = $pdo->prepare($sql_pedido);
// No necesitas vincular :id_cliente si no lo estás utilizando en la consulta
$query_pedido->execute();

$pedidos = $query_pedido->fetchAll(PDO::FETCH_ASSOC);

