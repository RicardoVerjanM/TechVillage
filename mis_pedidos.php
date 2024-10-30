<?php

include('clientes/loyaout/parte1.php');
include('app/controllers/pedidos/controladorListaPedidos.php');





?>
 
<style>
    .estado-aprobado {
        color: green;
        font-weight: bold;
    }

    .estado-denegado {
        color: red;
        font-weight: bold;
    }

    .estado-no-disponible {
        color: gray;
    }
</style>

<div class="container mt-5">
    <h2>Mis Pedidos</h2>
    <table id="example1" class="table table-bordered">
        <thead>
            <tr>
                <th>Código de pedido</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Estado de pago</th>
                <th>Estado del producto</th>
                <th>Fecha de recogida</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($pedidos): ?>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($pedido['id_pedido']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['nom_producto']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['cantidad']); ?></td>
                        <td>
                            <?php
                            // Validar el estado de pago y aplicar estilos
                            if ($pedido['estado_pago'] === null) {
                                echo '<span class="estado-no-disponible">No disponible</span>';
                            } elseif ($pedido['estado_pago'] == true) {
                                echo '<span class="estado-aprobado">Aprobado</span>';
                            } elseif ($pedido['estado_pago'] == false) {
                                echo '<span class="estado-denegado">Denegado: <br> Ponte en contacto con nosotros</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            // Validar el estado del producto y aplicar estilos
                            if ($pedido['estado_recogida'] == 1) {
                                echo '<span class="estado-aprobado">Producto ya recogido</span>';
                            } elseif ($pedido['estado_producto'] == null) {
                                echo '<span class="estado-no-disponible">No disponible</span>';
                            } elseif ($pedido['estado_producto'] == true) {
                                echo '<span class="estado-aprobado">Disponible para recogida en: </span> ' . htmlspecialchars($pedido['direccion']);
                            } elseif ($pedido['estado_producto'] == false) {
                                echo '<span class="estado-denegado">Agotado</span>';
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($pedido['fecha_recogida']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay pedidos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>




<style>
    .dataTables_length select {
        width: 80px !important;
        /* Ajusta el ancho para que las flechas no se solapen */
        padding-right: 20px !important;
        /* Aumenta el espacio a la derecha */
    }
</style>


<script>
  $(function () {
    $("#example1").DataTable({
      "pageLength": 10,
      language: {
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Pedidos",
        "infoEmpty": "Mostrando 0 a 0 de 0 Pedidos",
        "infoFiltered": "(Filtrado de _MAX_ total Pedidos)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Pedidos",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
          "first": "Primero",
          "last": "Último",
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
    }).buttons().container().appendTo('#mis_pedidos_wrapper .col-md-6:eq(0)');
  });
</script>



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