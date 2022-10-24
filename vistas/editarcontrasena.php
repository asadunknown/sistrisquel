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
                    <h3 id="titulo" class="page-title">Actualizar mi Contraseña:</h3>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">

            <div class="row" id="formeditpass">
                <!-- Column 
                    <div class="col-lg-8 col-xlg-9 col-md-12">-->
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" id="frmeditpass" name="frmeditpass" class="form-horizontal form-material">

                                <div class="form-group mb-4">
                                    <label for="contrasena" class="col-md-12 p-0" id="txtcontrasena">Nueva Contraseña</label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="hidden" name="no_user" id="no_user" value="<?php echo $_SESSION['usuario']['id_usuario'] ?>">
                                        <input type="password" id="contrasena" name="contrasena" placeholder="••••••" class="form-control p-0 border-0 letrasspace" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="confirmarcontrasena" class="col-md-12 p-0" id="txtcontrasena">Confirmar Contraseña</label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="password" id="confirmarcontrasena" name="confirmarcontrasena" placeholder="••••••" class="form-control p-0 border-0 letrasspace" required autocomplete="off">
                                    </div>
                                </div>
                                
                                <div class="form-group mb-4">
                                     <label class="text"><input type="checkbox" id="ver" class="ver" onChange="showpass()"> Mostrar contraseña</label>
                                </div>

                                <div class="form-group mb-4">
                                    <div class="col-md-12 col-sm-12 col-xs-12"> 
                                        <button type="submit" id="btnguardareditpass" class="btn btn-success btn-lg btn-block"><i class="fas fa-cloud-upload-alt"></i>&nbsp;Actualizar Contraseña</button>
                                        <button type="button" id="btncancelar" style="color: white;" class="btn btn-danger btn-lg btn-block" onclick="cancelarformpsw();">Cancelar</button>

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