<?php
include('../../config.php');

// Depurar datos de archivos
echo "<pre>";
print_r($_FILES);
echo "</pre>";

// Recuperar datos del formulario
$id_producto = $_POST['id_producto'];
$nom_producto = $_POST['nom_producto'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];
$stock = $_POST['stock'];
$descripcion = $_POST['descripcion'];

// Validaciones
if($precio < 100) {
    session_start();
    $_SESSION['mensaje'] = "¡El precio del producto no puede ser menor a cien pesos!";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/empresas/perfil/agregar_producto.php');
    exit();
} elseif($stock <= 0) {
    session_start();
    $_SESSION['mensaje'] = "¡El stock tiene que ser mayor a cero!";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/empresas/perfil/agregar_producto.php');
    exit();
}

session_start(); // Mover session_start aquí

try {
    // Preparar la consulta SQL para actualizar el producto
    $sentencia = $pdo->prepare("UPDATE productos SET nom_producto=:nom_producto, precio_producto=:precio_producto, id_categoria=:id_categoria, stock=:stock, descripcion=:descripcion WHERE id_producto=:id_producto");

    // Vincular los parámetros con los valores
    $sentencia->bindParam(':id_producto', $id_producto);
    $sentencia->bindParam(':nom_producto', $nom_producto);
    $sentencia->bindParam(':precio_producto', $precio);
    $sentencia->bindParam(':id_categoria', $categoria);
    $sentencia->bindParam(':stock', $stock);
    $sentencia->bindParam(':descripcion', $descripcion);

    // Ejecutar la consulta para actualizar el producto
    if ($sentencia->execute()) {

        // Inicializar el array de fotos
        $fotos = array_fill(0, 5, null); // Rellenar un array con 5 elementos nulos

        // Verificar si se recibieron fotos
        if (isset($_FILES['fotos']['tmp_name'])) {
            foreach ($_FILES['fotos']['tmp_name'] as $index => $tmpName) {
                if ($_FILES['fotos']['error'][$index] === UPLOAD_ERR_OK) {
                    $fotos[$index] = file_get_contents($tmpName);
                }
            }

            // Preparar la consulta SQL para actualizar las fotos
            $sentenciaFoto = $pdo->prepare("UPDATE fotos_producto SET foto_1=:foto_1, foto_2=:foto_2, foto_3=:foto_3, foto_4=:foto_4, foto_5=:foto_5 WHERE id_producto=:id_producto");

            // Vincular los parámetros con los valores
            $sentenciaFoto->bindParam(':id_producto', $id_producto);
            $sentenciaFoto->bindParam(':foto_1', $fotos[0], PDO::PARAM_LOB);
            $sentenciaFoto->bindParam(':foto_2', $fotos[1], PDO::PARAM_LOB);
            $sentenciaFoto->bindParam(':foto_3', $fotos[2], PDO::PARAM_LOB);
            $sentenciaFoto->bindParam(':foto_4', $fotos[3], PDO::PARAM_LOB);
            $sentenciaFoto->bindParam(':foto_5', $fotos[4], PDO::PARAM_LOB);

            // Ejecutar la consulta para actualizar las fotos
            if ($sentenciaFoto->execute()) {
                $_SESSION['mensaje'] = "¡El producto y las fotos se actualizaron con éxito!";
                $_SESSION['icono'] = "success";
                header('Location: ' . $URL . '/empresas/perfil/index.php');
                exit();
            } else {
                $errorInfo = $sentenciaFoto->errorInfo();
                throw new Exception("Error al agregar las fotos a la base de datos: " . $errorInfo[2]);
            }
        } else {
            // Si no se recibieron fotos, continuar con el proceso
            $_SESSION['mensaje'] = "¡El producto se actualizó con éxito, pero no se subieron nuevas fotos!";
            $_SESSION['icono'] = "success";
            header('Location: ' . $URL . '/empresas/perfil/index.php');
            exit();
        }
    } else {
        $errorInfo = $sentencia->errorInfo();
        throw new Exception("Error al actualizar el producto: " . $errorInfo[2]);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
