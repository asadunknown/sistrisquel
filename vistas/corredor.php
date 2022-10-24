<?php 
    session_start(); 
    if(isset($_SESSION['usuario']))
    {
        if($_SESSION['usuario']['tipo_empleado'] == 'Administracion' || $_SESSION['usuario']['tipo_empleado'] == 'Sistemas')
        {
?>
<?php  include 'header.php';  ?>

<body onload="init(); initgen();">
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-10 col-md-10 col-sm-4 col-xs-12">
                    <h3 id="titulo" class="page-title">Agregar nuevo Corredor.</h3><!-- cambiar el nombre a "Listado de Corredores" con js -->
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <button class="btn btn-info blancobold" id="btnlistacorredor" onclick="mostrarlistado();">Mostrar Listado</button>
                    <button class="btn btn-info blancobold" id="btnnuevocorredor" onclick="mostrarformulario();">Agregar Corredor</button>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

            <div class="card bordetabla" id="tbllistcorr" style="border: 1px solid">
                <div class="panel-body table-responsive" id="listadoregistros" style="margin: 5px;"><br>
                    <!--Tabla de datos -->
                    <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Opciones:</th>
                            <th>No. Corredor:</th>
                            <th>Nombre:</th>
                            <th>Dirección:</th>
                            <th>Teléfono:</th>
                            <th>Tipo de Corredor:</th>
                        </thead>
                        <tbody>
                            <!--Datos de la BD -->
                        </tbody>
                    </table><br>
                </div>
            </div>

            <!-- Row -->
            <div class="row" id="formcorredor">
                <!-- Column 
                    <div class="col-lg-8 col-xlg-9 col-md-12">-->
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" id="frmcorredor" name="frmcorredor" class="form-horizontal form-material">
                                <!-- ------------------------ DATOS DEL CORREDOR ------------------------ -->
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for=""><b>Nombre de la Persona:</b></label>
                                    <select class="form-control" selectpicker name="id_nombre_persona" id="id_nombre_persona" data-live-search="true" required=""></select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="numero_corredor" class="col-md-12 p-0"><b>Número de Corredor:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="hidden" name="id_corredor" id="id_corredor">
                                        <input type="hidden" name="verifcorr" id="verifcorr">
                                        <input type="text" id="numero_corredor" name="numero_corredor" placeholder="123" class="form-control p-0 border-0 solonumeros" maxlength="3" required autocomplete="off">
                                    </div>
                                </div>
                                <!-- ------------------------ DATOS DEL CORREDOR ------------------------ -->

                                <!-- ------------------------ DATOS DEL CORREDOR ------------------------ -->
                                <div class="form-group mb-4">
                                    <label class="col-sm-12" for="tipo_corredor"><b>Tipo de Corredor:</b></label>
                                    <div class="col-sm-12 border-bottom">
                                        <select id="tipo_corredor" name="tipo_corredor" selectpicker class="form-select shadow-none p-0 border-0 form-control-line">
                                            <option value="Manual">Corredor Manual</option>
                                            <option value="Virtual">Corredor Virtual</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="divnombre_local" class="form-group mb-4">
                                    <label for="nombre_local" class="col-md-12 p-0"><b>Nombre del Local:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="text" id="nombre_local" name="nombre_local" placeholder="Pronósticos Las Esferas" class="form-control p-0 border-0" required autocomplete="off">
                                    </div>
                                </div>
                                <div id="divanydesk" class="form-group mb-4">
                                    <label for="anydesk" class="col-md-12 p-0"><b>AnyDesk:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="text" id="anydesk" name="anydesk" placeholder="1234567890" class="form-control p-0 border-0 solonumeros" maxlength="10" required autocomplete="off">
                                    </div>
                                </div>
                                <div id="divteamviewer" class="form-group mb-4">
                                    <label for="teamviewer" class="col-md-12 p-0"><b>TeamViewer:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="text" id="teamviewer" name="teamviewer" placeholder="1234567890" class="form-control p-0 border-0 solonumeros" maxlength="10" required autocomplete="off">
                                    </div>
                                </div>

                                <!-- ------------------------ DATOS DEL CORREDOR ------------------------ -->
                                <div class="form-group mb-4">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" id="btnguardar" class="btn btn-success btn-lg btn-block"><i class="fas fa-save"></i>&nbsp;Guardar Corredor</button>
                                        <button type="submit" id="btnguardaredit" class="btn btn-success btn-lg btn-block"><i class="fas fa-cloud-upload-alt"></i>&nbsp;Actualizar Datos</button>
                                        <button type="button" id="btncancelar" style="color: white;" class="btn btn-danger btn-lg btn-block" onclick="cancelarform();">Cancelar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
        </div>
        <?php  include 'footer.php';  ?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->

        <script src="scripts/corredor.js"></script>
        <script src="scripts/general.js"></script>

        <?php 
        }
        else
        {
            header('Location: 404.php');
        }
    }
    else
    {
        header('Location: 404.php');
    }
?>