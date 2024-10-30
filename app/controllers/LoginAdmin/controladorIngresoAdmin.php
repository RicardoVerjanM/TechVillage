<?php

include('../../config.php');


$email = $_POST['email'];
$password_user = $_POST['password_user'];

$sql = "SELECT * FROM tb_admin WHERE correo= '$email' ";
$query = $pdo->prepare($sql);
$query->execute();

$usuarios = $query->fetchALL(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario){
    $email_tabla=$usuario['correo'];
    $nombres=$usuario['nombres'];
    $password_user_tabla=$usuario['password_admin'];
}


if($email_tabla == $email && password_verify($password_user, $password_user_tabla)){
    echo "Datos correctos"; 
    session_start();
    $_SESSION['sesion email'] = $email;
    header('Location: '.$URL.'/admin/indexAdmin.php');

}else{
    

    echo "Datos incorrectos, vuelva a intentar";
    session_start();
    $_SESSION['mensaje']="Error, datos incorrectos";

    header('Location: '.$URL.'/admin/login_Admin.php');
}







?>