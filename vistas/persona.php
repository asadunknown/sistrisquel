<?php 
    session_start(); 
    if(isset($_SESSION['usuario']))
    {
        if($_SESSION['usuario']['tipo_empleado'] == 'Administracion' || $_SESSION['usuario']['tipo_empleado'] == 'Sistemas')
        {
?>
<?php include 'header.php';  ?>

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
                    <h3 id="titulo" class="page-title">Agregar nueva Persona.</h3><!-- cambiar el nombre a "Listado de Corredores" con js -->
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <button class="btn btn-info blancobold" id="btnlistapersona" onclick="mostrarlistado();">Mostrar Listado</button>
                    <button class="btn btn-info blancobold" id="btnnuevapersona" onclick="mostrarformulario();">Agregar Persona</button>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

            <div class="card" id="tbllistpersona" style="border: 1px solid">
                <div class="panel-body table-responsive" id="listadoregistros" style="margin: 5px;"><br>
                    <!--Tabla de datos -->
                    <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                                <th>Opciones:</th>
                                <th>Nombre:</th>
                                <th>Teléfono:</th>
                                <th>Dirección:</th>
                                <th>Fecha de Nacimiento:</th>
                                <th>Comentarios:</th>
                        </thead>
                        <tbody>
                            <!--Datos de la BD -->
                        </tbody>
                    </table><br>
                </div>
            </div>

            <!-- Row -->
            <div class="row" id="formpersona">
                <!-- Column 
                    <div class="col-lg-8 col-xlg-9 col-md-12">-->
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" id="frmpersona" name="frmpersona" class="form-horizontal form-material">

                                <!-- ------------------------ NOMBRE Y APELLIDOS ------------------------ -->
                                <div class="form-group mb-4">
                                    <label for="nombre" class="col-md-12 p-0"><b>Nombre(s):</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="hidden" name="id_persona" id="id_persona">
                                        <input type="text" id="nombre" name="nombre" class="form-control p-0 border-0 sololetras" required placeholder="Jeimy" autocomplete="off" autofocus>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="ap_paterno" class="col-md-12 p-0"><b>Apellido Paterno:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="text" id="ap_paterno" name="ap_paterno" placeholder="Díaz" onkeypress="" class="form-control p-0 border-0 sololetras" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="ap_materno" class="col-md-12 p-0"><b>Apellido Materno:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="text" id="ap_materno" name="ap_materno" placeholder="Pérez" onkeypress="" class="form-control p-0 border-0 sololetras" required autocomplete="off">
                                    </div>
                                </div>
                                <!-- ------------------------ NOMBRE Y APELLIDOS ------------------------ -->

                                <!-- ------------------------ NUMERO DE TELEFONO ------------------------ -->
                                <div class="form-group mb-4">
                                    <label for="telefono" class="col-md-12 p-0"><b>Número de Teléfono:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="hidden" name="veriftelefono" id="veriftelefono">
                                        <input type="text" maxlength="10" id="telefono" name="telefono" placeholder="123 456 7890" onkeypress="" class="form-control p-0 border-0 solonumeros " required autocomplete="off">
                                    </div>
                                </div>
                                <!-- ------------------------ NUMERO DE TELEFONO ------------------------ -->

                                <!-- ------------------------ DIERECCION  FISICA ------------------------ -->
                                <div class="form-group mb-4">
                                    <label for="direccion" class="col-md-12 p-0"><b>Dirección:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="text" id="direccion" name="direccion" placeholder="Calle Girasol #404, Zaragoza, Montemorelos, NL" onkeypress="" class="form-control p-0 border-0" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="enlace_direccion" class="col-md-12 p-0"><b>Enclace de la Dirección:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="text" id="enlace_direccion" name="enlace_direccion" placeholder="https://www.google.com/maps/@25.184,-99.108,20.39z" onkeypress="" class="form-control p-0 border-0" required>
                                    </div>
                                </div>
                                <!-- ------------------------ DIERECCION  FISICA ------------------------ -->
                                
                                <!-- ----------------------  FECHA DE NACIMIENTO     ---------------- ---- -->
                                <div class="form-group mb-4">
                                    <label for="fecha_nac" class="col-md-12 p-0"><b>Fecha de Nacimiento:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="date" id="fecha_nac" name="fecha_nac" class="form-control p-0 border-0" required>
                                    </div>
                                </div>
                                <!-- ----------------------  FECHA DE NACIMIENTO     -------------------- -->
                                
                                <!-- ------------------------    COMENTARIOS     ------------------------ -->
                                <div class="form-group mb-4">
                                    <label for="comentarios" class="col-md-12 p-0"><b>Comentarios:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <textarea rows="2" id="comentarios" name="comentarios" onkeydown="" class="form-control p-0 border-0" required autocomplete="off"></textarea>
                                    </div>
                                </div>
                                <!-- ------------------------    COMENTARIOS     ------------------------ -->

                                <div class="form-group mb-4">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" id="btnguardar" onclick="campos_llenos();" class="btn btn-success btn-lg btn-block"><i class="fas fa-save"></i>&nbsp;Guardar Persona</button>
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


        <script src="scripts/persona.js"></script>
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
      
     
    
   
  
 


















