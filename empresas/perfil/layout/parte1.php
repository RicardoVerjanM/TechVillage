<?php
include ('../../app/config.php');
include ('../../app/controllers/empresas/sesionEmpresa.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si hay un mensaje en la sesión
if (isset($_SESSION['mensaje']) && isset($_SESSION['icono'])) {
    $respuesta = $_SESSION['mensaje'];
    $icono = $_SESSION['icono'];
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: 'top-center',
                icon: '<?php echo $icono; ?>',
                title: '<?php echo $respuesta; ?>',
                showConfirmButton: false,
                timer: 5000
            });
        });
    </script>
    <?php
    // Limpia los mensajes de la sesión
    unset($_SESSION['mensaje']);
    unset($_SESSION['icono']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon"  href="<?php echo $URL;?>/public/images/logo_2.png" type="image/png">
    <title><?php echo htmlspecialchars($sesion_nom_empresa); ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style (AdminLTE) -->
    <link rel="stylesheet" href="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUa6f5CfrhnbL86L2kxAUa0qEp+jlwp9htg1h+0I1+XHne9geYy3a2D+zN5" crossorigin="anonymous">


  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    
    <aside class="main-sidebar elevation-3" style="background: #012B28; border-radius:20px">
        <!-- Page header -->
        <div class="row mb-2">
            <div class="col-sm-12 text-center">
                <h1 style="color: white;">Bienvenido <?php echo htmlspecialchars($sesion_nom_propietario); ?></h1>
            </div>
        </div>
        
        <div class="col-md-12">
            <!-- Profile Image Card -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="data:image/jpg;base64,<?php echo base64_encode($sesion_foto_perfil); ?>"
                            alt="Agregue una foto de perfil">
                    </div>

                    <h3 class="profile-username text-center"><?php echo htmlspecialchars($sesion_empresa); ?></h3>

                    <!-- Formulario para subir nueva imagen -->
                    <form action="../../app/controllers/empresas/controladorCambiarFotoPerfil.php" method="post" enctype="multipart/form-data" class="text-center">
                        <input type="hidden" name="nit_empresa" value="<?php echo htmlspecialchars($sesion_nit_empresa); ?>">
                        <label for="profileImage" class="form-label">Actualizar Foto de Perfil</label>
                        <input type="file" name="foto_perfil" class="form-control mb-3">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
            
            <!-- Mis Datos Card -->
            <div class="card card-primary mt-4">
                <div class="card-header">
                    <h3 class="card-title">Mis datos</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-envelope mr-1"></i> Mi correo</strong>
                    <p class="text-muted"><?php echo htmlspecialchars($sesion_correo); ?></p>
                    <hr>
                    <strong><i class="fas fa-phone mr-1"></i> Mi número</strong>
                    <p class="text-muted"><?php echo htmlspecialchars($sesion_numero); ?></p>
                    <hr>
                    <a href="../../app/controllers/empresas/cerrarSesionEmpresa.php" class="btn btn-danger btn-block"><b>Cerrar sesión</b></a>
                </div>
            </div>
        </div>
    </aside>

