<?php 
    session_start(); 
    if(isset($_SESSION['usuario']))
    {
        if($_SESSION['usuario']['tipo_empleado'] == 'Administracion' || $_SESSION['usuario']['tipo_empleado'] == 'Sistemas')
        {
?>
<?php  include 'header.php';  ?>

<body onload="init(); initgen();">
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-10 col-md-10 col-sm-4 col-xs-12">
                    <h3 id="titulo" class="page-title">Agregar nuevo Empleado.</h3>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <button class="btn btn-info blancobold" id="btnlistaempleado" onclick="mostrarlistado();">Mostrar Listado</button>
                    <button class="btn btn-info blancobold" id="btnnuevoempleado" onclick="mostrarformulario();">Agregar Empleado</button>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="card" id="tbllistempleado" style="border: 1px solid">
                <div class="panel-body table-responsive margen" id="listadoregistros" style="margin: 5px;"><br>
                    <!--Tabla de datos -->
                    <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Opciones:</th>
                            <th>Nombre:</th>
                            <th>Dirección:</th>
                            <th>Teléfono:</th>
                            <th>Área de Trabajo:</th>
                            <th>Usuario:</th>
                        </thead>
                        <tbody>
                            <!--Datos de la BD -->
                        </tbody>
                    </table><br>
                </div>
            </div>
            

            <!-- Row -->
            <div class="row" id="formempleado">
                <!-- Column 
                    <div class="col-lg-8 col-xlg-9 col-md-12">-->
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" id="frmempleado" name="frmempleado" class="form-horizontal form-material">

                                <!-- ------------------------ DATOS DEL EMPLEADO ------------------------ -->
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for=""><b>Nombre de la Persona:</b></label>
                                    <input type="hidden" name="id_usuario" id="id_usuario">
                                    <select class="form-control" selectpicker name="id_nombre_persona" id="id_nombre_persona" data-live-search="true" required=""></select>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="col-sm-12"><b>Puesto del Empleado:</b></label>
                                    <div class="col-sm-12 border-bottom">
                                        <select id="tipo_empleado" name="tipo_empleado" class="form-select shadow-none p-0 border-0 form-control-line">
                                            <option value="Administracion">Administración</option>
                                            <option value="Sistemas">Sistemas</option>
                                            <option value="Cajas">Cajas</option>
                                            <option value="Escaner">Escáner</option>
                                            <option value="Recorrido">Recorrido</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="nombre_usuario" class="col-md-12 p-0"><b>Nombre de Usuario:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="hidden" name="verifuser" id="verifuser">
                                        <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="ejemplo88" class="form-control p-0 border-0" required autocomplete="off">
                                    </div>
                                </div>
                                <!-- ------------------------ DATOS DEL EMPLEADO ------------------------ -->
                                <div class="form-group mb-4">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" id="btnguardar" class="btn btn-success btn-lg btn-block"><i class="fas fa-save"></i>&nbsp;Guardar Empleado</button>
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

        <script src="scripts/empleado.js"></script>
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
