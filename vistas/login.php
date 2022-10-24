<?php
session_start();
if(isset($_SESSION['usuario']))
{
    if($_SESSION['usuario']['tipo_empleado'] == 'Administracion' || $_SESSION['usuario']['tipo_empleado'] == 'Sistemas')
    {
        header('Location: dashboard.php');
    }
    else
    {
        header('Location: dashboard.php');
        header('Location: dashboard.php');
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <title>Directorio de Corredores</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/plugins/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="login/css/style.css">

</head> 

<body style="background-color: #ff793f;">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <!--<h1 class=""><b>TRI$QUEL S.A de C.V.</b></h1>-->
                    <?php  include 'login/styletittle.html';  ?>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                            <div class="text w-100">
                                <h2>Bienvenido a Trisquel</h2>
                                <p>Somos una empresa formada hace más de 15 años, que ha sido solidaria con al cominidad Linarense, satisfaciendo las necesidades económicas de nuestros clientes; trabajando mano a mano con nuestra familia, esmerándonos en el respeto y en el cumplimiento de nuestros compromisos económicos, sociales y siempre ayudando al necesitado.</p>
                            </div>
                        </div>
                        <div class="login-wrap p-4 p-lg-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4" style="font-weight: bold;">Iniciar sesión en el sistema</h3>
                                </div>
                            </div>
                            <form id="formlg" method="" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label" for="usuariolg">Nombre de Usuario:</label>
                                    <input type="text" name="usuariolg" class="form-control" placeholder="usuario" required pattern="[A-Za-z0-9_-]{1,20}" autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="passlg">Contraseña:</label>
                                    <input type="password" name="passlg" class="form-control" placeholder="contraseña" required pattern="[A-Za-z0-9_-]{1,20}">
                                </div>
                                <div class="form-group">
                                    <!--<button type="submit" class="form-control btn btn-primary submit px-3">Ingresar</button>-->
                                    <input type="submit" id="botonlg" class="form-control btn btn-primary submit px-3" value="Iniciar  Sesión">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="login/js/jquery.min.js"></script>
    <script src="login/js/popper.js"></script>
    <script src="login/js/bootstrap.min.js"></script>
    <script src="login/js/main.js"></script>
    <script src="scripts/login.js"></script>
    
    <script src="../public/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../public/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    

</body>

</html>


















