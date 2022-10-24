<?php 
//Requerir el archivo donde está la clase: Categoria.php
require_once '../modelos/Asignacion_Recorrido.php';   

//Variable para guardar el objeto o clase
$asignacion = new Asignacion(); 

//Variables para insertar, editar, según la operación a realizar 
$id_asignacion_recorrido = isset($_POST["id_asignacion_recorrido"])? limpiarCadena($_POST["id_asignacion_recorrido"]):"";
$id_corredorPer          = isset($_POST["id_corredorPer"])?          limpiarCadena($_POST["id_corredorPer"]):"";
$verifidcorrper          = isset($_POST["verifidcorrper"])?          limpiarCadena($_POST["verifidcorrper"]):"";
$id_recorrido            = isset($_POST["id_recorrido"])?            limpiarCadena($_POST["id_recorrido"]):"";
$verifidrecorrido        = isset($_POST["verifidrecorrido"])?        limpiarCadena($_POST["verifidrecorrido"]):"";

/*$fecha_registro  = date('Y-m-d');
$hora_registro   = date('H:i:s');*/

//Estructura Switch para elegir los casos a ejecutar
switch ($_GET["op"]) 
{
 	case 'guardaryeditar':
        if($id_corredorPer == "" || $id_recorrido == "")
        {
            echo 3;
        }
        else
        {
            $sql = "SELECT id_corredor, id_recorrido FROM asignacion_recorrido WHERE id_corredor = '$id_corredorPer' AND id_recorrido = '$id_recorrido'";
            $filas_anydesk = mysqli_query($conexion, $sql);

            if(mysqli_num_rows($filas_anydesk) > 0)
            {
                echo 2;
            }
            else
            {
                $sql ="INSERT INTO asignacion_recorrido(id_recorrido, id_corredor) VALUES('$id_recorrido', '$id_corredorPer')";
                echo mysqli_query($conexion, $sql);
            }
        }
        
    break;
        
    case 'soloeditar':  
        
            $sql = "SELECT * FROM asignacion_recorrido WHERE
            
            id_recorrido = '$id_recorrido' AND 
            id_recorrido != '$verifidrecorrido' AND 
            id_corredor = '$id_corredorPer'
            
            ";
        
        
            $filas_anydesk = mysqli_query($conexion, $sql);

            if(mysqli_num_rows($filas_anydesk) > 0)
            {
                echo 2;
            }
            else
            {
                $sql="UPDATE asignacion_recorrido SET id_recorrido = '$id_recorrido', id_corredor = '$id_corredorPer' WHERE id_asignacion_recorrido = '$id_asignacion_recorrido'";
                echo mysqli_query($conexion, $sql);        
            }
 		break;
 	
    case 'eliminar':
 		$rspta=$asignacion->eliminar($id_asignacion_recorrido);
 		echo $rspta? "Corredor eliminado" : "El Corredor no se pudo eliminar";
 		break;
 	
    case 'mostrar':
 		$rspta=$asignacion->mostrar($id_asignacion_recorrido);
 		//Codificamos el resultado utilizando json
 		echo json_encode($rspta);
 		break;
        
 	case 'listarAsignaciones':
 		//Apuntamos al método listar()
 		$rspta = $asignacion->listarAsignaciones();
 		//Declaramos un arreglo
 		$data = Array();

 		//Recoremos el arreglo con el ciclo while
 		while ($reg=$rspta->fetch_object()) {
 			$data[]= array(
				"0"=>'<button class="btn btn-primary" style="background-color: #0582ca;" onclick="mostrar('.$reg->id_asignacion_recorrido.')"> <i class="fas fa-pen"></i> </button>'. ' <button class="btn btn-danger" style="color: white;" onclick="eliminar('.$reg->id_asignacion_recorrido.')"> <i class="fas fa-times"></i> </button>', //id_corredor se reemplaza por botones
 				"1"=>$reg-> numero_corredor,
 				"2"=>$reg-> Nombre,
 				"3"=>'Recorrido #'.$reg-> num_recorrido
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
        
    case 'select_corredorPer':
 		//hacemos referencia al modelo persona
 		require_once "../modelos/Persona.php";
 		$persona = new Persona();
 		$rspta =  $persona->select_corredorPer();

 		//Recorremos los registros con un while
 		while ($reg = $rspta->fetch_object()) 
 		{
 			echo '<option value = '.$reg->id_corredor.'>'.$reg->Nombre.'</option>';
 		}

 	break;
        
    case 'select_recorrido':
 		//hacemos referencia al modelo recorrido
 		require_once "../modelos/Persona.php";
 		$persona = new Persona();
 		$rspta =  $persona->select_recorrido();

 		//Recorremos los registros con un while
 		while ($reg = $rspta->fetch_object()) 
 		{
 			echo '<option value = '.$reg->id_recorrido.'>'.$reg->nombre.'</option>';
 		}

 	break;
}




?>