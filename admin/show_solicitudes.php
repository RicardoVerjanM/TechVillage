<!-- Index del administrador -->


<?php
// Incluir los archivos necesarios
include('../app/config.php');
include('../layoutAdmin/sesion.php');
include('../layoutAdmin/parte1.php');
include('../app/controllers/solicitudes/controladorShowSolicitudes.php');


// Iniciar sesión solo si no está activa
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
    Swal.fire({
      position: 'top-center',
      icon: '<?php echo $icono; ?>',
      title: '<?php echo $respuesta; ?>',
      showConfirmButton: false,
      timer: 2000
    });
  </script>
<?php
  // Limpia los mensajes de la sesión
  unset($_SESSION['mensaje']);
  unset($_SESSION['icono']);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 ">
          <h1 class="m-0">Lista de solicitudes</h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Solicitudes</h3>

              <div class="card-tools">

              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
              <div class="card">
                <div class="card-header">


                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 300px;">
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table id="example1" class="table table-striped table-hover">
                    <thead>
                      <tr style="text-align: center">
                        <th>N° Solicitud</th>
                        <th>Nombre de la empresa</th>
                        <th>Correo</th>
                        <th>Telefono de contacto</th>
                        <th>Estado</th>
                        <th>Fecha de solicitud</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center">

                      <?php

                      foreach ($solicitudes as $solicitud) {
                        $id_solicitud = $solicitud['id_solicitud']; ?>
                        <tr>
                          <td><?php echo $solicitud['id_solicitud']; ?></td>
                          <td><?php echo $solicitud['nom_empresa']; ?></td>
                          <td><?php echo $solicitud['correo']; ?></td>
                          <td><?php echo $solicitud['tel_contacto']; ?></td>
                          <?php if (is_null($solicitud['estado'])) {
                            $solicitud['estado'] = "Aun sin responder";
                          } elseif ($solicitud['estado'] == 1) {
                            $solicitud['estado'] = "Aceptado";
                          } else {
                            $solicitud['estado'] = "Rechadaza";
                          } ?>
                          <td><?php echo $solicitud['estado']; ?></td>
                          <td><?php echo $solicitud['fyh_solicitud']; ?></td>
                          <td>
                            <center>

                              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAceptar<?php echo $id_solicitud; ?>">
                                Aceptar
                              </button>
                              
                              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalRechazar<?php echo $id_solicitud; ?>">
                                Rechazar
                              </button>

                            </center>
                          </td>
                        </tr>
                      <?php
                        include('../admin/modalAceptar.php');
                        include('../admin/modalRechazar.php');
                      }
                      ?>
                    </tbody>

                  </table>

                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>





    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->




<?php

include('../layoutAdmin/parte2.php');

?>
!-- Agrega el estilo para ajustar el selector --!
<style>
  .dataTables_length select {
      width: 80px !important; /* Ajusta el ancho para que las flechas no se solapen */
      padding-right: 20px !important; /* Aumenta el espacio a la derecha */
  }
</style>

<script>
  $(function () {
    $("#example1").DataTable({
      "pageLength": 10,
      language: {
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Empresas",
        "infoEmpty": "Mostrando 0 a 0 de 0 Empresas",
        "infoFiltered": "(Filtrado de _MAX_ total Empresas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Empresas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      },
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "columnDefs": [
        {
          // Deshabilitar ordenación y búsqueda en la columna de "Acciones"
          "targets": 6, // Índice de la columna de acciones
          "orderable": false,
          "searchable": false
        }
      ],
      buttons: [
        {
          extend: 'collection',
          text: 'Reportes',
          orientation: 'landscape',
          buttons: [
            { text: 'Copiar', extend: 'copy' },
            { extend: 'pdf' },
            { extend: 'csv' },
            { extend: 'excel' },
            { text: 'Imprimir', extend: 'print' }
          ]
        },
        {
          extend: 'colvis',
          text: 'Mostrar columnas'
        }
      ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
