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
                    <h3 id="titulo" class="page-title">Agregar nuevo Recorrido.</h3><!-- cambiar el nombre a "Listado de Corredores" con js -->
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <button class="btn btn-info blancobold" id="btnnuevorecorrido" onclick="mostrarformulario();">Agregar Recorrido</button>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">
            <div class="row" id="formrecorrido">
                <!-- Column 
                    <div class="col-lg-8 col-xlg-9 col-md-12">-->
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" id="frmrecorrido" name="frmcorredor" class="form-horizontal form-material">
                                <!-- ------------------------ DATOS DEL RECORRIDO ------------------------ -->
                                <div class="form-group mb-4">
                                    <label for="nombre" class="col-md-12 p-0"><b>Número del Recorrido:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="hidden" name="id_recorrido" id="id_recorrido">
                                        <input type="hidden" name="verifrecorrido" id="verifrecorrido">
                                        <input type="text" id="nombre" name="nombre" class="form-control p-0 border-0 solonumeros" placeholder="#" required="required" autocomplete="off" maxlength="1" autofocus>
                                    </div>
                                </div>
                                <!-- ------------------------ DATOS DEL RECORRIDO ------------------------ -->
                                 
                                <div class="form-group mb-4">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" id="btnguardar" class="btn btn-success btn-lg btn-block"><i class="fas fa-save"></i>&nbsp;Guardar Recorrido</button>
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
            <div class="card" id="tbllistrecorr" style="border: 1px solid">
                <div class="panel-body table-responsive" id="listadoregistros" style="margin: 5px;"><br>
                    <!--Tabla de datos -->
                    <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead id="cabecera">
                            <th>Opciones:</th>
                            <th>Nombre del Recorrido:</th>
<!--                        <th>Encargado del Recorrido</th>-->
                        </thead>
                        <tbody>
                            <!--Datos de la BD -->
                        </tbody>
                    </table><br>
                </div>
            </div>
        </div>
        <?php  include 'footer.php';  ?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->

        <script src="scripts/recorrido.js"></script>
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
