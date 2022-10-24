<?php  
//Requerir el archivo donde está la clase: Categoria.php
require_once '../modelos/Persona.php'; 
 
//Variable para guardar el objeto o clase
$persona = new Persona(); 

//Variables para insertar, editar, según la operación a realizar
$id_persona       = isset($_POST["id_persona"])?       limpiarCadena($_POST["id_persona"]):"";
$nombre           = isset($_POST["nombre"])?           limpiarCadena($_POST["nombre"]):"";
$apellido_paterno = isset($_POST["ap_paterno"])?       limpiarCadena($_POST["ap_paterno"]):"";
$apellido_materno = isset($_POST["ap_materno"])?       limpiarCadena($_POST["ap_materno"]):"";
$telefono         = isset($_POST["telefono"])?         limpiarCadena($_POST["telefono"]):"";
$veriftelefono    = isset($_POST["veriftelefono"])?    limpiarCadena($_POST["veriftelefono"]):"";
$fecha_nac        = isset($_POST["fecha_nac"])?        limpiarCadena($_POST["fecha_nac"]):"";
$direccion        = isset($_POST["direccion"])?        limpiarCadena($_POST["direccion"]):"";
$enlace_direccion = isset($_POST["enlace_direccion"])? limpiarCadena($_POST["enlace_direccion"]):"";
$comentarios      = isset($_POST["comentarios"])?      limpiarCadena($_POST["comentarios"]):"";
$fecha_registro   = date('Y-m-d');
$hora_registro    = date('H:i:s');

$nombre           = ucfirst($nombre);
$apellido_paterno = ucfirst($apellido_paterno);
$apellido_materno = ucfirst($apellido_materno);

$id_deshabilitar = isset($_GET["id"])? limpiarCadena($_GET["id"]):"";

//Estructura Switch para elegir los casos a ejecutar
switch ($_GET["op"]) 
{
 	case 'guardaryeditar':
        //-------------------------------------------------------------------------------------------------------------------
            if($nombre == "" || $apellido_paterno == "" || $apellido_materno == "" || $telefono == "" || $direccion == "" || $enlace_direccion == "")
            {
                echo 3;
            }
            else
            {
                $sql = "SELECT telefono FROM personas WHERE telefono = '$telefono'";
                $resultado = mysqli_query($conexion, $sql);
                
                if(mysqli_num_rows($resultado) > 0)
                {
                    echo 2;
                }
                else
                {
                    $sql = "INSERT INTO personas(nombre, apellido_paterno, apellido_materno, telefono, direccion, enlace_direccion, fecha_nac, comentarios, fecha_registro, hora_registro) VALUES('$nombre', '$apellido_paterno', '$apellido_materno', '$telefono', '$direccion', '$enlace_direccion', '$fecha_nac', '$comentarios', '$fecha_registro', '$hora_registro')";
                    echo mysqli_query($conexion, $sql);
                }
            }
        //-------------------------------------------------------------------------------------------------------------------
 		break;
        
    case 'soloeditar': 
        $sql = "SELECT telefono FROM personas WHERE telefono = '$telefono' AND telefono != '$veriftelefono'";
        $fila_nocorredor = mysqli_query($conexion, $sql);

        if(mysqli_num_rows($fila_nocorredor) > 0)
        {
            echo 2;
        } 
        else
        {
            $sql = "UPDATE personas SET nombre = '$nombre', apellido_paterno = '$apellido_paterno', apellido_materno = '$apellido_materno', telefono = '$telefono', direccion = '$direccion', enlace_direccion = '$enlace_direccion', fecha_nac = '$fecha_nac', comentarios = '$comentarios', fecha_registro = '$fecha_registro', hora_registro = '$hora_registro' WHERE id_persona = '$id_persona'";
	        echo mysqli_query($conexion, $sql);
        }
    break;
 	
    case 'eliminar':
 		$rspta=$persona->eliminar($id_persona);
 		echo $rspta? "Persona eliminada" : "La Persona no se pudo eliminar";
 		break;
    
    case 'mostrar':
 		$rspta=$persona->mostrar($id_persona);
 		//Codificamos el resultado utilizando json
 		echo json_encode($rspta);
 		break;
        
 	case 'listarPersona':
 		//Apuntamos al método listar()
 		$rspta = $persona->listarPersona();
 		//Declaramos un arreglo
 		$data = Array();

 		//Recoremos el arreglo con el ciclo while
 		while ($reg=$rspta->fetch_object()) {
            if($id_deshabilitar == $reg->id_persona)
            {
                $deshabilitar = "disabled";
            }
            else
            {
                $deshabilitar = "";
            }
 			$data[]= array(
				"0"=>'<button class="btn btn-primary" style="background-color: #0582ca;" onclick="mostrar('.$reg->id_persona.')"> <i class="fas fa-pen"></i> </button>'. ' <button id="btneliminarp" value="'.$reg->id_persona.'" class="btn btn-danger" style="color: white;" onclick="eliminar('.$reg->id_persona.')" '.$deshabilitar.'> <i class="fas fa-times"></i> </button>', //id_persona se reemplaza por botones 
 				"1"=>$reg-> Nombre,
 				"2"=>$reg-> telefono,
 				"3"=>'<a href="'.$reg->enlace_direccion.'" target="_blank">'.$reg->direccion.'</a>',
 				"4"=>$reg-> fecha_nac,
 				"5"=>$reg-> comentarios
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
}




?>