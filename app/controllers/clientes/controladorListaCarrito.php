<?php


if ($validar_sesion == true) {

    $sql = "SELECT cp.*, p.nom_producto, p.stock, p.precio_producto, fp.foto_1
    FROM carrito cp 
    INNER JOIN productos p ON cp.id_producto = p.id_producto 
    LEFT JOIN fotos_producto fp ON p.id_producto = fp.id_producto
    WHERE cp.id_cliente = :id_cliente";

    $query = $pdo->prepare($sql);
    $query->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $query->execute();

    // Obtener todos los productos en el carrito
    $productos_carrito = $query->fetchAll(PDO::FETCH_ASSOC);
    
} else {
    echo "<script type='text/javascript'>window.location.href = '" . $URL . "/clientes/login_cliente.php';</script>";
    exit();
}
