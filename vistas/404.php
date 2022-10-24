<?php
    session_start();
?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Ample Admin Lite Template by WrapPixel</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../public/plugins/images/favicon.png">
    <!-- Custom CSS -->
   <link href="../public/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="error-box">
            <div class="error-body text-center">
                <h1 class="error-title text-danger">404</h1>
                <h3 class="text-uppercase error-subtitle">PAGINA NO ENCONTRADA!</h3>
                
                <?php
                    if(isset($_SESSION['usuario']))
                    {
                        echo'<p class="text mt-4 mb-4">Esta Página no Existe o no tiene Autorización!</p>';
                        echo'<a href="dashboard.php" class="btn btn-danger btn-rounded waves-effect waves-light mb-5 text-white">Regresar al Inicio</a>';
                    }
                    else
                    {
                        echo'<p class="text mt-4 mb-4">No tiene Autorización para esta Página, por favor Inicie Sesión!</p>';
                        echo'<a href="login/cerrar_sesion.php" class="btn btn-danger btn-rounded waves-effect waves-light mb-5 text-white">Iniciar Sesión</a>';
                    }
                ?>
                <!--
                <a href="dashboard.php" class="btn btn-danger btn-rounded waves-effect waves-light mb-5 text-white">Regresar al Inicio</a>
                <a href="login/cerrar_sesion.php" class="btn btn-danger btn-rounded waves-effect waves-light mb-5 text-white">Iniciar Sesión</a>-->
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <script src="../public/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(".preloader").fadeOut();
    </script>
</body>
</html>