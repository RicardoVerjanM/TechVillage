<?php

include('../../config.php');

$email = $_POST['correo'];
$password_empresa = $_POST['password_empresa'];

$sql = "SELECT * FROM empresa WHERE correo = :correo";
$query = $pdo->prepare($sql);
$query->bindParam(':correo', $email, PDO::PARAM_STR);
$query->execute();

$empresa = $query->fetch(PDO::FETCH_ASSOC);

if ($empresa) {
    $email_tabla = $empresa['correo'];
    $nom_empresa_tabla = $empresa['nom_empresa'];
    $password_empresa_tabla = $empresa['password_emp'];
    $status_tabla = $empresa['status'];

    if (password_verify($password_empresa, $password_empresa_tabla)) {
        if ($status_tabla == 1) {
            //echo "Datos correctos"; 
            session_start();
            $_SESSION['sesion email'] = $email;
            header('Location: '.$URL.'/empresas/perfil/index.php');
            exit();
        } elseif (is_null($status_tabla)) {
            echo "Datos incorrectos, vuelva a intentar";
            session_start();
            $_SESSION['mensaje'] = "Error, tu solicitud no ha sido contestada.";
            $_SESSION['icon'] = "error";
            header('Location: '.$URL.'/empresas/login/index.php');
            exit();
        }
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error, contraseña incorrecta.";
        $_SESSION['icon'] = "error";
        header('Location: '.$URL.'/empresas/login/index.php');
        exit();
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "Error, su cuenta no existe, por favor envie una solicitud para unirse.";
    $_SESSION['icon'] = "question";
    header('Location: '.$URL.'/empresas/login/index.php');
}

?>
