
<?php

define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWORD','');
define('BD','basetech');


$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try {
    
    $pdo=new PDO ($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
   // echo "conexión exitosa";

} catch (PDOException $e) {
    
    echo "Error al conectar a la base de datos"; 

}

$URL = "http://localhost/www.TechVillage.com";



date_default_timezone_set("America/Bogota");

$fechaHora=date('Y-m-d H:i:s');

if(isset($_SESSION['mensaje'])){

    $respuesta=$_SESSION['mensaje']; ?>
    
    <script>
      Swal.fire({
      position: "top-center",
      icon: "error",
      title: "<?php echo $respuesta   ?>",
      showConfirmButton: false,
      timer: 2000
      });
    </script>
    
    
    
    <?php
    unset($_SESSION['mensaje']);
    }






?>



