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
                    <h3 id="titulo" class="page-title">Asignar nuevo Recorrido.</h3><!-- cambiar el nombre a "Listado de Asignaciones de Recorridos"-->
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <button class="btn btn-info blancobold" id="btnnuevaasignacion" onclick="mostrarformulario();">Agregar Asignación</button>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">
            <div class="row" id="formasignacion">
                <!-- Column 
                    <div class="col-lg-8 col-xlg-9 col-md-12">-->
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" id="frmasignacion" name="frmasignacion" class="form-horizontal form-material">
                                <!-- ------------------------ DATOS DEL RECORRIDO ------------------------ -->
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="id_corredorPer"><b>Nombre de la Persona:</b></label>
                                    <input type="hidden" name="id_asignacion_recorrido" id="id_asignacion_recorrido">
                                    <input type="hidden" name="verifidcorrper" id="verifidcorrper">
                                    <select class="form-control"  name="id_corredorPer" id="id_corredorPer" data-live-search="true" required="required"></select>
                                </div>
                                
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="id_recorrido"><b>Número de Recorrido:</b></label>
                                    <input type="hidden" name="verifidrecorrido" id="verifidrecorrido">
                                    <select class="form-control"  name="id_recorrido" id="id_recorrido" data-live-search="true" required="required"></select>
                                </div>
                                <!-- ------------------------ DATOS DEL RECORRIDO ------------------------ -->
                                 
                                <div class="form-group mb-4">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" id="btnguardar" class="btn btn-success btn-lg btn-block"><i class="fas fa-save"></i>&nbsp; Asignar Recorrido</button>
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
            
            <div class="card" id="tbllistasignacion" style="border: 1px solid">
                <div class="panel-body table-responsive" id="listadoregistros" style="margin: 5px;"><br>
                    <!--Tabla de datos -->
                    <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead id="cabecera">
                            <th>Opciones</th>
                            <th>Número de Corredor:</th>
                            <th>Nombre de Corredor:</th>
                            <th>Recorrido Asignado:</th>
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


        <script src="scripts/asignacion_recorrido.js"></script>
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