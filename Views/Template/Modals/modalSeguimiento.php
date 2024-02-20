<div id="modalSeguimiento" class="modal zoomIn" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 overflow-hidden" style="background: #F2F2F2 !Important;">
            <div class="modal-header bg-pattern p-3 headerRegister">
                <h4 class="card-title mb-0" id="titleModal"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-warning  rounded-0 mb-0">
                <i class="ri-alert-line me-3 align-middle"></i><b><?= $data['page_title_bold']; ?></b>
                <?= $data['descrption_modal1']; ?><span class="text-danger"> * </span><?= $data['descrption_modal2']; ?>
            </div>
            <div class="modal-body">
                <!-- TODO: Formulario de Mantenimiento -->
                <form method="post" id="formSeguimiento" name="formSeguimiento">
                    <input type="hidden" id="idSeguimiento" name="idSeguimiento" value="">
                    <div class="modal-body">

                        <div class="row">
                            <div class="">
                                <div class="card pag-title-box">

                                    <div class="p-3 col-xl-12">
                                        <div>
                                            <div>
                                                <!--GRUPO 1-->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label for="orden">Purchase order<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-border" name="orden" id="orden" placeholder="Enter #order">
                                                        </div><!--Expendiente-->
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label>Customer name<span class="text-danger">*</span></label>
                                                            <select class="form-selec" id="comboxCliente" name="comboxCliente">
                                                            </select>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label>Type of material<span class="text-danger">*</span></label>
                                                            <select class="form-control" id="comboxMaterial" name="comboxMaterial">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div><!-- Fin: grupo2 -->

                                                <br>

                                                <!--GRUPO 4-->
                                                <div class="form-">
                                                    <div class="row">

                                                        <div class="col-sm-4">
                                                            <label>Qty<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-border" name="qty" id="qty" placeholder="Enter the qty">
                                                        </div><!--Forma pago-->

                                                        <div class="col-sm-4">
                                                            <label for="size">Size<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-border" name="size" id="size" placeholder="Enter the Size">
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <label for="Ship">Shipping date<span class="text-danger">*</span></label>
                                                            <input type="date" class="form-control" id="shipDate" name="shipDate">
                                                        </div>

                                                    </div>
                                                </div><!-- Fin: grupo2 -->

                                                <!--GRUPO 5-->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label for="Notes">Note</label>
                                                            <textarea class="form-border" id="notes" name="notes" placeholder="Enter message"></textarea>
                                                            <!-- Mostrara el mensaje -->
                                                            <div id="character-count"></div>
                                                        </div><!--Forma pago-->

                                                    </div>
                                                </div>
                                                <br>
                                                <!--GRUPO 6-->
                                                <div class="col-sm-4">
                                                    <label for="Estado">Status</label>
                                                    <select class="form-select mb-3" id="lStatus" name="lStatus">
                                                        <option value="1">Active</option>
                                                        <option value="2">Inactive</option>
                                                    </select>
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

                <button type="button" id="btnCerrar" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <!-- Botón "Guardar e Imprimir" -->
                <button type="button" id="btnImprimir" class="btn btn-info waves-effect waves-light" onclick="Imprimir();">Print</button>               
                <button id="btnActionForm" class="btn btn-primary waves-effect waves-light" type="submit" class="btn btn-form"><span id="btnText">Save and Print</span></button>
              
                <!-- Este boton al guardar en el status = 0 para no mostrarlo en el datatable -->

            </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<!------------------------------>
<!-- MODAL VISTA SEGUIMIENTO -->
<!------------------------------>

<div id="modalViewUser" class="modal zoomIn" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden">
            <div class="modal-header bg-pattern p-3 headerRegister" style="background-color: #FFBB3B;">
                <h4 class="card-title mb-0" id="titleModal"><b><span style="color:#000; font-weight: bold;">Tracking details</span></b></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <table class="table table-bordered">
                    <tbody>
                        <tr style="background-color: #F2F2F2;">
                            <td>
                                <h6 style="font-size: 14px;"><b>Date and time of entry into the system:</b></h6>
                            </td>
                            <td id="fechaSystem">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D9D9D9;">
                            <td>
                                <h6 style="font-size: 14px;"><b>Note</b></h6>
                            </td>
                            <td id="notesV">
                                <h6 style="font-size: 14px;"></h6>
                            </td>
                        </tr>

                        
                    </tbody>
                </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!------------------------------>
