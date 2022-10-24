<?php 
    session_start(); 
    if(isset($_SESSION['usuario']))
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
                    <h3 id="titulo" class="page-title">Listado de Todos los Corredores:</h3><!-- cambiar el nombre a "Listado de Corredores" con js -->
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <div style="background-color: #fff; margin-top: -10px;">
            
            <div class="form-group mb-4"  style="background-color: #fff; margin: 10px;">
                
                <br><h4><b>Seleccione el número de Recorrido o Puntos de Venta:</b></h4>
                <div class="col-sm-12 border-bottom">
                    <select id="num_recorrido" name="num_recorrido" class="form-select shadow-none p-0 border-0 form-control-line">
                        
                    </select>
                </div>
            </div>
            
<!-- ========================================================================================================================================= -->
            <div class="card" id="tbllistpuntoventa" style="border: 1px solid;">
                <div class="panel-body table-responsive" id="listadoregistros" style="margin: 5px;"><br>
                    <!--Tabla de datos -->
                    <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>No. Corredor:</th>
                            <th>Nombre:</th>
                            <th>Dirección:</th> 
                            <th>Teléfono:</th>
                            <th>TeamViewer:</th>
                            <th>AnyDesk:</th>
                        </thead>
                        <tbody>
                            <!--Datos de la BD -->
                        </tbody>
                    </table><br>
                </div>
            </div>
<!-- ========================================================================================================================================= -->
            <div class="card" id="tbllistrecorridosX" style="border: 1px solid;">
                <div class="panel-body table-responsive" id="listadoregistros" style="margin: 5px;"><br>
                    <!--Tabla de datos -->
                    <table id="tbllistadorecX" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>No. Corredor:</th>
                            <th>Nombre:</th>
                            <th>Dirección:</th> 
                            <th>Teléfono:</th>
                            <th>No. Recorrido:</th>
                        </thead>
                        <tbody>
                            <!--Datos de la BD -->
                        </tbody>
                    </table><br>
                </div>
            </div>
<!-- ========================================================================================================================================= -->
<div class="card" id="tbllisttodoscorr" style="border: 1px solid;">
                <div class="panel-body table-responsive" id="listadoregistros" style="margin: 5px;"><br>
                    <!--Tabla de datos -->
                    <table id="tbllistadotodoscorr" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
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
<!-- ========================================================================================================================================= -->
           </div>
        </div>
        <?php  include 'footer.php';  ?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->


        <script src="scripts/puntos_venta.js"></script>
        <script src="scripts/general.js"></script>


<?php 
    }
    else
    {
        header('Location: 404.php');
    }
?>