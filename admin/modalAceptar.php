<!-- Modal Aceptar -->
<div class="modal fade" id="modalAceptar<?php echo $id_solicitud?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: green;">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:white;">Aceptar Solicitud</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="../app/controllers/solicitudes/controladorAceptarSolicitud.php" method="post">
                    <input type="" name="id_solicitud" value="<?php echo $id_solicitud; ?>" hidden>
                    <div class="card-body" style="display: block;">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">NIT de la empresa:</label>
                                    <input type="text" name="nit_empresa" class="form-control" value="<?php echo $solicitud['nit_empresa']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombres de la empresa:</label>
                                    <input type="text" name="nom_empresa" class="form-control" value="<?php echo $solicitud['nom_empresa']; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre del propietario:</label>
                                    <input type="text" name="nom_propietario" class="form-control" value="<?php echo $solicitud['nom_propietario']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Teléfono de contacto:</label>
                                    <input type="text" name="tel_contacto" class="form-control" value="<?php echo $solicitud['tel_contacto'] ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Estado:</label>
                                    <input type="text" name="estado" class="form-control" value="<?php echo $solicitud['estado']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Correo:</label>
                                    <input type="email" name="correo" class="form-control" value="<?php echo $solicitud['correo'] ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha y hora de creación:</label>
                                    <input type="text" name="feyh_creacion" class="form-control" value="<?php echo $solicitud['fyh_solicitud'] ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- Botón para descargar el PDF -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Descargar RUT (PDF):</label>
                                    <?php if (!empty($solicitud['rut'])) { ?>
                                        <a href="<?php echo 'http://localhost/www.TechVillage.com/app/jhvjgvjgv'.$solicitud['rut']; ?>" class="btn btn-primary" download>Descargar PDF</a>
                                    <?php } else { ?>
                                        <p>No hay un archivo PDF disponible.</p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <p>¿Desea aceptar esta solicitud?</p>
                            <button type="submit" class="btn btn-success">Sí</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
