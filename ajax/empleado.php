<?php 
//Requerir el archivo donde está la clase: Empleado.php
require_once '../modelos/Empleado.php';   

//Variable para guardar el objeto o clase
$empleado = new Empleado();

//Variables para insertar, editar, según la operación a realizar (INFORMACION DE PEROSNA EN USUARIO)
$id_person   = isset($_POST["id_person"])?        limpiarCadena($_POST["id_person"]):"";
$nombre      = isset($_POST["nombre"])?           limpiarCadena($_POST["nombre"]):"";
$ap_paterno  = isset($_POST["ap_paterno"])?       limpiarCadena($_POST["ap_paterno"]):"";
$ap_materno  = isset($_POST["ap_materno"])?       limpiarCadena($_POST["ap_materno"]):"";
$telefono    = isset($_POST["telefono"])?         limpiarCadena($_POST["telefono"]):"";
$veriftel    = isset($_POST["veriftel"])?         limpiarCadena($_POST["veriftel"]):"";
$direccion   = isset($_POST["direccion"])?        limpiarCadena($_POST["direccion"]):"";
$e_direccion = isset($_POST["enlace_direccion"])? limpiarCadena($_POST["enlace_direccion"]):"";

$id_deshabilitar = isset($_GET["id"])? limpiarCadena($_GET["id"]):"";

//Variables para insertar, editar, según la operación a realizar (USUARIOS)
$id_usuario          = isset($_POST["id_usuario"])?          limpiarCadena($_POST["id_usuario"]):"";
$id_persona          = isset($_POST["id_nombre_persona"])?   limpiarCadena($_POST["id_nombre_persona"]):"";
$tipo_empleado       = isset($_POST["tipo_empleado"])?       limpiarCadena($_POST["tipo_empleado"]):""; 
$nombre_usuario      = isset($_POST["nombre_usuario"])?      limpiarCadena($_POST["nombre_usuario"]):"";
$verifuser           = isset($_POST["verifuser"])?           limpiarCadena($_POST["verifuser"]):"";
$no_user             = isset($_POST["no_user"])?             limpiarCadena($_POST["no_user"]):"";
$contrasena          = isset($_POST["contrasena"])?          limpiarCadena($_POST["contrasena"]):"";
$confirmarcontrasena = isset($_POST["confirmarcontrasena"])? limpiarCadena($_POST["confirmarcontrasena"]):"";
$fecha_registro      = date('Y-m-d');
$hora_registro       = date('H:i:s');

$nombre_usuario = strtolower($nombre_usuario);

$contrasenadefecto = hash("SHA256", '12345');
$passhash  = hash("SHA256", $contrasena);
$passhash2 = hash("SHA256", $confirmarcontrasena);

