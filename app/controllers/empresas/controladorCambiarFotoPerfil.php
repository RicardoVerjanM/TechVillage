<?php

include('../../config.php');


if (isset($_POST['nit_empresa']) && isset($_FILES['foto_perfil'])) {
    $nit_empresa = $_POST['nit_empresa'];
    $foto_perfil = $_FILES['foto_perfil'];

    // Verificar si hubo un error en la carga del archivo
    if ($foto_perfil['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $foto_perfil['tmp_name'];
        $contenido = file_get_contents($tmp_name);

        // Preparar la consulta SQL para actualizar la foto de perfil
        $sentencia = $pdo->prepare("UPDATE empresa 
           SET foto_perfil = :foto_perfil
           WHERE nit_empresa = :nit_empresa");

        // Vincular los parámetros
        $sentencia->bindParam(':foto_perfil', $contenido, PDO::PARAM_LOB);
        $sentencia->bindParam(':nit_empresa', $nit_empresa);

        // Ejecutar la consulta
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se actualizó la foto de perfil correctamente";
            $_SESSION['icono'] = "success";
            header('Location: ' . $URL . '/empresas/perfil/index.php');
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al actualizar la información";
            $_SESSION['icono'] = "error";
            header('Location: ' . $URL . '/empresas/perfil/index.php');
        }
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al subir el archivo: " . $foto_perfil['error'];
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/empresas/perfil/index.php');
    }

    header('Location: ' . $URL . '/empresas/perfil/index.php');
    exit();
} else {
    session_start();
    $_SESSION['mensaje'] = "Datos incompletos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/empresas/perfil/index.php');
    exit();
}

?>
