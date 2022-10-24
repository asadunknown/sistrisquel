<?php 
    session_start(); 
    if(isset($_SESSION['usuario']))
    {
?>
<?php  include 'header.php';  ?>
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
                <h3 id="titulo" class="page-title">Panel de Inicio.</h3><!-- cambiar el nombre a "Listado de Corredores" con js -->
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="container-fluid" style="background-color: #eff1f3;">
        <!-- ============================================================== -->
        <!-- Three charts -->
        <!-- ============================================================== -->
        <!-- INICIO DIV OPCIONES ADMINS-->
        <?php if($_SESSION['usuario']['tipo_empleado'] == 'Administracion' || $_SESSION['usuario']['tipo_empleado'] == 'Sistemas') { ?>
        <div class="row justify-content-center">
            
            <link rel="stylesheet" href="../public/css/stylecard.css">
            
            <div class="container">
                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>01</h2>
                            <h3>Módulo de Personas</h3>
                            <a href="persona.php">Ingresar</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>02</h2>
                            <h3>Módulo de Corredores</h3>
                            <a href="corredor.php">Ingresar</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>03</h2>
                            <h3>P. Venta y Recorridos</h3>
                            <a href="puntos_venta.php" class="xd">Mostrar</a>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>04</h2>
                            <h3>Módulo de Empleados</h3>
                            <a href="empleado.php">Ingresar</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>05</h2>
                            <h3>Módulo de Recorridos</h3>
                            <a href="recorrido.php">Ingresar</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>06</h2>
                            <h3>Asignaciones Recorridos</h3>
                            <a href="asignacion_recorrido.php">Ingresar</a>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>07</h2>
                            <h3>Editar mi Información</h3>
                            <a href="editarusuario.php">Ingresar</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>08</h2>
                            <h3>Cambiar Contraseña</h3>
                            <a href="editarcontrasena.php">Ingresar</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>09</h2>
                            <h3>Salir del sistema</h3>
                            <!-- <a href="login/cerrar_sesion.php">Cerrar Sesión</a> -->
                            <a href="#" onclick="cerrar_sesion();">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                Push.create('Hello World!');
            </script>
        </div>
        <!-- FIN DIV OPCIONES ADMINS--> 
        
        <!-- INICIO DIV OPCIONES USUARIO-->
        <?php } else { ?>
        <div class="row justify-content-center">

            <link rel="stylesheet" href="../public/css/stylecardusr.css">
            <div class="container">

                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>01</h2>
                            <h3>P. Venta y Recorridos</h3>
                            <a href="puntos_venta.php" class="xd">Mostrar el Listado</a>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>02</h2>
                            <h3>Editar mi información</h3>
                            <a href="editarusuario.php">Ingresar</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>03</h2>
                            <h3>Cambiar mi contraseña</h3>
                            <a href="editarcontrasena.php">Ingresar</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <div class="content">
                            <h2>04</h2><br>
                            <h3>Salir de mi cuenta</h3>
                            <!-- <a href="login/cerrar_sesion.php">Cerrar Sesión</a> -->
                            <a href="#" onclick="cerrar_sesion();">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <?php } ?>
        <!-- FIN DIV OPCIONES USUARIO--> 
    </div>
    

    <?php  include 'footer.php';  ?>
    <?php 
    }
    else
    {
        header('Location: 404.php');
    }
?>