//Estructura Switch para elegir los casos a ejecutar 
switch ($_GET["op"]) 
{
 	case 'guardaryeditar':
        if($tipo_empleado == "" || $nombre_usuario == "")
        {
            echo 3;
        }
        else
        {
            $sql = "SELECT nombre_usuario FROM usuarios WHERE nombre_usuario = '$nombre_usuario'";
            $resultado = mysqli_query($conexion, $sql);

            if(mysqli_num_rows($resultado) > 0)
            {
                echo 2;
            }
            else
            {
                $sql = "INSERT INTO usuarios(id_persona, nombre_usuario, contrasena, tipo_empleado, fecha_registro, hora_registro) 
                VALUES ('$id_persona', '$nombre_usuario', '$contrasenadefecto', '$tipo_empleado', '$fecha_registro', '$hora_registro')";
                echo mysqli_query($conexion, $sql);
            }
        }
    break;
        
    case 'soloeditar':
        $sql = "SELECT nombre_usuario FROM usuarios WHERE nombre_usuario = '$nombre_usuario' AND nombre_usuario != '$verifuser'";
        $fila_nocorredor = mysqli_query($conexion, $sql);

        if(mysqli_num_rows($fila_nocorredor) > 0)
        {
            echo 2;
        }
        else
        {
            $sql="UPDATE usuarios SET id_persona = '$id_persona', nombre_usuario = '$nombre_usuario', tipo_empleado = '$tipo_empleado', fecha_registro = '$fecha_registro', hora_registro = '$hora_registro' WHERE id_usuario = '$id_usuario'";
	       echo mysqli_query($conexion, $sql);
        }
    break;
        
    case 'actualizarpass':
        if($contrasena == "" || $confirmarcontrasena == "")
        {
            echo 2;
        }
        else
        {
            if($contrasena != $confirmarcontrasena)
            {
                echo 3;
            }
            else
            {
                if(strlen($contrasena) <= 5 || strlen($confirmarcontrasena) <= 5)
                {
                    echo 4;
                }
                else
                {
                    $sql="UPDATE usuarios SET contrasena = '$passhash' WHERE id_usuario = '$no_user'";
                    echo mysqli_query($conexion, $sql);
                }
            }
        }
    break;
        
    case 'actualizaruser':
        $sql = "SELECT nombre_usuario FROM usuarios WHERE nombre_usuario = '$nombre_usuario' AND nombre_usuario != '$verifuser'";
        $fila_nocorredor = mysqli_query($conexion, $sql);
        if(mysqli_num_rows($fila_nocorredor) > 0)
        {
            echo 2;
        }
        else
        {
            $sql = "SELECT telefono FROM personas WHERE telefono = '$telefono' AND telefono != '$veriftel'";
            $fila_nocorredor = mysqli_query($conexion, $sql);
            if(mysqli_num_rows($fila_nocorredor) > 0)
            {
                echo 3;
            }
            else
            {
                $sql = "UPDATE personas INNER JOIN usuarios ON usuarios.id_persona = personas.id_persona SET personas.nombre = '$nombre', personas.apellido_paterno = '$ap_paterno', personas.apellido_materno = '$ap_materno', personas.telefono = '$telefono', personas.direccion = '$direccion', personas.enlace_direccion = '$e_direccion', usuarios.nombre_usuario = '$nombre_usuario' WHERE personas.id_persona = '$id_person'";
                echo mysqli_query($conexion, $sql);
            }
        }
    break;   
        
        
        
    case 'eliminar':
 		$rspta=$empleado->eliminar($id_usuario);
 		echo $rspta? "Corredor eliminado" : "El Corredor no se pudo eliminar";
    break;
 	
    case 'mostrar':
 		$rspta=$empleado->mostrar($id_usuario);
 		//Codificamos el resultado utilizando json
 		echo json_encode($rspta);
    break;
        
 	case 'listarEmpleado':
 		//Apuntamos al método listar()
 		$rspta = $empleado->listarEmpleado();
 		//Declaramos un arreglo
 		$data = Array();

 		//Recoremos el arreglo con el ciclo while 
 		while ($reg=$rspta->fetch_object()) {
            if($id_deshabilitar == $reg->id_usuario)
            {
                $deshabilitar = "disabled";
            }
            else
            {
                $deshabilitar = "";
            }
 			$data[]= array(
				"0"=>'<button class="btn btn-primary" style="background-color: #0582ca;" onclick="mostrar('.$reg->id_usuario.')"> <i class="fas fa-pen"></i> </button>'. ' <button class="btn btn-danger" style="color: white;" onclick="eliminar('.$reg->id_usuario.')" '.$deshabilitar.' > <i class="fas fa-times"></i> </button>', //id_usuario se reemplaza por botones
 				"1"=>$reg-> Nombre,
 				"2"=>'<a href="'.$reg->enlace_direccion.'" target="_blank">'.$reg->direccion.'</a>',
 				"3"=>$reg-> telefono,
 				"4"=>$reg-> tipo_empleado,
 				"5"=>$reg-> nombre_usuario
 			);
 		}
 		//Arreglo para manipular la información en el datatable
 		$results= array(
 			"sEcho"=>1,//Información para el datatable
 			"iTotalRecords"=>count($data), //Enviamos el total de registros al datatable
 			"iTotalDisplayRecords"=> count($data), //Enviamos el total de registros a visualizar en el datatable
 			"aaData"=>$data);
 		echo json_encode($results);
 	break;
        
    case 'select_idnombrepersona':
 		//hacemos referencia al modelo persona
 		require_once "../modelos/Persona.php";
        
 		$persona = new Persona();
 		$rspta = $persona->selectEmpleado($id_usuario);

 		//Recorremos los registros con un while
 		while ($reg = $rspta->fetch_object()) 
 		{
 			echo '<option value = '.$reg->id_persona.'>'.$reg->Nombre.'</option>';
 		}
 	break;
        
}
?>






















