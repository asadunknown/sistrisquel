<?php 
//Requerir el archivo donde está la clase: Categoria.php
require_once '../modelos/Recorrido.php';   

//Variable para guardar el objeto o clase
$recorrido = new Recorrido();

//Variables para insertar, editar, según la operación a realizar


$id_recorrido   = isset($_POST["id_recorrido"])?   limpiarCadena($_POST["id_recorrido"]):"";
$nombre         = isset($_POST["nombre"])?         limpiarCadena($_POST["nombre"]):"";
$verifrecorrido = isset($_POST["verifrecorrido"])? limpiarCadena($_POST["verifrecorrido"]):"";
$fecha_registro = date('Y-m-d');
$hora_registro  = date('H:i:s'); 

//Estructura Switch para elegir los casos a ejecutar
switch ($_GET["op"]) 
{
 	case 'guardaryeditar':
        
        if($nombre == "")
        {
            echo 3;
        }
        else
        {
            $sql = "SELECT nombre FROM recorridos WHERE nombre = '$nombre'";
            $fila_nocorredor = mysqli_query($conexion, $sql);

            if(mysqli_num_rows($fila_nocorredor) > 0)
            {
                echo 2;
            }
            else
            {
                $sql ="INSERT INTO recorridos(nombre, fecha_registro, hora_registro) 
                VALUES('$nombre', '$fecha_registro', '$hora_registro')";
                echo mysqli_query($conexion, $sql);
            }
        }
        
    break;
        
    case 'soloeditar':
        $sql = "SELECT nombre FROM recorridos WHERE nombre = '$nombre' AND nombre != '$verifrecorrido'";
        $fila_nocorredor = mysqli_query($conexion, $sql);

        if(mysqli_num_rows($fila_nocorredor) > 0)
        {
            echo 2;
        }
        else
        {
            $sql="UPDATE recorridos SET nombre = '$nombre' WHERE id_recorrido = '$id_recorrido'";
	        echo mysqli_query($conexion, $sql); 
        }
 		break;
 	
    case 'eliminar':
 		$rspta=$recorrido->eliminar($id_recorrido);
 		echo $rspta? "Recorrido eliminado" : "El Recorrido no se pudo eliminar";
 		break;
 	
    case 'mostrar':
 		$rspta=$recorrido->mostrar($id_recorrido);
 		//Codificamos el resultado utilizando json
 		echo json_encode($rspta);
 		break;
        
 	case 'listarRecorrido':
 		//Apuntamos al método listar()
 		$rspta = $recorrido->listarRecorrido();
 		//Declaramos un arreglo
 		$data = Array();

 		//Recoremos el arreglo con el ciclo while 
 		while ($reg=$rspta->fetch_object()) {
 			$data[]= array(
				"0"=>'<button class="btn btn-primary" style="background-color: #0582ca;" onclick="mostrar('.$reg->id_recorrido.')"> <i class="fas fa-pen"></i><b>&nbsp; Editar</b></button>'. ' <button class="btn btn-danger" style="color: white;" onclick="eliminar('.$reg->id_recorrido.')"> <i class="fas fa-times"></i><b>&nbsp; Eliminar</b> </button>',
 				"1"=>'Recorrido '.$reg->nombre
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