<?php
include("../../empresas/perfil/layout/parte1.php");
include("../../app/controllers/empresas/controladorListaPedidos.php");
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 ">
                    <h1 class="m-0">Listado de mis pedidos</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo $sesion_nom_empresa; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <div class="card">
                                <div class="card-body table-responsive p-0">
                                    <table id="example1" class="table table-hover table-striped">
                                        <thead>
                                            <tr style="text-align: center">
                                                <th>Código de pedido</th>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Estado de pago</th>
                                                <th>Estado producto</th>
                                                <th>Estado recogida</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align:center">
                                            <?php
                                            foreach ($pedidos as $pedido) {
                                                $id_detalle = $pedido['id_detalle'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $pedido['id_pedido']; ?></td>
                                                    <td><?php echo $pedido['nombres']; ?></td>
                                                    <td><?php echo $pedido['nom_producto']; ?></td>
                                                    <td><?php echo $pedido['cantidad']; ?></td>
                                                    <td><?php echo "Pedido con pago"; ?></td>
                                                    <td>
                                                        <?php if (is_null($pedido['estado_producto'])) { ?>
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalActualizar<?php echo $id_detalle; ?>">
                                                                Pedido listo
                                                            </button>
                                                        <?php } elseif ($pedido['estado_producto'] == 1) { ?>
                                                            <span>Pedido listo para recoger</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if (is_null($pedido['estado_producto'])) { ?>
                                                            <span>Aún no disponible</span>
                                                        <?php } elseif ($pedido['estado_recogida'] == 0) { ?>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRecogida<?php echo $id_detalle; ?>">
                                                                Cliente ya recogió el producto
                                                            </button>
                                                        <?php } elseif ($pedido['estado_recogida'] == 1 && !is_null($pedido['fecha_recogida'])) { ?>
                                                            <span>Fecha de recogida: <?php echo $pedido['fecha_recogida']; ?></span>
                                                        <?php } else { ?>
                                                            <span>Pendiente</span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                                <!-- Modal para actualizar estado_producto -->
                                                <div class="modal fade" id="modalActualizar<?php echo $id_detalle; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $id_detalle; ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel<?php echo $id_detalle; ?>">Actualizar Estado del Producto</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../../app/controllers/pedidos/controladorActualizarEstadoProducto.php" method="POST">
                                                                    <input type="hidden" name="id_detalle" value="<?php echo $id_detalle; ?>">
                                                                    <div class="form-group">
                                                                        <label for="estado_producto">¿Desea confirmar que le pedido ya esta listo para recoger?</label>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-success">Confirmar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal para confirmar recogida -->
                                                <div class="modal fade" id="modalRecogida<?php echo $id_detalle; ?>" tabindex="-1" aria-labelledby="modalRecogidaLabel<?php echo $id_detalle; ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalRecogidaLabel<?php echo $id_detalle; ?>">Confirmar recogida</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../../app/controllers/pedidos/controladorActualizarEstadoRecogida.php" method="POST">
                                                                    <input type="hidden" name="id_detalle" value="<?php echo $id_detalle; ?>">
                                                                    <p>¿Confirmar que el cliente ya recogió el producto?</p>
                                                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-4 col-sm-6">
                                <a href="../../empresas/perfil/index.php" class="btn btn-danger btn-lg">Regresar</a>
                            </div>
                            <br>
                        </div>
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
