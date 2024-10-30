
<!-- Modal Aceptar -->
<div class="modal fade" id="modalEliminar<?php echo $id_producto;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: red;">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white;">Eliminar producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../app/controllers/productos/controladorEliminarProducto.php" method="post">
                    <input type="" name="id_producto" value="<?php echo $id_producto; ?>" hidden>
                    <div class="card-body" style="display: block;">
                        <div class="row">

                        <div class="form-group">
                            <p>¿Desea eliminar el producto <?php echo $producto['nom_producto'];?>?</p>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
