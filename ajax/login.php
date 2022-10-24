<?php
//".$_POST['usuariolg']." 


//condición para asegurar que la petición que llega del archivo de logueo es una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
    //require para tomar los datos de la conexion y ejecutar consultas
    require '../config/conection.php';
    
    //Variable para uasr sessiones para los usuarios (inicia la session)
    session_start();    
    
    //UTF8 para validar los caracteres que se tomarán para validarse
    $mysqli->set_charset('utf8'); 
    
    //funciones real_escape_string para escapar de cualquier caracter especial que pueda traer los campos de texto
    $user = $mysqli->real_escape_string($_POST['usuariolg']); 
    $pass = $mysqli->real_escape_string($_POST['passlg']); 
    
    $passhash = hash("SHA256", $pass);
    
    if($nueva_consulta = $mysqli->prepare("SELECT usuario.id_usuario, persona.id_persona, CONCAT(persona.nombre, ' ', persona.apellido_paterno,' ', persona.apellido_materno) AS Nombre, persona.nombre, persona.apellido_paterno, persona.apellido_materno, persona.telefono, persona.direccion, persona.enlace_direccion, usuario.nombre_usuario, usuario.tipo_empleado FROM usuarios usuario INNER JOIN personas persona ON persona.id_persona = usuario.id_persona WHERE nombre_usuario = ? and contrasena = ?")) 
    {
        $nueva_consulta->bind_param('ss', $user, $passhash);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();
        
        if($resultado->num_rows == 1)
        {
            //arreglo asociativo con los datos del usuario
            $datos = $resultado->fetch_assoc();
            //variable de sesion para usar en el sistema
            $_SESSION['usuario'] = $datos;
            
            echo json_encode(array('error' => false, 'tipo' => $datos['tipo_empleado']));
        }
        else
        {
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }
    
}

$mysqli->close();

?>




















