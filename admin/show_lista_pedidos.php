<?php
// Incluir los archivos necesarios
include('../app/config.php');
include('../layoutAdmin/sesion.php');
include('../layoutAdmin/parte1.php');
include('../app/controllers/pedidos/controladorAllPedidosAdmin.php');

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

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Lista de pedidos ya registrados</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pedidos</h3>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body table-responsive p-0">
                                    <table id="example1" class="table table-striped table-hover">
                                        <thead>
                                            <tr style="text-align: center">
                                                <th>Código de pedido</th>
                                                <th>Cliente</th>
                                                <th>Total a consignar</th>
                                                <th>Estado de pago</th>
                                                <th>Fecha de compra</th>
                                                <th>Fecha de aceptación o rechazo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center">
                                            <?php foreach ($pedidos as $pedido) {
                                                $id_pedido = $pedido['id_pedido']; ?>
                                                <tr>
                                                    <td><?php echo $pedido['id_pedido']; ?></td>
                                                    <td><?php echo $pedido['nombres']; ?></td>
                                                    <td><?php echo $pedido['precio_total']; ?></td>
                                                    <td>
                                                        <?php
                                                        if (is_null($pedido['estado_pago'])) {
                                                            echo "Aun sin responder";
                                                        } elseif ($pedido['estado_pago'] == 1) {
                                                            echo "Aceptado";
                                                        } else {
                                                            echo "Rechazado";
                                                        } ?>
                                                    </td>
                                                    <td><?php echo $pedido['fecha_creacion']; ?></td>
                                                    <td><?php echo $pedido['fecha_aceptacionOrechazo']; ?></td>
                                                    <td>
                                                        <center>
                                                            <?php if ($pedido['estado_pago'] == 0): // Mostrar el botón solo si el estado de pago es 0 (rechazado) ?>
                                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAprobar<?php echo $id_pedido; ?>">
                                                                    Aceptar
                                                                </button>
                                                            <?php endif; ?>
                                                        </center>
                                                    </td>
                                                </tr>

                                                <!-- Modal Aceptar -->
                                                <div class="modal fade" id="modalAprobar<?php echo $id_pedido; ?>" tabindex="-1" aria-labelledby="modalAprobarLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalAprobarLabel">Aceptar Pedido</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>¿Estás seguro de que deseas aceptar este pedido?</p>
                                                                <p>Aquí está el comprobante de pago:</p>
                                                                <?php if ($pedido['comprobante_pago']): ?>
                                                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($pedido['comprobante_pago']); ?>" alt="Comprobante de Pago" class="img-fluid">
                                                                <?php else: ?>
                                                                    <p>No hay comprobante de pago disponible.</p>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                <form action="../app/controllers/pedidos/controladorAceptarPago.php" method="post">
                                                                    <input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>">
                                                                    <button type="submit" class="btn btn-success">Aceptar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../layoutAdmin/parte2.php'); ?>


!-- Agrega el estilo para ajustar el selector -->
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