
<?php

include ('../app/config.php');



?>

<!-- Index para iniciar sesion como admin -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TechVillage</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="<?php echo $URL;?>/public/css/style.css">
  <!-- Libreria para las ventanas emergentes -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition login-page" >
<div class="login-box">
  <!-- /.login-logo -->

  <?php
  
  session_start();
  if(isset($_SESSION['mensaje'])){
    
      $respuesta=$_SESSION['mensaje'];?>
  
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
  }
  unset($_SESSION['mensaje']);
  unset($_SESSION['icon']);
  ?>
  <center>
    <img src="<?php echo $URL?>/public/images/logo_1.jpeg" alt="Logo TechVillage" width="350px" style="border-radius: 20px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);">
</center> <br>

  <div class="card card-outline card-success custom-card">
  
    <div class="card-body">
      <h5 class="login-box-msg">Iniciar sesion como Administrador</h5>

      <form action="../app/controllers/LoginAdmin/controladorIngresoAdmin.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Correo" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password_user" class="form-control" placeholder="Contraseña" required>
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
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>
</html>






