
<?php

include ('../../config.php');


session_start();

if(isset( $_SESSION['sesion email'])){

    session_destroy();
    header('Location: '.$URL.'/');
}
?>