<!-- MODAL EDITAR SEGUIMIENTO -->
<!------------------------------>

<div id="modalEditSeguimiento" class="modal zoomIn" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 overflow-hidden" style="background: #F2F2F2 !Important;">
            <div class="modal-header bg-pattern p-3 headerRegister">
                <h4 class="card-title mb-0" id="titleModal"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-warning  rounded-0 mb-0">
                <i class="ri-alert-line me-3 align-middle"></i><b><?= $data['page_title_bold']; ?></b>
                <?= $data['descrption_modal1']; ?><span class="text-danger"> * </span><?= $data['descrption_modal2']; ?>
            </div>
            <div class="modal-body">
                <!-- TODO: Formulario de Mantenimiento -->
                <form method="post" id="formEditSeguimiento" name="formEditSeguimiento">
                    <input type="hidden" id="idEditSeguimiento" name="idEditSeguimiento" value="">
                    <div class="modal-body">

                        <div class="row">
                            <div class="">
                                <div class="card pag-title-box">

                                    <div class="p-3 col-xl-12">
                                        <div>
                                            <div>
                                                <!--GRUPO 1-->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label for="orden">Purchase order<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-border" name="orden" id="orden" placeholder="Enter #order">
                                                        </div><!--Expendiente-->
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label>Customer name<span class="text-danger">*</span></label>
                                                            <select class="form-selec" id="comboxCliente" name="comboxCliente">
                                                            </select>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label>Type of material<span class="text-danger">*</span></label>
                                                            <select class="form-control" id="comboxMaterial" name="comboxMaterial">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div><!-- Fin: grupo2 -->

                                                <br>

                                                <!--GRUPO 4-->
                                                <div class="form-">
                                                    <div class="row">

                                                        <div class="col-sm-4">
                                                            <label>Qty<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-border" name="qty" id="qty" placeholder="Enter the qty">
                                                        </div><!--Forma pago-->

                                                        <div class="col-sm-4">
                                                            <label for="size">Size<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-border" name="size" id="size" placeholder="Enter the Size">
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <label for="Ship">Shipping date<span class="text-danger">*</span></label>
                                                            <input type="date" class="form-control" id="shipDate" name="shipDate">
                                                        </div>

                                                    </div>
                                                </div><!-- Fin: grupo2 -->

                                                <!--GRUPO 5-->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label for="Notes">Note</label>
                                                            <textarea class="form-border" id="notes" name="notes" placeholder="Enter message"></textarea>
                                                            <!-- Mostrara el mensaje -->
                                                            <div id="character-count"></div>
                                                        </div><!--Forma pago-->

                                                    </div>
                                                </div>
                                                <br>
                                                <!--GRUPO 6-->
                                                <div class="col-sm-4">
                                                    <label for="Estado">Status</label>
                                                    <select class="form-select mb-3" id="lStatus" name="lStatus">
                                                        <option value="1">Active</option>
                                                        <option value="2">Inactive</option>
                                                    </select>
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

                <button id="btnActionForm" class="btn btn-primary waves-effect waves-light" type="submit" class="btn btn-form"><span id="btnText">Guardar</span></button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>

                <!-- <button type="button"  class="btn btn-primary waves-effect waves-light" type="submit" class="btn btn-form" onclick="guardarEImprimir1();"><span id="btnText">Guardar e Imprimir</button> -->

                <!-- Botón "Guardar e Imprimir" -->
                <!-- Este boton al guardar en el status = 0 para no mostrarlo en el datatable -->
                <button type="button" class="btn btn-primary waves-effect waves-light btn-form" onclick="guardarEImprimir();"><span id="btnText">Imprimir</span></button>

            </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->