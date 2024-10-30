<?php

$sql_pedido = "SELECT pedidos.*, clientes.nombres, dp.*, p.nom_producto, e.nom_empresa 
FROM pedidos 
JOIN clientes ON clientes.cedula = pedidos.id_cliente
JOIN detalle_pedido dp ON dp.id_pedido = pedidos.id_pedido  
JOIN productos p ON dp.id_producto = p.id_producto          
JOIN empresa e ON e.nit_empresa = p.id_empresa              
WHERE e.nit_empresa = :nit_empresa 
AND pedidos.estado_pago = 1";  // Añadimos la condición del estado de pago

$query_pedido = $pdo->prepare($sql_pedido);
$query_pedido->bindParam(':nit_empresa', $sesion_nit_empresa, PDO::PARAM_STR);  // Evitamos inyecciones SQL
$query_pedido->execute();

$pedidos = $query_pedido->fetchAll(PDO::FETCH_ASSOC);


?>
