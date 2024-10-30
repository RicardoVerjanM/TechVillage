<?php

include('../app/config.php');



?>

<!-- Index para iniciar sesion como admin -->


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TechVillage</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <link rel="icon"  href="<?php echo $URL;?>/public/images/logo_2.png" type="image/png">

    <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/style.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Libreria para las ventanas emergentes -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->

        <?php

        session_start();
        if (isset($_SESSION['mensaje'])&&isset($_SESSION['icono'])) {

            $respuesta = $_SESSION['mensaje']; 
            $icon = $_SESSION['icono']; ?>

            <script>
                Swal.fire({
                    position: "top-center",
                    icon: "<?php echo $icon   ?>",
                    title: "<?php echo $respuesta   ?>",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        <?php
        }
        unset($_SESSION['mensaje']);
        unset($_SESSION['icon']);
        ?>
        <center>
            <img src="<?php echo $URL ?>/public/images/logo_1.jpeg" alt="Logo TechVillage" width="350px" style="border-radius: 20px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);">
        </center> <br>

        <div class="card card-outline card-success custom-card">

            <div class="card-body">
                <h5 class="login-box-msg">Iniciar sesion</h5>

                <form action="../app/controllers/clientes/controladorIniciarSesionCliente.php" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="correo" class="form-control" placeholder="Correo" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password_cliente" class="form-control" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>


                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-block">Ingresar</button>
                    </div>
                    <br>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary btn-block " data-bs-toggle="modal" data-bs-target="#modalCrear">
                            Crear cuenta
                        </button>
                    </div>
                    <br>
                    <div class="col-12">
                        <a href="../index.php" class="btn btn-danger btn-block">Cancelar</a>
                    </div>






                    <!-- /.col -->
            </div>
            </form>

            <!-- /.social-auth-links -->


        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>





</body>

</html>

<!-- Modal -->
<div class="modal fade" id="modalCrear" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: blue;">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:white;">Crear cuenta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../app/controllers/clientes/controladorRegistroCliente.php" method="post">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ingrese sus nombres:</label>
                                    <input type="text" name="nombres" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ingrese sus apellidos:</label>
                                    <input type="text" name="apellidos" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ingrese su número de cédula:</label>
                                    <input type="number" name="cedula" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ingrese su número de celular:</label>
                                    <input type="number" name="tel_contacto" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Correo:</label>
                                    <input type="email" name="correo" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha de nacimiento:</label>
                                    <input type="date" name="fecha_nacimiento" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contraseña:</label>
                                    <input type="text" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Repita contraseña:</label>
                                    <input type="text" name="repeat_password" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">¡Crear cuenta!</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
