<?php
include('../../config.php');

// Recibir los datos del formulario
$id_cliente = $_POST['id_cliente'];
$productos = $_POST['productos']; // Array con los ids de los productos
$cantidades = $_POST['cantidad']; // Array con las cantidades de cada producto
$total_pagar = $_POST['total_pedido']; // Recibir el total desde la vista

// Verificar que la cantidad de productos y cantidades sea la misma
if (count($productos) !== count($cantidades)) {
    session_start();
    $_SESSION['mensaje'] = "Error: La cantidad de productos y cantidades no coinciden.";
    $_SESSION['icon'] = "error";
    header('Location: ' . $URL . '/mi_carrito.php');
    exit();
}

// Manejar la imagen del comprobante de pago
$comprobante = $_FILES['comprobante'];
$comprobante_tmp = $comprobante['tmp_name'];

// Verificar si la imagen ha sido subida
if ($comprobante_tmp) {
    // Validar que el archivo sea una imagen
    $image_info = getimagesize($comprobante_tmp);

    if ($image_info === false) {
        session_start();
        $_SESSION['mensaje'] = "Error, el archivo subido no es una imagen válida.";
        $_SESSION['icon'] = "error";
        header('Location: ' . $URL . '/mi_carrito.php');
        exit();
    }

    // Convertir la imagen a un formato para guardarla en la base de datos
    $comprobante_blob = file_get_contents($comprobante_tmp);
} else {
    session_start();
    $_SESSION['mensaje'] = "Error, debes subir un comprobante.";
    $_SESSION['icon'] = "error";
    header('Location: ' . $URL . '/mi_carrito.php');
    exit();
}

$fechaCreacion = $fechaHora;

try {
    // Iniciar la transacción
    $pdo->beginTransaction();

    // Insertar el pedido
    $sql = "INSERT INTO pedidos (id_cliente, precio_total, comprobante_pago, estado_pago, fecha_creacion) 
            VALUES (:id_cliente, :precio_total, :comprobante_de_pago, NULL, :fecha_creacion)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $query->bindParam(':precio_total', $total_pagar, PDO::PARAM_STR); // Usa el total recibido desde la vista
    $query->bindParam(':comprobante_de_pago', $comprobante_blob, PDO::PARAM_LOB);
    $query->bindParam(':fecha_creacion', $fechaCreacion, PDO::PARAM_STR);

    // Ejecutar la consulta del pedido
    if ($query->execute()) {
        // Obtener el último ID de pedido insertado
        $id_pedido = $pdo->lastInsertId();

        // Insertar cada producto en la tabla detalle_pedido
        foreach ($productos as $id_producto) {
            // Asegúrate de que la cantidad existe para este ID de producto
            if (isset($cantidades[$id_producto])) {
                $cantidad = intval($cantidades[$id_producto]); // Obtén la cantidad usando el ID del producto

                // Consulta para obtener el stock disponible
                $sql_consulta = "SELECT stock FROM productos WHERE id_producto = :id_producto";
                $query_consulta = $pdo->prepare($sql_consulta);
                $query_consulta->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $query_consulta->execute();
                $stock_resultado = $query_consulta->fetch(PDO::FETCH_ASSOC);

                // Verificar si hay stock suficiente
                if ($stock_resultado && $stock_resultado['stock'] < $cantidad) {
                    throw new Exception("No hay suficiente stock para el producto con ID $id_producto");
                }

                // Insertar en detalle_pedido
                $sql_detalle = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, estado_producto) 
                                VALUES (:id_pedido, :id_producto, :cantidad, NULL)";
                $query_detalle = $pdo->prepare($sql_detalle);
                $query_detalle->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
                $query_detalle->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $query_detalle->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
                $query_detalle->execute();

                // Actualizar el stock del producto
                $sql_stock = "UPDATE productos SET stock = stock - :cantidad WHERE id_producto = :id_producto";
                $query_stock = $pdo->prepare($sql_stock);
                $query_stock->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
                $query_stock->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $query_stock->execute();

                $sql_carrito = "DELETE FROM carrito where id_cliente = :id_cliente";
                $query_carrito = $pdo->prepare($sql_carrito);
                $query_carrito->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
                $query_carrito->execute();

            } else {
                throw new Exception("No se encontró cantidad para el ID del producto: $id_producto");
            }
        }

        // Si todo está bien, hacer commit
        $pdo->commit();

        // Redirigir con mensaje de éxito
        session_start();
        $_SESSION['mensaje'] = "¡Pedido registrado exitosamente!";
        $_SESSION['icon'] = "success";
        header('Location: ' . $URL . '/mi_carrito.php');
        exit();
    } else {
        throw new Exception("Error al registrar el pedido");
    }
} catch (Exception $e) {
    // Si ocurre un error, hacer rollback y mostrar mensaje
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['icon'] = "error";
    header('Location: ' . $URL . '/mi_carrito.php');
    exit();
}
