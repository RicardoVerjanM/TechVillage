<?php

session_start();
if(isset( $_SESSION['sesion email'])){
      
    $email_sesion = $_SESSION['sesion email'];
    $sql = "SELECT * from empresa WHERE correo = '$email_sesion' and status=1 ";
    $query = $pdo->prepare($sql);
    $query->execute();

    $empresas = $query->fetchALL(PDO::FETCH_ASSOC);

    foreach ($empresas as $empresa){
    $sesion_nit_empresa=$empresa['nit_empresa'];
    $sesion_nom_empresa=$empresa['nom_empresa'];
    $sesion_nom_propietario=$empresa['nom_propietario'];  
    $sesion_correo=$empresa['correo'];   
    $sesion_numero=$empresa['tel_contacto']; 
    $sesion_empresa=$empresa['nom_empresa'];
    $sesion_foto_perfil = $empresa['foto_perfil']; 
    }

}else{

    echo "No existe sesion";
    header('Location: '.$URL.'/empresas/login');
}

?>