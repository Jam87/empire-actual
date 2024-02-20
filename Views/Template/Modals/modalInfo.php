<!--MODAL BANCOS-->
<div id="modalInfo" class="modal zoomIn" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 overflow-hidden">
            <div class="modal-header bg-pattern p-3 headerRegister">
                <h4 class="card-title mb-0" id="titleModal"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-warning  rounded-0 mb-0">
                <i class="ri-alert-line me-3 align-middle"></i><b><?= $data['page_title_bold']; ?></b>
                <?= $data['descrption_modal1']; ?><span class="text-danger"> * </span><?= $data['descrption_modal2']; ?>
            </div>
            <div class="modal-body">
                <form method="post" id="formInfo" name="formInfo">

                    <input type="hidden" id="idInfo" name="idInfo" value="">

                    <div class="row">

                        <div class="col-sm-4">
                            <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                            <input type="number" class="form-border" name="telefono" id="telefono" placeholder="Escriba el telefono">
                        </div>

                        <div class="col-sm-4">
                            <label for="celular">Celular Claro</label>
                            <input type="number" class="form-border" name="movil_claro" id="movil_claro" placeholder="Escriba el # claro">

                        </div><!--Forma pago-->
                        <div class="col-sm-4">
                            <label for="celular">Celular Tigo</label>
                            <input type="number" class="form-border" name="movil_tigo" id="movil_tigo" placeholder="Escriba el # tigo">

                        </div><!--Forma pago-->

                    </div>
                    <div class="row">

                        <div class="col-sm-6">
                            <label for="correo">correo <span class="text-danger">*</span></label>
                            <input type="text" class="form-border" name="email" id="email" placeholder="Escriba el correo" required>
                        </div>

                        <div class="col-sm-6">
                            <label for="web">Sitio Web</label>
                            <input type="texzt" class="form-border" name="web" id="web" placeholder="Escriba la web">

                        </div><!--Forma pago-->

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="operacion">Nombre Firma de operaciones <span class="text-danger">*</span></label>
                            <input type="text" class="form-border" name="operacion" id="operacion" placeholder="Escriba el nombre">
                        </div>

                        <div class="col-sm-4">
                            <label for="cedula">Cédula Firma operaciones</label>
                            <input type="text" class="form-border" name="cedula_operacion" id="cedula_operacion" placeholder="Cédula operaciones">

                        </div><!--Forma pago-->
                        <div class="col-sm-6">
                            <label for="Logo">Logo Empresa</label>
                            <input type="file" class="form-border" name="logo" id="logo">

                        </div><!--Forma pago-->
                        <div class="col-sm-4">
                            <label for="nombre">Estado</label>
                            <select class="form-select mb-3" id="lStatus" name="lStatus">
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="operacion">Dirección <span class="text-danger">*</span></label>
                            <br>
                            <textarea class="form-border" name="direccion" id="direccion" cols="90" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="text-end">
                        <button id="btnActionForm" class="btn-primary" type="submit" class="btn btn-form"><span id="btnText">Guardar</span></button>
                    </div>
                </form>

                <!-- comboxColaborador
                comboxCliente -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->