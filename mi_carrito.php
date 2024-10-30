<?php

include('clientes/loyaout/parte1.php');
include('app/controllers/clientes/controladorListaCarrito.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensaje']) && isset($_SESSION['icon'])) {
    $respuesta = $_SESSION['mensaje'];
    $icon = $_SESSION['icon'];
?>
    <script>
        Swal.fire({
            position: "top-center",
            icon: "<?php echo $icon; ?>",
            title: "<?php echo $respuesta; ?>",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
<?php
}

unset($_SESSION['mensaje']);
unset($_SESSION['icon']);
?>

<main>
    <div class="container">
        <h2>Mi Carrito</h2>
        <?php if (count($productos_carrito) > 0): ?>
            <form action="app/controllers/pedidos/controladorPedidoCarrito.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Precio unidad</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos_carrito as $producto): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($producto['foto_1'])): ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['foto_1']); ?>" alt="<?php echo htmlspecialchars($producto['nom_producto']); ?>" style="width: 100px; height: auto;">
                                    <?php else: ?>
                                        <img src="ruta/a/imagen/default.jpg" alt="Imagen no disponible" style="width: 100px; height: auto;">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($producto['nom_producto']); ?></td>
                                <td>$<?php echo number_format($producto['precio_producto'], 2); ?></td>
                                <td>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-secondary" onclick="decrement(<?php echo $producto['id_producto']; ?>)">-</button>
                                        <input type="number" name="cantidad[<?php echo $producto['id_producto']; ?>]" id="cantidad_<?php echo $producto['id_producto']; ?>" value="0" class="form-control text-center" min="1" style="width: 60px;" oninput="updateTotal(<?php echo $producto['id_producto']; ?>)">
                                        <button type="button" class="btn btn-outline-secondary" onclick="increment(<?php echo $producto['id_producto']; ?>)">+</button>
                                    </div>
                                    <small id="stockMessage_<?php echo $producto['id_producto']; ?>" class="form-text"></small> <!-- Mensaje de stock -->
                                </td>
                                </td>
                                <td>
                                    <span id="total_<?php echo $producto['id_producto']; ?>">$<?php echo number_format($producto['precio_producto'], 2); ?></span>
                                </td>
                                <td>
                                    <a href="app/controllers/clientes/controladorEliminarCarrito.php?id=<?php echo $producto['id_producto']; ?>" class="btn btn-danger">Eliminar</a>
                                    <input type="" name="productos[]" value="<?php echo $producto['id_producto']; ?>" hidden>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Mostrar el total del pedido -->
                <div class="form-group">
                    <h4>Total del pedido: <span id="total_pedido">$0.00</span></h4>
                    <input type="hidden" name="total_pedido" id="total_pedido_hidden" value="0">
                </div>

                <!-- Input para subir el comprobante -->
                <div class="form-group">
                    <label for="comprobante">Subir imagen de consignación (Nequi):</label>
                    <input type="file" class="form-control-file" name="comprobante" accept="image/*" required>
                </div>

                <!-- Botón para abrir el primer modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#infoModal">¡Información importante antes de consignar!</button>

                <!-- Botón para abrir el modal de Nequi -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#nequiModal">Información sobre la cuenta de Nequi</button>

                <br><br>
                <button id="submitButton" type="submit" class="btn btn-success">Realizar Pedido</button>

                <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cancelar</button>
            </form>
        <?php else: ?>
            <h2>No hay productos en tu carrito.</h2>
        <?php endif; ?>
    </div>
</main>



<script>
    // Funciones para incrementar y decrementar la cantidad
    function increment(id_producto) {
        var cantidad = document.getElementById('cantidad_' + id_producto);
        cantidad.value = parseInt(cantidad.value) + 1;
        updateTotal(id_producto, <?php echo $producto['stock']; ?>);
    }

    function decrement(id_producto) {
        var cantidad = document.getElementById('cantidad_' + id_producto);
        if (cantidad.value > 1) {
            cantidad.value = parseInt(cantidad.value) - 1;
            updateTotal(id_producto, <?php echo $producto['stock']; ?>);
        }
    }

    // Actualizar el total para cada producto y validar stock
    function updateTotal(id_producto, stock) {
        var cantidad = document.getElementById('cantidad_' + id_producto).value;
        var precio = <?php echo json_encode(array_column($productos_carrito, 'precio_producto', 'id_producto')); ?>;
        var totalProducto = cantidad * precio[id_producto];
        document.getElementById('total_' + id_producto).innerText = '$' + totalProducto.toFixed(2);
        
        // Verificar si la cantidad seleccionada es mayor al stock disponible
        var stockMessage = document.getElementById('stockMessage_' + id_producto);
        var submitButton = document.querySelector('#submitButton');

        if (cantidad > stock) {
            stockMessage.textContent = "Stock no disponible, no puedes realizar la consignación";
            stockMessage.style.color = "red";
            submitButton.disabled = true; // Deshabilitar botón si no hay stock
        } else {
            stockMessage.textContent = "Stock disponible, puedes realizar la consignación";
            stockMessage.style.color = "green";
            submitButton.disabled = false; // Habilitar botón si hay stock suficiente
        }
        
        // Actualizar el total global del pedido
        actualizarTotalPedido();
    }

    

    // Función para actualizar el total global del pedido
    function actualizarTotalPedido() {
        var totalPedido = 0;
        
        <?php foreach ($productos_carrito as $producto): ?>
            var cantidad = document.getElementById('cantidad_<?php echo $producto['id_producto']; ?>').value;
            var precio = <?php echo $producto['precio_producto']; ?>;
            totalPedido += cantidad * precio;
        <?php endforeach; ?>
        
        document.getElementById('total_pedido').innerText = '$' + totalPedido.toFixed(2);
        document.getElementById('total_pedido_hidden').value = totalPedido.toFixed(2); // Actualiza el campo oculto
    }
</script>



<!-- Modal de información -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Información importante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Consigna tu pago y nosotros validaremos la transacción.</p>
                <p>Te notificaremos cuando se valide el pago para proceder con la entrega o envío del producto.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de información sobre la cuenta de Nequi -->
<div class="modal fade" id="nequiModal" tabindex="-1" role="dialog" aria-labelledby="nequiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nequiModalLabel">Información sobre la cuenta de Nequi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Realiza la consignación a la siguiente cuenta Nequi:</p>
                <p><strong>Nombre:</strong> Javier Esteban Urrego Pachon</p>
                <p><strong>Número de cuenta:</strong> 3112677720</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>