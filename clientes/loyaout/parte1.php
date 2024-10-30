<?php include('app/config.php');
include('app/controllers/clientes/sesionClientes.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TechVillage</title>
  <!-- AdminLTE CSS -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="icon" href="<?php echo $URL; ?>/public/images/logo_2.png" type="image/png">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo $URL; ?>/public/css/style.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>




  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Libreria para las ventanas emergentes -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="path_to_adminlte_css/adminlte.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .navbar select {

      /* Fondo transparente */
      border: none;
      /* Sin borde */

      /* Color del texto */
      padding: 0;
      /* Sin padding */
      font-size: 1rem;
      /* Tamaño de fuente similar a los links */
      line-height: inherit;
      /* Mantén la misma altura de línea */
      cursor: pointer;
      /* Cursor tipo mano para hacer clic */
      text-decoration: none;
      /* Sin subrayado */
    }

    .navbar select option {
      color: black;
      /* Color de las opciones dentro del select */
    }

    .navbar select:focus {
      outline: none;
      /* Quita el borde de enfoque */
    }

    .navbar select option:disabled {
      color: gray;
      /* Opción deshabilitada en gris */
    }

    a {
      text-decoration: none;
      /* Quita el subrayado */
      color: inherit;
      /* Hereda el color del elemento padre */
    }

    a:hover {
      text-decoration: none;
      /* Mantiene el enlace sin subrayado al pasar el mouse */
      color: inherit;
      /* Mantiene el mismo color al pasar el mouse */
    }

    .navbar-custom {
      background-color: #0000;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      /* Distribuye espacio entre izquierda y centro */
      align-items: center;
      width: 100%;
    }

    .navbar-center {
      flex-grow: 1;
      display: flex;
      justify-content: center;
      /* Centra las opciones del menú */
    }

    /* Header style */
    header {
      text-align: center;
      padding: 20px 0;
      background-color: #0000;
      font-size: 5rem;
      color: #012b28;
      font-weight: bold;
    }
  </style>
</head>


<body class="hold-transition sidebar-mini layout-navbar-fixed">

  <!-- Header -->
  <header>
    <a href="../www.TechVillage.com/">
      TechVillage
      <h3>Lo mejor de tu región, al alcance de un clic.</h3>
    </a>
  </header>

  <div class="row">
    <div class="col-md-8 offset-md-2">
      <form action="buscar_nom.php" method="GET" class="d-flex justify-content-center">
        <div class="input-group input-group-lg">
          <input type="text" name="nombre_producto" class="form-control form-control-lg" placeholder="Buscar">
          <button type="submit" class="btn btn-default">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </form>
    </div>
  </div>




  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom navbar-light">
    <div class="container-fluid">
      <i class="fas fa-user"></i>
      <div class="navbar-text me-auto nav-item d-none d-sm-inline-block">
        <?php echo $mensaje; ?>
      </div>

      <!-- Botón para menú responsive -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Center navbar links -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item d-none d-sm-inline-block">
            <a href="../www.TechVillage.com/" class="nav-link">Inicio</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <select name="categoria" id="categoria" class="form-control" onchange="redirigir()">
              <option value="" selected disabled>Categorías</option>
              <option value="1">Ropa</option>
              <option value="2">Calzado</option>
              <option value="3">Tecnología</option>
              <option value="4">Deportivo</option>
              <option value="5">Hogar y muebles</option>
              <option value="6">Herramienta</option>
              <option value="7">Estética y Belleza</option>
              <option value="8">Juguetes</option>
              <option value="9">Salud y bienestar</option>
              <option value="10">Libros y papelería</option>
              <option value="11">Mascotas</option>
              <option value="12">Accesorios</option>
            </select>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="empresas/login/" class="nav-link plain-link">Empresa</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="admin/login_Admin.php" class="nav-link plain-link">Administrador</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="mi_carrito.php" class="nav-link plain-link">
              <i class="fa-solid fa-cart-shopping"></i> Mi carrito <?php if (isset($_SESSION['sesion email'])) {
                                                                      echo '(' . $total_productos . ')';
                                                                    } else {
                                                                      echo '(0)';
                                                                    } ?>
            </a>
          </li>
          <?php if (isset($_SESSION['sesion email'])) {
            echo '<li class="nav-item d-none d-sm-inline-block">
            <a href="mis_pedidos.php" class="nav-link plain-link">
               Mis pedidos
            </a>
          </li>';
          } ?>

        </ul>

        <?php if (isset($_SESSION['sesion email'])) {
          echo '<div  class="navbar-text">
      <a style="color:white;" href="app/controllers/clientes/controladorCerrarSesionCliente.php"  class="btn btn-danger">Cerrar Sesión</a>
      </div>';
        } ?>
      </div>
    </div>
  </nav>


  <!-- Redirigir función -->

  <!-- /.navbar -->
  </div>

  <!-- AdminLTE and Bootstrap Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <script src="path_to_adminlte_js/adminlte.min.js"></script>

 


  <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <script>
    function redirigir() {
      // Obtener el valor de la categoría seleccionada
      var categoria = document.getElementById('categoria').value;

      // Verificar si se seleccionó una categoría válida
      if (categoria) {
        // Redirigir a la vista específica de productos de la categoría seleccionada
        window.location.href = "buscar_categoria.php?categoria=" + categoria;
      }
    }
  </script>
</body>

</html>



<!-- SweetAlert2 JS -->