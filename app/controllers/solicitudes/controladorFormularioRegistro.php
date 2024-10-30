<?php
include('../../config.php');

$nit = $_POST['nit'];
$nom_empresa = $_POST['nom_empresa'];
$nom_propietario = $_POST['nom_propietario'];
$correo = $_POST['correo'];
$tel_contacto = $_POST['tel_contacto'];
$contraseña = $_POST['contraseña'];
$direccion=$_POST['direccion'];
$confirmar_contraseña = $_POST['confirmar_contraseña'];

// Verificación si el correo ya está registrado
$sentenciaCorreo = $pdo->prepare("SELECT COUNT(*) FROM empresa WHERE correo = :correo");
$sentenciaCorreo->bindParam('correo', $correo);
$sentenciaCorreo->execute();
$cantidad = $sentenciaCorreo->fetchColumn();

$id_admin=1001045337;

if ($cantidad > 0) {
    session_start();
    $_SESSION['mensaje'] = "Error, el correo ya está registrado.";
    $_SESSION['icon'] = "error";
    header('Location: ' . $URL . '/empresas/solicitud_empresa.php');
    exit(); // Detener la ejecución si el correo ya existe
}

// Verificación de la contraseña
if ($contraseña == $confirmar_contraseña) {
    // Encriptar la contraseña
    $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);  

    // Validación y carga del archivo PDF
    if (isset($_FILES['archivo_pdf']) && $_FILES['archivo_pdf']['error'] == 0) {
        // Obtener la extensión del archivo y su tipo MIME
        $extension = strtolower(pathinfo($_FILES['archivo_pdf']['name'], PATHINFO_EXTENSION));
        $tipo_mime = mime_content_type($_FILES['archivo_pdf']['tmp_name']);

        // Verificar si el archivo es un PDF por la extensión y el tipo MIME
        if ($extension === 'pdf' && $tipo_mime === 'application/pdf') {
            // Definir la carpeta donde se guardará el archivo
            $directorio = '../../uploads/';
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true); // Crear la carpeta si no existe
            }

            // Crear el nuevo nombre del archivo basado en el NIT de la empresa
            $nombreArchivo = $nit . '_rut.pdf';
            $rutaArchivo = $directorio . $nombreArchivo;

            // Mover el archivo a la carpeta
            if (move_uploaded_file($_FILES['archivo_pdf']['tmp_name'], $rutaArchivo)) {
                // Guardar los datos de la empresa en la base de datos
                $sentencia = $pdo->prepare("INSERT INTO empresa
                    (nit_empresa, nom_empresa, nom_propietario, correo, tel_contacto, direccion, password_emp, rut, id_admin) 
                    VALUES (:nit_empresa, :nom_empresa, :nom_propietario, :correo, :tel_contacto, :direccion, :password_emp, :archivo_pdf, :id_admin)");

                $sentencia->bindParam('nit_empresa', $nit);
                $sentencia->bindParam('nom_empresa', $nom_empresa);
                $sentencia->bindParam('nom_propietario', $nom_propietario);
                $sentencia->bindParam('correo', $correo);
                $sentencia->bindParam('tel_contacto', $tel_contacto);
                $sentencia->bindParam('password_emp', $contraseña);
                $sentencia->bindParam('direccion', $direccion);
                $sentencia->bindParam('archivo_pdf', $rutaArchivo);
                $sentencia->bindParam('id_admin', $id_admin); // Guardar la ruta del archivo
                $sentencia->execute();

                // Guardar la solicitud
                $fechaHora = date("Y-m-d H:i:s");
                $sentenciaSolicitud = $pdo->prepare("INSERT INTO solicitud_empresa
                    (nit_empresa, fyh_solicitud) 
                    VALUES (:nit_empresa, :fyh_solicitud)");

                $sentenciaSolicitud->bindParam('nit_empresa', $nit);
                $sentenciaSolicitud->bindParam('fyh_solicitud', $fechaHora);
                $sentenciaSolicitud->execute();

                session_start();
                $_SESSION['mensaje'] = "¡Su solicitud fue enviada con éxito!";
                $_SESSION['icon'] = "success";
                header('Location: ' . $URL . '/empresas/solicitud_empresa.php');
            } else {
                session_start();
                $_SESSION['mensaje'] = "Error al subir el archivo PDF.";
                $_SESSION['icon'] = "error";
                header('Location: ' . $URL . '/empresas/solicitud_empresa.php');
            }
        } else {
            session_start();
            $_SESSION['mensaje'] = "Debe subir un archivo PDF válido.";
            $_SESSION['icon'] = "error";
            header('Location: ' . $URL . '/empresas/solicitud_empresa.php');
        }
    } else {
        session_start();
        $_SESSION['mensaje'] = "Debe subir un archivo PDF.";
        $_SESSION['icon'] = "error";
        header('Location: ' . $URL . '/empresas/solicitud_empresa.php');
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "Error, las contraseñas no son iguales.";
    $_SESSION['icon'] = "error";
    header('Location: ' . $URL . '/empresas/solicitud_empresa.php');
}
?>
