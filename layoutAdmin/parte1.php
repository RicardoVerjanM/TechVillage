<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon"  href="<?php echo $URL;?>/public/images/logo_2.png" type="image/png">
  <title>TechVillage</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="<?php echo $URL;?>/public/css/style.css">

  <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Libreria para las ventanas emergentes -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #012B28;"> 
    <!-- Brand Logo -->
    <a href="<?php echo $URL;?>/admin/indexAdmin.php" class="brand-link text-decoration-none">
    <img src="<?php echo $URL;?>\public\images\logo_1.jpeg" alt="TecVillage Logo" class="profile-user-img img-fluid img-circle" style="width: 75px; height: 75px; object-fit: cover; ">
      <span class="brand-text font-weight-light">TechVillage</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block text-decoration-none"><?php echo $sesion_nombres ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Solicitudes de empresa
                
              </p>
            </a>
            <ul class="nav nav-treeview" >
              <li class="nav-item">
                <a href="<?php echo $URL;?>/admin/show_solicitudes.php" class="nav-link">
                <i class="fa-solid fa-hand-point-up"></i>
                  <p>Solicitudes pendientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $URL;?>/admin/show_empresasActivas.php" class="nav-link ">
                <i class="fa-solid fa-building"></i>
                  <p>Empresas activas</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link active">
            <i class="fas fa-shopping-cart"></i>
              <p>
                Pedidos
                
              </p>
            </a>
            <ul class="nav nav-treeview" >
              <li class="nav-item">
                <a href="<?php echo $URL;?>/admin/show_pedidos_pendientes.php" class="nav-link">
                <i class="fa-solid fa-eye"></i>
                  <p>Pedidos pendientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $URL;?>/admin/show_lista_pedidos.php" class="nav-link ">
                <i class="fa-solid fa-list"></i>
                  <p>Listado de pedidos</p>
                </a>
              </li>
            </ul>
          </li>

          
          <li class="nav-item">
            <a href="<?php echo $URL;?>/app/controllers/LoginAdmin/controladorCerrarSesionAdmin.php" class="nav-link" style="background-color:#d93d3d">
              <i class="nav-icon fas fa-door-closed"></i>
              <p>
                Cerrar Sesion
                
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>




