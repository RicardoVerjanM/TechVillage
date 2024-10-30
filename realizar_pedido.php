<?php

include('clientes/loyaout/parte1.php');

$id_get = $_GET['id_producto']; // Obtener el ID del producto

// Consulta para obtener los detalles del producto
$sql_productos = "SELECT * FROM productos WHERE id_producto = :id_producto;";
$query_productos = $pdo->prepare($sql_productos);
$query_productos->bindParam(':id_producto', $id_get, PDO::PARAM_INT);
$query_productos->execute();
$producto = $query_productos->fetch(PDO::FETCH_ASSOC);

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


if ($validar_sesion == true) {

    // Mostrar producto y formulario para subir la imagen
?>
    <div class="container">
        <h2>Subir comprobante de pago Nequi</h2>

        <!-- Botón para abrir el primer modal -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#infoModal">¡Información importante antes de consignar!</button><br>

        <br>
        <!-- Mostrar información del producto -->
        <div class="card">
            <div class="card-body">
                <h4>Producto: <?php echo htmlspecialchars($producto['nom_producto']); ?></h4>
                <p>Precio: $<?php echo number_format($producto['precio_producto'], 2); ?></p>
            </div>
        </div>

        <!-- Formulario para subir imagen y especificar cantidad -->
        <form action="app/controllers/pedidos/controladorAgregarPedido.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_producto" value="<?php echo $id_get; ?>"> <!-- ID del producto -->
            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>"> <!-- ID del producto -->

            <!-- Input de cantidad con botones de más y menos (más pequeños) -->
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="decrement()">-</button>
                    </div>
                    <input type="number" class="form-control text-center" id="cantidad" name="cantidad" value="1" min="1" required style="width: 60px; font-size: 14px;" onchange="updateTotal()"> <!-- Actualiza total al cambiar la cantidad -->
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="increment()">+</button>
                    </div>
                     
                </div>
                <small id="stockMessage" class="form-text"></small>
            </div>

            <!-- Mostrar total a consignar -->
            <div class="form-group">
                <label for="total">Total a consignar: </label>
                <!-- Campo visible que muestra el total con formato -->
                <input type="text" id="total_mostrar" class="form-control" readonly>

                <!-- Campo oculto para enviar el total sin formato al servidor -->
                <input type="hidden" id="total" name="total" value="<?php echo $producto['precio_producto']; ?>">
            </div>

            <!-- Botón para abrir el modal sobre la cuenta de Nequi -->
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#nequiModal">Información sobre la cuenta de Nequi</button>

            <div class="form-group">
                <label for="comprobante">Subir imagen de consignación (Nequi):</label>
                <input type="file" class="form-control-file" name="comprobante" accept="image/*">
            </div>

            <!-- Botones para enviar el comprobante y cancelar -->
            <button id="submitButton" type="submit" class="btn btn-success">Enviar comprobante</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='detalle_producto.php?id=<?php echo $id_get; ?>'">Cancelar</button>
        </form>
    </div>

    <script>
        var precioProducto = <?php echo $producto['precio_producto']; ?>; // Precio del producto
        var stockDisponible = <?php echo $producto['stock']; ?>;

        // Funciones para incrementar y decrementar la cantidad
        function increment() {
            var cantidad = document.getElementById('cantidad');
            cantidad.value = parseInt(cantidad.value) + 1;
            updateTotal(); // Actualizar total
        }

        function decrement() {
            var cantidad = document.getElementById('cantidad');
            if (cantidad.value > 1) {
                cantidad.value = parseInt(cantidad.value) - 1;
                updateTotal(); // Actualizar total
            }
        }

        // Función para actualizar el total a consignar
        function updateTotal() {
        var cantidad = document.getElementById('cantidad').value;
        var total = cantidad * precioProducto;

        // Asignar el total sin formato al campo oculto
        document.getElementById('total').value = total;

        // Mostrar el total con formato en el campo visible
        document.getElementById('total_mostrar').value = total.toLocaleString('es-ES');

        // Verificar si la cantidad seleccionada es menor o igual al stock disponible
        var stockMessage = document.getElementById('stockMessage');
        var submitButton = document.getElementById('submitButton');

        if (cantidad > stockDisponible) {
            stockMessage.textContent = "Stock no disponible, no puedes realizar la consignación.";
            stockMessage.style.color = "red";
            submitButton.disabled = true; // Deshabilitar el botón de enviar
        } else {
            stockMessage.textContent = "Stock disponible, puedes realizar la consignación.";
            stockMessage.style.color = "green";
            submitButton.disabled = false; // Habilitar el botón de enviar
        }
    }

    // Llamada inicial para establecer el formato al cargar la página
    updateTotal();
    </script>

<?php
} else {
    echo "<script type='text/javascript'>window.location.href = '" . $URL . "/clientes/login_cliente.php';</script>";
    exit();
}
?>

<!-- Modal de información -->
<div class="modal fade" id="infoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Información acerca de nuestro modelo de negocio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Consigna tu pago y nosotros nos encargaremos de validarlo.</p>
                <p>Te notificaremos una vez validado el pago para que puedas recoger tu producto o coordinar el envío con el vendedor.</p>
                <p>Al enviar este formulario con la consignación, estás aceptando nuestro modelo de negocio.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
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
                <p>Por favor, realiza la consignación a la siguiente cuenta de Nequi:</p>
                <p><strong>Nombre del beneficiario:</strong> Javier Esteban Urrego Pachon</p>
                <p><strong>Número de cuenta:</strong> 3112677720</p>
                <p>Una vez realizada la consignación, por favor sube la foto del comprobante en el siguiente apartado, ¡Gracias!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>