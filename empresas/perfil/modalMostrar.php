<!-- Modal Aceptar -->
<div class="modal fade" id="modalMostrar<?php echo $id_producto ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #28a745;">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:white;">Informacion del producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre del producto:</label>
                                <input type="text" name="nom_producto" value="<?php echo $producto['nom_producto']; ?>" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Precio del producto:</label>
                                <input type="number" name="precio" value="<?php echo $producto['precio_producto']; ?>" class="form-control" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria">Categoría del producto</label>
                                <input type="" value="<?php
                                                        switch ($producto['id_categoria']) {
                                                            case 1:
                                                                echo "Ropa";
                                                                break;
                                                            case 2:
                                                                echo "Calzado";
                                                                break;
                                                            case 3:
                                                                echo "Tecnologia";
                                                                break;
                                                            case 4:
                                                                echo "Deportivo";
                                                                break;
                                                            case 5:
                                                                echo "Hogar y muebles";
                                                                break;
                                                            case 6:
                                                                echo "Herramienta";
                                                                break;
                                                            case 7:
                                                                echo "Estetica y belleza";
                                                                break;
                                                            case 8:
                                                                echo "Juguetes";
                                                                break;
                                                            case 9:
                                                                echo "Salud y bienestar";
                                                                break;
                                                            case 10:
                                                                echo "Libros y papeleria";
                                                                break;
                                                            case 11:
                                                                echo "Mascotas";
                                                                break;
                                                            case 12:
                                                                echo "Accesorios";
                                                                break;
                                                        }
                                                        ?>" class="form-control" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stock disponible del producto:</label>
                                <input type="number" name="stock" value="<?php echo $producto['stock']; ?>" class="form-control" class="form-control" disabled>
                            </div>
                        </div>
                        <?php $sql_fotos = "SELECT * FROM fotos_producto 
               JOIN productos ON productos.id_producto = fotos_producto.id_producto 
               WHERE fotos_producto.id_producto = :id_producto";

                        $query_fotos = $pdo->prepare($sql_fotos);
                        $query_fotos->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                        $query_fotos->execute();

                        $fotos = $query_fotos->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descripción del producto:</label>
                                <textarea name="descripcion" value="<?php echo $producto['descripcion']; ?>" class="form-control" class="form-control" disabled><?php echo $producto['descripcion']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Fotos del producto:</label>
                                <br>
                                <?php
                                // Recorre cada fila de fotos
                                foreach ($fotos as $foto) {
                                    // Itera sobre las posibles columnas de fotos: foto_1, foto_2, ... foto_5
                                    for ($i = 1; $i <= 5; $i++) {
                                        $foto_key = 'foto_' . $i; // Genera foto_1, foto_2, etc.

                                        // Verifica si la columna de la foto no está vacía
                                        if (!empty($foto[$foto_key])) {
                                            echo '<img class="img-fluid" 
                        src="data:image/jpg;base64,' . base64_encode($foto[$foto_key]) . '" 
                        alt="Foto ' . $i . '" style="max-width: 150px; height: auto; margin: 5px;">';
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>