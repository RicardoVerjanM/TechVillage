<?php

session_start();
$validar_sesion = false;
if (isset($_SESSION['sesion email'])) {

    //echo "Si existe sesion de ". $_SESSION['sesion email'];
    $email_sesion = $_SESSION['sesion email'];
    $sql = "SELECT * from clientes WHERE correo = '$email_sesion' ";
    $query = $pdo->prepare($sql);
    $query->execute();

    $clientes = $query->fetchALL(PDO::FETCH_ASSOC);


    foreach ($clientes as $cliente) {
        $mensaje = 'Bienvenid@, ' . $sesion_nombres = $cliente['nombres'];
        $id_cliente = $cliente['cedula'];
        $validar_sesion = true;
    }

    $sql_count = "SELECT COUNT(*) AS total_productos FROM carrito WHERE id_cliente = :id_cliente";
    $query_count = $pdo->prepare($sql_count);
    $query_count->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $query_count->execute();
    $result_count = $query_count->fetch(PDO::FETCH_ASSOC);

    $total_productos = $result_count['total_productos'];

} else {

    $mensaje = '<a class="nav-link" href="clientes/login_cliente.php">Iniciar sesión</a>';
}
