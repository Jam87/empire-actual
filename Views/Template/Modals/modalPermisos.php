<div id="modalPermisos" class="modal zoomIn" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden">
            <div class="modal-header bg-pattern p-3 headerRegister">
                <h4 class="card-title mb-0" id="titleModal">Permisos Roles de Usuario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-warning  rounded-0 mb-0">
                <i class="ri-alert-line me-3 align-middle"></i><b>Estimado usuario</b>
                Los campos remarcados con<span class="text-danger"> * </span>son necesarios.
            </div>

            <div class="modal-body">
                <div class="col-md-12">
                    <form action="" id="formPermisos" name="formPermisos">
                        <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol']; ?>" required="">
                        <div class="table-responsive">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 5px !important;">#</th>
                                        <th style="width: 10px !important;">Módulo</th>
                                        <th style="width: 10px !important;">Ver</th>
                                        <th style="width: 10px !important;">Crear</th>
                                        <th style="width: 10px !important;">Actualizar</th>
                                        <th style="width: 10px !important;">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $no = 1;
                                    $modulos = $data['modulos'];
                                    for ($i = 0; $i < count($modulos); $i++) {

                                        $permisos = $modulos[$i]['permisos'];
                                        $rCheck = $permisos['r'] == 1 ? " checked " : "";
                                        $wCheck = $permisos['w'] == 1 ? " checked " : "";
                                        $uCheck = $permisos['u'] == 1 ? " checked " : "";
                                        $dCheck = $permisos['d'] == 1 ? " checked " : "";

                                        $idmod = $modulos[$i]['cod_modulo'];
                                    ?>
                                        <tr>
                                            <td>
                                                <?= $no; ?>
                                                <input type="hidden" name="modulos[<?= $i; ?>][cod_modulo]" value="<?= $idmod ?>" required>
                                            </td>
                                            <td>
                                                <?= $modulos[$i]['titulo']; ?>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-switch-success" style="text-align: center;">
                                                    <input class="form-check-input" type="checkbox" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?> role="switch" id="SwitchCheck3">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-switch-success" style="text-align: center;">
                                                    <input class="form-check-input" type="checkbox" name="modulos[<?= $i; ?>][w]" <?= $wCheck ?> role="switch" id="SwitchCheck3">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-switch-success" style="text-align: center;">
                                                    <input class="form-check-input" type="checkbox" name="modulos[<?= $i; ?>][u]" <?= $uCheck ?> role="switch" id="SwitchCheck3">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-switch-success" style="text-align: center;">
                                                    <input class="form-check-input" type="checkbox" name="modulos[<?= $i; ?>][d]" <?= $dCheck ?> role="switch" id="SwitchCheck3">
                                                </div>
                                            </td>
                                        </tr>

                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center">
                            <button type="reset" class="btn btn-light" data-bs-dismiss="modal" style="margin-right: 5px;">Cerrar</button>
                            <button type="submit" id="btnActionForm" name="action" value="add" class="btn btn-primary "><span id="btnText">Guardar</span></button>
                        </div>
                    </form>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->