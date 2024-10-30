<?php
include('../../config.php');

// Depurar datos de archivos
echo "<pre>";
print_r($_FILES);
echo "</pre>";

// Recuperar datos del formulario
$nit_empresa = $_POST['nit_empresa'];
$nom_producto = $_POST['nom_producto'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];
$stock = $_POST['stock'];
$descripcion = $_POST['descripcion'];
if($precio<100){
    session_start();
                $_SESSION['mensaje'] = "¡El precio del producto no puede ser menor a cien pesos!";
                $_SESSION['icono'] = "error";
                header('Location: ' . $URL . '/empresas/perfil/agregar_producto.php');
                exit();

}elseif($stock<=0){
    session_start();
                $_SESSION['mensaje'] = "¡El stock tiene que ser mayor a cero!";
                $_SESSION['icono'] = "error";
                header('Location: ' . $URL . '/empresas/perfil/agregar_producto.php');
                exit();

}


try {
    // Preparar la consulta SQL para insertar el producto
    $sentencia = $pdo->prepare("INSERT INTO productos
        (id_empresa, nom_producto, precio_producto, id_categoria, stock, descripcion) 
        VALUES (:id_empresa, :nom_producto, :precio_producto, :id_categoria, :stock, :descripcion)");

    // Vincular los parámetros con los valores
    $sentencia->bindParam(':id_empresa', $nit_empresa);
    $sentencia->bindParam(':nom_producto', $nom_producto);
    $sentencia->bindParam(':precio_producto', $precio);
    $sentencia->bindParam(':id_categoria', $categoria);
    $sentencia->bindParam(':stock', $stock);
    $sentencia->bindParam(':descripcion', $descripcion);

    // Ejecutar la consulta para insertar el producto
    if ($sentencia->execute()) {
        $id_producto = $pdo->lastInsertId(); // Obtener el ID del producto recién insertado

        // Inicializar el array de fotos
        $fotos = array_fill(0, 5, null); // Rellenar un array con 5 elementos nulos

        // Verificar si se recibieron fotos
        if (isset($_FILES['fotos']['tmp_name'])) {
            foreach ($_FILES['fotos']['tmp_name'] as $index => $tmpName) {
                if ($_FILES['fotos']['error'][$index] === UPLOAD_ERR_OK) {
                    $fotos[$index] = file_get_contents($tmpName);
                }
            }

            // Preparar la consulta SQL para insertar las fotos
            $sentenciaFoto = $pdo->prepare("INSERT INTO fotos_producto (id_producto, foto_1, foto_2, foto_3, foto_4, foto_5) 
                VALUES (:id_producto, :foto_1, :foto_2, :foto_3, :foto_4, :foto_5)");

            // Vincular los parámetros con los valores
            $sentenciaFoto->bindParam(':id_producto', $id_producto);
            $sentenciaFoto->bindParam(':foto_1', $fotos[0], PDO::PARAM_LOB);
            $sentenciaFoto->bindParam(':foto_2', $fotos[1], PDO::PARAM_LOB);
            $sentenciaFoto->bindParam(':foto_3', $fotos[2], PDO::PARAM_LOB);
            $sentenciaFoto->bindParam(':foto_4', $fotos[3], PDO::PARAM_LOB);
            $sentenciaFoto->bindParam(':foto_5', $fotos[4], PDO::PARAM_LOB);

            // Ejecutar la consulta para insertar las fotos
            if ($sentenciaFoto->execute()) {
                session_start();
                $_SESSION['mensaje'] = "¡El producto y las fotos fueron agregados con éxito!";
                $_SESSION['icono'] = "success";
                header('Location: ' . $URL . '/empresas/perfil/index.php');
                exit();
            } else {
                $errorInfo = $sentenciaFoto->errorInfo();
                throw new Exception("Error al agregar las fotos a la base de datos: " . $errorInfo[2]);
            }
        } else {
            throw new Exception("No se recibieron archivos de fotos.");
        }
    } else {
        $errorInfo = $sentencia->errorInfo();
        throw new Exception("Error al agregar el producto: " . $errorInfo[2]);
    }
} catch (Exception $e) {
    session_start();
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/empresas/perfil/index.php');
    exit();
}
?>
