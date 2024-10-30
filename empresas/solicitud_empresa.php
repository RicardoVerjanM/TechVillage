<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Solicitud empresa</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="../../www.TechVillage.com/public/css/style.css">

  <link rel="icon" href="../../www.TechVillage.com/public/images/logo_2.png" type="image/png">
  <!-- Libreria para las ventanas emergentes -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Eliminar flechitas en campos de tipo number */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Ajuste para hacer el formulario más grande */
    .register-box {
      width: 70%;
      /* Aumenta el tamaño del contenedor */
      max-width: 1000px;
      /* Ancho máximo */
      margin: auto;
    }
  </style>
</head>

<body class="hold-transition register-page ">
  <div class="register-box">
    <!-- /.login-logo -->

    <?php
    session_start();
    if ((isset($_SESSION['mensaje']) && (isset($_SESSION['icon'])))) {
      $respuesta = $_SESSION['mensaje'];
      $icono = $_SESSION['icon']; ?>

      <script>
        Swal.fire({
          position: "top-center",
          icon: "<?php echo $icono ?>",
          title: "<?php echo $respuesta ?>",
          showConfirmButton: false,
          timer: 2000
        });
      </script>

    <?php
      unset($_SESSION['mensaje']);
      unset($_SESSION['icon']);
    }
    ?>

    <div class="card card-outline card-success custom-card">
      <div class="card-header text-center">
        <a href="../public/templeates/AdminLTE-3.2.0/index2.html" class="h1"><b>Tech</b>village</a>
      </div>
      <div class="card-body">
        <h5 class="login-box-msg">Bienvenido a la solicitud de empresa.</h5>
        <h6 class="login-box-msg" style="color: red;">
          Por favor, antes de llenar el formulario,
          <a href="#" data-toggle="modal" data-target="#infoModal" style="color: red; text-decoration: underline;">de click aquí</a>
          para saber acerca de nuestro sistema.
        </h6>


        <form action="../app/controllers/solicitudes/controladorFormularioRegistro.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-6">
              <label for="nit">Ingrese el NIT de su empresa, por favor ingresar solo números:</label>
              <div class="input-group mb-3">
                <input type="number" id="nit" name="nit" class="form-control" placeholder="Ingrese el NIT de su empresa" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa-sharp fa-solid fa-city"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label for="nom_empresa">Ingrese el nombre de la empresa:</label>
              <div class="input-group mb-3">
                <input type="text" name="nom_empresa" class="form-control" placeholder="Ingrese el nombre de la empresa" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label for="nom_propietario">Ingrese el nombre del propietario de la empresa:</label>
              <div class="input-group mb-3">
                <input type="text" name="nom_propietario" class="form-control" placeholder="Ingrese el nombre del propietario/a" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label for="tel_contacto">Ingrese un número celular de contacto:</label>
              <div class="input-group mb-3">
                <input type="number" name="tel_contacto" id="tel_contacto" class="form-control" placeholder="Ingrese su número de contacto" required pattern="\d{10}">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa-duotone fa-solid fa-phone"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label for="correo">Ingrese su correo:</label>
              <div class="input-group mb-3">
                <input type="email" name="correo" class="form-control" placeholder="Ingrese su correo" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa-solid fa-envelope"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label for="direccion">Ingrese la dirección de la empresa:</label>
              <div class="input-group mb-3">
                <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese la dirección de la empresa" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa-solid fa-map-marker-alt"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label for="contraseña">Por favor agregue el pdf del Registro Unico Tributario RUT:</label>
              <div class="input-group mb-3">
                <input type="file" name="archivo_pdf" class="form-control" placeholder="RUT" accept=".pdf" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa-solid fa-file-pdf"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label for="contraseña">Ingrese una contraseña:</label>
              <div class="input-group mb-3">
                <input type="password" name="contraseña" class="form-control" placeholder="Contraseña" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa-duotone fa-solid fa-lock"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label for="confirmar_contraseña">Repita la contraseña:</label>
              <div class="input-group mb-3">
                <input type="password" name="confirmar_contraseña" class="form-control" placeholder="Repita la contraseña" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->

          <div class="row d-flex justify-content-center">
            <div class="col-6 col-md-3">
              <button type="submit" class="btn btn-success btn-sm btn-block">Registrar mi empresa</button>
            </div>
          </div><br>
          <div class="row d-flex justify-content-center">
            <div class="col-6 col-md-3">
              <a href="../index.php" class="btn btn-danger btn-sm btn-block">Cancelar</a>
            </div>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../public/templeates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../public/templeates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>

</html>




<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoModalLabel">Información importante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Este es el contenido del modal. Aquí puedes agregar cualquier información que desees mostrar cuando se haga clic en el enlace.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>