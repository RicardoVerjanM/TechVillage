<!-- Index del administrador -->

<?php
// Incluir los archivos necesarios
include ('../app/config.php');
include ('../layoutAdmin/sesion.php');
include ('../layoutAdmin/parte1.php');
include ('../app/controllers/solicitudes/controladorShowEmpresasActivas.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 ">
                    <h1 class="m-0">Lista de empresas activas</h1>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Empresas</h3>

                            <div class="card-tools"></div>
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
                                                <th>Nombre de la empresa</th>
                                                <th>Correo</th>
                                                <th>Telefono de contacto</th>
                                                <th>Fecha de aceptacion</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align:center">
                                            <?php 
                                            foreach($solicitudes as $solicitud){
                                            $id_solicitud= $solicitud['id_solicitud']; ?>
                                            <tr> 
                                                <td><?php echo $solicitud['nom_empresa'];?></td>
                                                <td><?php echo $solicitud['correo'];?></td>
                                                <td><?php echo $solicitud['tel_contacto'];?></td>
                                                <td><?php echo $solicitud['fyh_union'];?></td>
                                            </tr>
                                            <?php } ?>
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
include ('../layoutAdmin/parte2.php');
?>

<!-- Agrega el estilo para ajustar el selector -->
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
      "responsive": true, "lengthChange": true, "autoWidth": false,
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
