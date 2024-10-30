<?php
session_start();
if(isset( $_SESSION['sesion email'])){
      
    //echo "Si existe sesion de ". $_SESSION['sesion email'];
    $email_sesion = $_SESSION['sesion email'];
    $sql = "SELECT * from tb_admin WHERE correo = '$email_sesion' ";
    $query = $pdo->prepare($sql);
    $query->execute();

    $usuarios = $query->fetchALL(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario){
    $sesion_nombres=$usuario['nombres'];
    }

}else{

    echo "No existe sesion";
    header('Location: '.$URL.'/empresas/login');
}

?>