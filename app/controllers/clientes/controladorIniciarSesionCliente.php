<?php

include('../../config.php');

$email = $_POST['correo'];
$password_cliente = $_POST['password_cliente'];

$sql = "SELECT * FROM clientes WHERE correo = :correo";
$query = $pdo->prepare($sql);
$query->bindParam(':correo', $email, PDO::PARAM_STR);
$query->execute();

$cliente = $query->fetch(PDO::FETCH_ASSOC);

if ($cliente) {
    $email_tabla = $cliente['correo'];
    $nom_cliente_tabla = $cliente['nombres'];
    $password_cliente_tabla = $cliente['password'];


    if (password_verify($password_cliente, $password_cliente_tabla)) {

        //echo "Datos correctos"; 
        session_start();
        $_SESSION['sesion email'] = $email;
        header('Location: ' . $URL . '/index.php');
        exit();
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error, contraseña incorrecta.";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/clientes/login_cliente.php');
    }
} else {

    session_start();
    $_SESSION['mensaje'] = "Error, esa cuenta no existe.";
    $_SESSION['icono'] = "question";
    header('Location: ' . $URL . '/clientes/login_cliente.php');
}
