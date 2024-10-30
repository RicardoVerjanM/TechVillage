<?php
$sql_pedido = "SELECT dp.*, p.*, productos.nom_producto, empresa.direccion 
               FROM detalle_pedido dp 
               JOIN pedidos p ON p.id_pedido = dp.id_pedido 
               JOIN productos ON dp.id_producto = productos.id_producto
               JOIN empresa ON empresa.nit_empresa = productos.id_empresa 
               WHERE p.id_cliente = :id_cliente";
$query_pedido = $pdo->prepare($sql_pedido);
$query_pedido->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
$query_pedido->execute();

$pedidos = $query_pedido->fetchAll(PDO::FETCH_ASSOC);





