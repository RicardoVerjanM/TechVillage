<!-- Modal Aceptar -->
<div class="modal fade" id="modalActualizar<?php echo $id_producto ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: blue;">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:white;">Actualizar producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../app/controllers/productos/controladorActualizarProductos.php" method="post" enctype="multipart/form-data">
                    <input type="" name="id_producto" value="<?php echo $id_producto; ?>" hidden>
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ingrese el nombre del producto:</label>
                                    <input type="text" name="nom_producto" value="<?php echo $producto['nom_producto']; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ingrese el precio del producto:</label>
                                    <input type="number" name="precio" value="<?php echo $producto['precio_producto']; ?>" class="form-control" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categoria">Categoría</label>
                                    <select name="categoria" id="categoria" class="form-control" required>
                                        <option value="" selected disabled>Selecciona una categoría</option>
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
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ingrese el stock dispobile:</label>
                                    <input type="number" name="stock" value="<?php echo $producto['stock']; ?>" class="form-control" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ingrese una breve descripción del producto:</label>
                                    <textarea name="descripcion" value="<?php echo $producto['descripcion']; ?>" class="form-control" class="form-control" required><?php echo $producto['descripcion']; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ingrese hasta 5 fotos del producto:</label>
                                    <input type="file" name="fotos[]" class="form-control" multiple required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Actualizar producto</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>