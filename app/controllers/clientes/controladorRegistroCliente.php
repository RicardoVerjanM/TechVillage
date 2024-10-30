<?php
include('../../config.php');

// Recuperar datos del formulario
$nombres= $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$cedula = $_POST['cedula'];
$tel_contacto = $_POST['tel_contacto'];
$correo = $_POST['correo'];
$f_nacimiento = $_POST['fecha_nacimiento'];
$contraseña = $_POST['password'];
$confirmar_contraseña = $_POST['repeat_password'];




$sentenciaCedula = $pdo->prepare("SELECT COUNT(*) FROM clientes WHERE cedula = :cedula");
$sentenciaCedula->bindParam('cedula', $cedula);
$sentenciaCedula->execute();
$cantidadCedula = $sentenciaCedula->fetchColumn();

if ($cantidadCedula > 0) {
    session_start();
    $_SESSION['mensaje'] = "Error, ya existe una cuenta con ese numero de cedula.";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/clientes/login_cliente.php');
    exit(); // Detener la ejecución si el correo ya existe
}

$sentenciaCorreo = $pdo->prepare("SELECT COUNT(*) FROM clientes WHERE correo = :correo");
$sentenciaCorreo->bindParam('correo', $correo);
$sentenciaCorreo->execute();
$cantidad = $sentenciaCorreo->fetchColumn();

if ($cantidad > 0) {
    session_start();
    $_SESSION['mensaje'] = "Error, ya existe una cuenta con ese correo.";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/clientes/login_cliente.php');
    exit(); // Detener la ejecución si el correo ya existe
}

$fechaHora = date("Y-m-d H:i:s");

// Verificar si es mayor de edad
$fecha_actual = new DateTime(); // Fecha actual
$fecha_nacimiento = new DateTime($f_nacimiento); // Fecha de nacimiento del formulario
$edad = $fecha_actual->diff($fecha_nacimiento)->y; // Calcular diferencia de años

if ($edad < 18) {
    session_start();
    $_SESSION['mensaje'] = "Error: Debes ser mayor de edad para registrarte.";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/clientes/login_cliente.php');
    exit();
}

if ($contraseña == $confirmar_contraseña) {
    // Encriptar la contraseña
    $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
} else {
    session_start();
    $_SESSION['mensaje'] = "Error, las contraseñas no son iguales.";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/clientes/login_cliente.php');
    exit();
}

try {
    // Preparar la consulta SQL para insertar el cliente
    $sentencia = $pdo->prepare("INSERT INTO clientes
        (cedula, nombres, apellidos, correo, tel_contacto, fecha_nacimiento, password, fyh_creacion) 
        VALUES (:cedula, :nombres, :apellidos, :correo, :tel_contacto, :fecha_nacimiento, :password, :fyh_creacion)");

    // Vincular los parámetros con los valores correctos
    $sentencia->bindParam(':cedula', $cedula);
    $sentencia->bindParam(':nombres', $nombres);
    $sentencia->bindParam(':apellidos', $apellidos);
    $sentencia->bindParam(':correo', $correo);
    $sentencia->bindParam(':tel_contacto', $tel_contacto);
    $sentencia->bindParam(':fecha_nacimiento', $f_nacimiento);
    $sentencia->bindParam(':password', $contraseña);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);

    // Ejecutar la sentencia
    $sentencia->execute();

    session_start();
    $_SESSION['mensaje'] = "¡Cuenta creada! Ya puedes iniciar sesión";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/clientes/login_cliente.php');
    exit();

} catch (Exception $e) {
    session_start();
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/clientes/login_cliente.php');
    exit();
}
?>
