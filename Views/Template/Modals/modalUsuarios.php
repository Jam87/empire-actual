<!--MODAL DE USUARIO-->
<div id="modalUsuarios" class="modal zoomIn" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden">
            <div class="modal-header bg-pattern p-3 headerRegister">
                <h4 class="card-title mb-0" id="titleModal">Nuevo usuario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-warning  rounded-0 mb-0">
                <i class="ri-alert-line me-3 align-middle"></i><b><?= $data['page_title_bold']; ?></b>
                <?= $data['descrption_modal1']; ?><span class="text-danger"> * </span><?= $data['descrption_modal2']; ?>
            </div>
            <div class="modal-body">
                <!-- TODO: Formulario de Mantenimiento -->
                <form method="post" id="formUsuario" name="formUsuario">
                    <input type="hidden" id="idUsuario" name="idUsuario" value="">
                    <div class="modal-body">
                        <!--GRUPO 1-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="formulario__grupo" id="grupo__nombre">
                                        <label for="nombre">Nombre <span class="text-danger">*</span></label>

                                        <div class="formulario__grupo-input">
                                            <input type="text" class="form-border" name="nombre" id="nombre" placeholder="EJ. Juan" required>
                                        </div>

                                    </div><!-- Fin: nombre -->
                                </div>

                                <div class="col-sm-6">
                                    <div class="formulario__grupo" id="grupo__apellido">
                                        <label for="nombre">Apellido <span class="text-danger">*</span></label>

                                        <div class="formulario__grupo-input">
                                            <input type="text" class="form-border" name="apellido" id="apellido" placeholder="EJ. Martinez" required>
                                        </div>
                                    </div><!-- Fin: apellido -->
                                </div>
                            </div>
                        </div><!-- Fin: grupo1 -->
                        <br>
                        <!--GRUPO 2-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="formulario__grupo" id="grupo__nombre">
                                        <label for="nombre">Teléfono</label>

                                        <div class="formulario__grupo-input">
                                            <input type="text" class="form-border" name="telefono" id="telefono" placeholder="Ingrese el teléfono">
                                        </div>

                                    </div><!-- Fin: telefono -->
                                </div>

                                <div class="col-sm-6">
                                    <div class="formulario__grupo" id="grupo__apellido">
                                        <label for="nombre">Correo <span class="text-danger">*</span></label>

                                        <div class="formulario__grupo-input">
                                            <input type="text" class="form-border" name="correo" id="correo" placeholder="Ingrese su correo" required>
                                        </div>
                                    </div><!-- Fin: correo-->
                                </div>
                            </div>
                        </div><!-- Fin: grupo2 -->
                        <br>
                        <!--GRUPO 3-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="formulario__grupo" id="grupo__nombre">
                                        <label for="nombre">Username</label>

                                        <div class="formulario__grupo-input">
                                            <input type="text" class="form-border" name="username" id="username" placeholder="Ingrese su nick">
                                        </div>

                                    </div><!-- Fin: username -->
                                </div>

                                <div class="col-sm-6">
                                    <div class="formulario__grupo" id="grupo__apellido">
                                        <label for="nombre">Password <span class="text-danger">*</span></label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password" name="password" placeholder="Ingrese su contraseña" id="password-input">   
                                        </div>        
                                    </div><!-- Fin: password-->
                                    <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13">La contraseña debe contener:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Mínimo <b>8 caracteres</b></p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2"><b>1</b> letra <b>minúscula</b> (a-z)</p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2"><b>1</b> letra <b>mayúscula</b> (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0"><b>1</b> <b>número</b> (0-9)</p>
                                        </div>
                                </div>
                            </div>
                        </div><!-- Fin: grupo3 -->
                        <br>
                        <div class="row gy-2">
                            <div class="col-md-12">
                                <div>
                                    <label for="Description" class="form-label">Descripción</label>
                                    <textarea class="form-border" id="txtDescripcion" name="txtDescription" rows="2" placeholder="Descripción"></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <!--GRUPO 4-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="formulario__grupo" id="grupo__nombre">
                                        <label for="nombre">Estado <span class="text-danger">*</span></label>

                                        <select class="form-select mb-3" id="lStatus" name="lStatus" required>
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        </select>

                                    </div><!-- Fin: username -->
                                </div>

                                <div class="col-sm-6">
                                    <div class="formulario__grupo" id="grupo__apellido">
                                        <label for="nombre">Tipo de usuario <span class="text-danger">*</span></label>
                                        <select class="form-select mb-3" id="Tusuario" name="Tusuario">

                                        </select>
                                    </div><!-- Fin: password-->
                                </div>
                            </div>
                        </div><!-- Fin: grupo4 -->
                        <br>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="btnActionForm" name="action" value="add" class="btn btn-primary "><span id="btnText">Guardar</span></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->