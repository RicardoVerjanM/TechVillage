<?php


include("../../empresas/perfil/layout/parte1.php");

include("../../app/controllers/productos/controladorListaProductos.php");



?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 ">
                    <h1 class="m-0">Listado de mis productos</h1>
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
                            <h3 class="card-title"><?php echo $sesion_nom_empresa; ?></h3>

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
                                    <table id="example1" class="table table-hover table-striped">
                                        <thead>
                                            <tr style="text-align: center">

                                                <th>ID producto</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th>Stock</th>
                                                <th>Acciones</th>

                                            </tr>
                                        </thead>
                                        <tbody style="text-align:center">

                                            <?php

                                            foreach ($productos as $producto) {
                                                $id_producto = $producto['id_producto']; ?>
                                                <tr>
                                                    <td><?php echo $id_producto; ?></td>
                                                    <td><?php echo $producto['nom_producto']; ?></td>
                                                    <td><?php echo $producto['precio_producto']; ?></td>
                                                    <td><?php echo $producto['stock']; ?></td>
                                                    <td>
                                                        <center>
                                                            <button type="button"  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalMostrar<?php echo $id_producto; ?>">
                                                                <i class="fas fa-eye"></i> Mostrar
                                                            </button>
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalActualizar<?php echo $id_producto; ?>">
                                                                <i class="fas fa-pencil-alt"></i> Actualizar
                                                            </button>
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $id_producto; ?> ">
                                                                <i class="fas fa-trash"></i> Eliminar
                                                            </button>

                                                        </center>
                                                    </td>

                                                </tr>

                                            <?php
                                                include('../perfil/modalMostrar.php');
                                                include('../perfil/modalActualizar.php');
                                                include('../perfil/modalEliminar.php');
                                            }
                                            ?>
                                        </tbody>

                                    </table>


                                    <!-- /.card-body -->

                                </div>

                            </div>
                            <br>
                            <div class="col-md-4 col-sm-6">
                                <a href="../../empresas/perfil/index.php" class="btn btn-danger btn-lg">Regresar</a>
                            </div>
                            <br>
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

<?php

include("../../empresas/perfil/layout/parte2.php");

?>