<?php 
    session_start(); 
    if(isset($_SESSION['usuario']))
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
                    <h3 id="titulo" class="page-title">Editar mi Información Personal.</h3>
                </div>
                <!--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <button class="btn btn-info" id="btnlistaempleado" onclick="mostrarlistado();">Mostrar Lista de Empleados</button>
                    <button class="btn btn-info" id="btnnuevoempleado" onclick="mostrarformulario();">Agregar Nuevo Empleado</button>
                </div>-->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">
           
            <div class="row" id="formeditinfo">
                <!-- Column 
                    <div class="col-lg-8 col-xlg-9 col-md-12">-->
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" id="frmeditinfo" name="frmeditinfo" class="form-horizontal form-material">
                                <!-- ------------------------ NOMBRE Y APELLIDOS ------------------------ -->
                                <div class="form-group mb-4">
                                    <label for="nombre" class="col-md-12 p-0"><b>Nombre(s):</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                       <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['usuario']['id_usuario'] ?>">
                                        <input type="hidden" name="id_person" id="id_person" value="<?php echo $_SESSION['usuario']['id_persona'] ?>">
                                        
                                        <input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION['usuario']['nombre'] ?>" class="form-control p-0 border-0 sololetras" required placeholder="Jeimy" autocomplete="off" autofocus>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="ap_paterno" class="col-md-12 p-0"><b>Apellido Paterno:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="text" id="ap_paterno" name="ap_paterno" value="<?php echo $_SESSION['usuario']['apellido_paterno'] ?>" placeholder="Díaz" onkeypress="" class="form-control p-0 border-0 letrasspace" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="ap_materno" class="col-md-12 p-0"><b>Apellido Materno:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="text" id="ap_materno" name="ap_materno" value="<?php echo $_SESSION['usuario']['apellido_materno'] ?>" placeholder="Pérez" onkeypress="" class="form-control p-0 border-0 letrasspace"  required autocomplete="off">
                                    </div>
                                </div>
                                <!-- ------------------------ NOMBRE Y APELLIDOS ------------------------ -->

                                <!-- ------------------------ NUMERO DE TELEFONO ------------------------ -->
                                <div class="form-group mb-4">
                                    <label for="telefono" class="col-md-12 p-0"><b>Número de Teléfono:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="hidden" name="veriftel" id="veriftel" value="<?php echo $_SESSION['usuario']['telefono'] ?>">
                                        <input type="text" maxlength="10" id="telefono" name="telefono" value="<?php echo $_SESSION['usuario']['telefono'] ?>" placeholder="123 456 7890" onkeypress="" class="form-control p-0 border-0 solonumeros" required autocomplete="off">
                                    </div>
                                </div>
                                <!-- ------------------------ NUMERO DE TELEFONO ------------------------ -->

                                <!-- ------------------------ DIERECCION  FISICA ------------------------ -->
                                <div class="form-group mb-4">
                                    <label for="direccion" class="col-md-12 p-0"><b>Dirección:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="text" id="direccion" name="direccion" value="<?php echo $_SESSION['usuario']['direccion'] ?>" placeholder="Calle Girasol #404, Zaragoza, Montemorelos, NL" onkeypress="" class="form-control p-0 border-0" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="enlace_direccion" class="col-md-12 p-0"><b>Enlace de la Dirección:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="text" id="enlace_direccion" name="enlace_direccion" value="<?php echo $_SESSION['usuario']['enlace_direccion'] ?>" placeholder="https://www.google.com/maps/@25.184,-99.108,20.39z" onkeypress=""  class="form-control p-0 border-0"  required>
                                    </div>
                                </div>
                                <!-- ------------------------ DIERECCION  FISICA ------------------------ -->

                                <!-- ------------------------ DATOS DEL CORREDOR verifuser------------------------ -->

                                <div class="form-group mb-4">
                                    <label for="nombre_usuario" class="col-md-12 p-0"><b>Nombre de Usuario:</b></label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="hidden" name="verifuser" id="verifuser" value="<?php echo $_SESSION['usuario']['nombre_usuario'] ?>">
                                        <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo $_SESSION['usuario']['nombre_usuario'] ?>" placeholder="ejemplo88" class="form-control p-0 border-0" required autocomplete="off">
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label class="col-sm-12"><b>Puesto de Trabajo:</b></label>
                                    <div class="col-sm-12 border-bottom">
                                        <select id="tipo_empleado" name="tipo_empleado" class="form-select shadow-none p-0 border-0 form-control-line" disabled>
                                            <option value="<?php echo $_SESSION['usuario']['tipo_empleado'] ?>"><?php echo $_SESSION['usuario']['tipo_empleado'] ?></option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ------------------------ DATOS DEL EMPLEADO ------------------------ -->

                                <div class="form-group mb-4">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" id="btnguardaredituser" class="btn btn-success btn-lg btn-block"><i class="fas fa-cloud-upload-alt"></i>&nbsp;Actualizar Datos</button>
                                        <button type="button" id="btncancelar" style="color: white;" class="btn btn-danger btn-lg btn-block" onclick="cancelarformuser();">Cancelar</button>
                                        
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
        
        <script src="scripts/infouser.js"></script>
        <script src="scripts/general.js"></script>

<?php 
    }
    else
    {
        header('Location: 404.php');
    }
?>