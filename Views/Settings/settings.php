<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <title><?= $data['page_title']; ?></title>
    <?php MainHead($data); ?>


</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- ==== Main Headerr ====== -->
        <?php MainHeader($data); ?>


        <!-- ========== App Menu ========== -->
        <?php MainMenu($data); ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="profile-foreground position-relative mx-n4 mt-n4">
                        <div class="profile-wid-bg">

                            <img src="<?= base_url(); ?>/assets/images/auth-one-bg.jpg" alt="" class="profile-wid-img" />
                        </div>
                    </div>
                    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
                        <div class="row g-4">
                            <div class="col-auto">
                                <div class="avatar-lg">
                                    <img src="<?= base_url(); ?>public/images/logo-sm.png" alt="user-img" class="img-thumbnail rounded-circle" />
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col">
                                <div class="p-2">
                                    <h3 class="text-white mb-1">Javier Mora</h3>
                                    <p class="text-white-75">Administrador</p>
                                    <div class="hstack text-white-50 gap-1">
                                        <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>Managua, Nicaragua</div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <!-- Tab panes -->
                                <div class="tab-content pt-4 text-muted">
                                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                        <div class="row">
                                            <div class="col-xxl-3">

                                                <div class="card">
                                                    <div class="card-body">

                                                        <div class="row">
                                                            <div class="col-12">

                                                                <div class="row">
                                                                    <div class="col-xxl-4 col-lg-6">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h6 class="card-title mb-0"><b>CAMBIAR CLAVE</b></h6>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form method="post" id="settingPass" name="settingPass">

                                                                                    <div class="row">

                                                                                        <div class="">

                                                                                            <p>
                                                                                                Cambiar la contraseña de login para ingresar
                                                                                            </p>
                                                                                            <div>
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

                                                                                    <div class="text-left">
                                                                                        <button id="btnActionForm" class="btn-primary" type="submit" class="btn btn-form"><span id="btnText">Guardar</span></button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>

                                                                        </div>
                                                                    </div><!-- end col -->
                                                                    <div class="col-xxl-4 col-lg-6">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h6 class="card-title mb-0"><span class="text-secondary"><b>COLAPSAR MENU</b></span></h6>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form method="post" id="settingCollapse" name="settingCollapse">

                                                                                    <div class="mb-3">
                                                                                        <p>
                                                                                            Menu principal se mantenga desplegado: <b>lg</b> o colapsado: <b>sm</b>
                                                                                        </p>
                                                                                        <label for="exampleSelect1">Seleccione una opción <span class="text-danger">*</span></label>
                                                                                        <select class="form-select mb-3" id="listCollapse" name="listCollapse" required>
                                                                                            <option value="lg">lg</option>
                                                                                            <option value="sm">sm</option>
                                                                                        </select>
                                                                                    </div> <!--Fin Select-->

                                                                                    <div class="text-end">
                                                                                        <button id="btnActionForm" class="btn-primary" type="submit" class="btn btn-form"><span id="btnText">Guardar</span></button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>

                                                                        </div>
                                                                    </div><!-- end col -->

                                                                </div><!-- end row -->
                                                            </div><!-- end col -->
                                                        </div><!-- end row -->
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->

                                                <!--end card-->
                                            </div>
                                            <!--end col-->

                                        </div>
                                        <!--end row-->
                                    </div>

                                </div>
                                <!--end tab-content-->
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div><!-- container-fluid -->
            </div><!-- End Page-content -->
            <!-- FOOTER -->
            <?php MainFooter($data); ?>
        </div><!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- JAVASCRIPT -->
    <?php MainJs($data); ?>
</body>

</html>