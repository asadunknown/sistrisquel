<?php
    //session_start();
    if(isset($_SESSION['usuario']))
?>
<!DOCTYPE html>
<html dir="ltr" lang="es"> 

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description" content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Directorio de Corredores</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../public/plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link href="../public/plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="../public/css/style.min.css" rel="stylesheet">
    <link href="../public/css/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/plugins/sweetalert2/dist/sweetalert2.min.css"> 
    <link rel="stylesheet" type="text/css" href="../public/css/estilos.css">
    <!-- Columnas filas -->
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet" />
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/estilos.css">
    <!-- PushJS para notificaciones de escritorio -->
    

</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.php">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="../public/plugins/images/logo-icon-tris.png" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="">
                            <!-- dark Logo text -->
                            <img src="../public/plugins/images/logo-text-tris.png" alt="homepage" />
                        </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <!-- ============================================================== -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <li>
                                <style>
                                    .dropbtn {
                                        background-color: #31333e; color: white; padding: 16px;
                                        font-size: 16px; border: none;cursor: pointer;
                                    }

                                    .dropdown {
                                        position: relative; display: inline-block;
                                    }

                                    .dropdown-content {
                                        display: none; position: absolute;  right: 0;
                                        background-color: #31333e;  min-width: 200px;
                                        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                                        z-index: 1;
                                    }

                                    .dropdown-content a {
                                        color: white; padding: 12px 16px;
                                        text-decoration: none; display: block;
                                    }

                                    .dropdown-content a:hover {
                                        background-color: #0077b6;
                                    }

                                    .dropdown:hover .dropdown-content {
                                        display: block;
                                    }

                                    .dropdown:hover .dropbtn {
                                        background-color: #0077b6;
                                    }
                                </style>
                                <div class="dropdown" style="float:right;">
                                    <button class="dropbtn"><i class="fas fa-user"></i> <?php echo $_SESSION['usuario']['Nombre'] ?> </button>
                                    <input type="hidden" id="idusuariodisable" value="<?php echo $_SESSION['usuario']['id_usuario'] ?>">
                                     <input type="hidden" id="idpersonadisable" value="<?php echo $_SESSION['usuario']['id_persona'] ?>">
                                    <div class="dropdown-content">
                                        <a href="editarusuario.php" onclick="mostrarinfouser(<?php echo $_SESSION['usuario']['id_persona'] ?>)"><i class="fas fa-user-edit"></i>&nbsp; Editar mi información</a>
                                        <a href="editarcontrasena.php"><i class="fas fa-file-invoice"></i>&nbsp; Cambiar contraseña</a>
                                        <a href="#" onclick="cerrar_sesion();"><i class="fas fa-sign-out-alt"></i>&nbsp; Cerrar sesión</a>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <?php
                            if($_SESSION['usuario']['tipo_empleado'] == 'Administracion' || $_SESSION['usuario']['tipo_empleado'] == 'Sistemas')
                            { 
                                echo'<li class="sidebar-item pt-2">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php" aria-expanded="false">
                                            <i class="fas fa-home" aria-hidden="true"></i>
                                            <span class="hide-menu"><b>Panel de Inicio</b></span>
                                        </a>
                                     </li>
                                     <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="persona.php" aria-expanded="false">
                                <i class="fas fa-users" aria-hidden="true"></i>
                                <span class="hide-menu"><b>Personas</b></span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="corredor.php" aria-expanded="false">
                                <i class="fas fa-running" aria-hidden="true"></i>
                                <span class="hide-menu"><b>Corredores</b></span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="puntos_venta.php" aria-expanded="false">
                                <i class="fas fa-desktop" aria-hidden="true"></i>
                                <span class="hide-menu"><b>P. Venta y Recorridos</b></span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="empleado.php" aria-expanded="false">
                                <i class="fas fa-user-clock" aria-hidden="true"></i>
                                <span class="hide-menu"><b>Empleados</b></span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="recorrido.php" aria-expanded="false">
                                <i class="fas fa-biking" aria-hidden="true"></i>
                                <span class="hide-menu"><b>Recorridos</b></span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="asignacion_recorrido.php" aria-expanded="false">
                                <i class="fas fa-address-card" aria-hidden="true"></i>
                                <span class="hide-menu"><b>Asignación de Recorridos</b></span>
                            </a>
                        </li>';
                            }
                            else
                            {
                                echo'<li class="sidebar-item pt-2">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php" aria-expanded="false">
                                            <i class="fas fa-home" aria-hidden="true"></i>
                                            <span class="hide-menu"><b>Panel de Inicio</b></span>
                                        </a>
                                     </li>
                                     <li class="sidebar-item">
                                         <a class="sidebar-link waves-effect waves-dark sidebar-link" href="puntos_venta.php" aria-expanded="false">
                                             <i class="fas fa-desktop" aria-hidden="true"></i>
                                            <span class="hide-menu"><b>P. Venta y Recorridos</b></span>
                                         </a>
                                     </li>';
                            }
                        ?><br>
                        <li class="sidebar-item"><!-- 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" onclick="cerrar_sesion();" style="background-color: #d63031; color: #fff; height: 35px;" aria-expanded="false"><i class="fas fa-sign-out-alt" style="color: #fff;" aria-hidden="true"></i>Cerrar Sesión</a>
                             <a class="sidebar-link waves-effect waves-dark sidebar-link" href="login/cerrar_sesion.php" style="background-color: #d63031; color: #fff; height: 35px;" aria-expanded="false"><i class="fas fa-sign-out-alt" style="color: #fff;" aria-hidden="true"></i>Cerrar Sesión</a> -->
                        </li>

                        <!--
                        <li class="text-center p-20 upgrade-btn">
                            <a href="https://www.wrappixel.com/templates/ampleadmin/" class="btn d-grid btn-danger text-white" target="_blank">Upgrade to Pro</a> 
                        </li>-->

                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <script src="login/cerrar_sesion.js"></script>
        <script src="../public/pushjs/bin/push.min.js"></script>