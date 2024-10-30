<?php

include('../perfil/layout/parte1.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 ">

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Agregar nuevo producto </h3>

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
                                <form action="../../app/controllers/productos/controladorAgregarProductos.php" method="post" enctype="multipart/form-data">
                                    <input type="" name="nit_empresa" value="<?php echo $sesion_nit_empresa; ?>" hidden>
                                    <div class="card-body" style="display: block;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Ingrese el nombre del producto:</label>
                                                    <input type="text" name="nom_producto" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Ingrese el precio del producto:</label>
                                                    <input type="number" name="precio" class="form-control" required>
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
                                                    <input type="number" name="stock" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Ingrese una breve descripción del producto:</label>
                                                    <textarea name="descripcion" class="form-control" required></textarea>
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
                                            <button type="submit" class="btn btn-success">Agregar producto</button>
                                            <a href="<?php echo $URL ?>/empresas/perfil/index.php" class="btn btn-danger">Cancelar</a>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
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

include('../perfil/layout/parte2.php');
