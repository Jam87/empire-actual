<!--MODAL DE CLIENTES-->
<div id="modalCliente" class="modal zoomIn" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content border-0 overflow-hidden" style="background: #F2F2F2 !Important;">
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
                <form method="post" id="formCliente" name="formCliente">
                    <input type="hidden" id="idCliente" name="idCliente" value="">
                    <div class="modal-body">

                        <div class="row">
                            <div class="">
                                <div class="card pag-title-box">
                                    <div class="pag-title-box">
                                        <h4 class="card-title mb-0 flex-grow-1">General information</h4>
                                        <div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="p-3 col-xl-12">
                                        <div>
                                            <div>
                                                <!--GRUPO 1-->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="">
                                                            <label for="pais">Names <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-border" name="nombres" id="nombres" placeholder="Write the names">
                                                        </div><!--Expendiente-->

                                                        <div class=" ">
                                                            <label for="nombre">Last name<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-border" name="apellidos" id="apellidos" placeholder="Write the last names">
                                                        </div><!--Nombre-->
                                                    </div>
                                                </div>
                                                <br>

                                                <!--GRUPO 2-->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label for="horaRapida">Opening hours <span class="text-danger">*</span></label>
                                                            <input type="time" class="form-control" id="horaApertura" name="horaApertura">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="horaNormal">Closing time<span class="text-danger">*</span></label>
                                                            <input type="time" class="form-control" id="horaCierre" name="horaCierre">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                                <!--GRUPO 3-->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <!-- Columna 1 -->

                                                        <div class="col-sm-4">
                                                            <label for="nombre">Status</label>
                                                            <select class="form-select mb-3" id="lStatus" name="lStatus">
                                                                <option value="1">active</option>
                                                                <option value="2">inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div><!-- Fin: grupo2 -->
                                        </div>

                                        <!--end col-->
                                    </div>
                                </div><!-- end card header -->

                            </div><!-- end card -->
                        </div><!-- end col -->
                        <!-- end col -->
                    </div><!--Fin: 1 card-->

            </div>
            <div class="modal-footer">

                <button type="submit" id="btnActionForm" name="action" value="add" class="btn btn-primary "><span id="btnText">save</span></button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

