<?php
include('../../config.php');

$id_cliente = $_POST['id_cliente'];
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];
$total_pagar = $_POST['total'];

// Manejar la imagen del comprobante de pago
$comprobante = $_FILES['comprobante'];
$comprobante_tmp = $comprobante['tmp_name'];

// Verificar si la imagen ha sido subida
if ($comprobante_tmp) {
    // Validar que el archivo sea una imagen
    $image_info = getimagesize($comprobante_tmp);
    
    if ($image_info === false) {
        // Si no es una imagen, redirigir con mensaje de error
        session_start();
        $_SESSION['mensaje'] = "Error, el archivo subido no es una imagen válida.";
        $_SESSION['icon'] = "error";
        header('Location: ' . $URL . '/realizar_pedido.php?id_producto=' . $id_producto);
        exit();
    }

    // Convertir la imagen a un formato para guardarla en la base de datos
    $comprobante_blob = file_get_contents($comprobante_tmp);
} else {
    // Mensaje si no se subió la imagen
    session_start();
    $_SESSION['mensaje'] = "Error, debes subir un comprobante.";
    $_SESSION['icon'] = "error";
    header('Location: ' . $URL . '/realizar_pedido.php?id_producto=' . $id_producto);
    exit();
}

// Consulta para obtener el stock disponible
$sql_consulta = "SELECT stock FROM productos WHERE id_producto = :id_producto";
$query_consulta = $pdo->prepare($sql_consulta);
$query_consulta->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);

// Ejecutar la consulta
$query_consulta->execute();
$stock_resultado = $query_consulta->fetch(PDO::FETCH_ASSOC);

// Verificar si hay stock suficiente
if ($stock_resultado && $stock_resultado['stock'] < $cantidad) {
    session_start();
    $_SESSION['mensaje'] = "Error, no hay unidades suficientes para tu pedido.";
    $_SESSION['icon'] = "error";
    header('Location: ' . $URL . '/realizar_pedido.php?id_producto=' . $id_producto);
    exit();
}

$fechaCreacion = $fechaHora;

// Insertar el pedido
$sql = "INSERT INTO pedidos (id_cliente, precio_total, comprobante_pago, estado_pago, fecha_creacion) 
        VALUES (:id_cliente, :precio_total, :comprobante_de_pago, NULL, :fecha_creacion)";

$query = $pdo->prepare($sql);
$query->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
$query->bindParam(':precio_total', $total_pagar, PDO::PARAM_STR);
$query->bindParam(':comprobante_de_pago', $comprobante_blob, PDO::PARAM_LOB);
$query->bindParam(':fecha_creacion', $fechaCreacion, PDO::PARAM_STR);

// Ejecutar la consulta del pedido
if ($query->execute()) {
    // Obtener el último ID de pedido insertado
    $id_pedido = $pdo->lastInsertId();

    // Insertar en detalle_pedido
    $sql_detalle = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, estado_producto) 
                    VALUES (:id_pedido, :id_producto, :cantidad, NULL)";

    $query_detalle = $pdo->prepare($sql_detalle);
    $query_detalle->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
    $query_detalle->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
    $query_detalle->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);

    // Ejecutar la consulta del detalle
    if ($query_detalle->execute()) {
        // Actualizar el stock del producto
        $sql_stock = "UPDATE productos SET stock = stock - :cantidad WHERE id_producto = :id_producto";

        $query_stock = $pdo->prepare($sql_stock);
        $query_stock->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $query_stock->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);

        if ($query_stock->execute()) {
            session_start();
            $_SESSION['mensaje'] = "¡Pedido registrado!";
            $_SESSION['icon'] = "success";
            header('Location: ' . $URL . '/detalle_producto.php?id=' . $id_producto);
            exit();
        } else {
            // Si hay un error al actualizar el stock
            session_start();
            $_SESSION['mensaje'] = "¡Pedido registrado, pero error al actualizar el stock!";
            $_SESSION['icon'] = "warning"; // Usar un ícono diferente para advertencia
            header('Location: ' . $URL . '/detalle_producto.php?id=' . $id_producto);
            exit();
        }
    } else {
        // Si hay un error en la inserción del detalle
        session_start();
        $_SESSION['mensaje'] = "Error al registrar el detalle del pedido";
        $_SESSION['icon'] = "error";
        header('Location: ' . $URL . '/detalle_producto.php?id=' . $id_producto);
        exit();
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al registrar el pedido";
    $_SESSION['icon'] = "error";
    header('Location: ' . $URL . '/detalle_producto.php?id=' . $id_producto);
    exit();
}
