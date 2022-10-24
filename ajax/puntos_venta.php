<?php 
require_once '../modelos/Puntos_Venta.php'; //Requerir el archivo donde está la clase: Categoria.php.

$puntos_venta = new Puntos_Venta(); //Variable para guardar el objeto o clase.

//$no_recorr = isset($_POST["num_recorrido"])? limpiarCadena($_POST["num_recorrido"]):"";
$no_recorr = $_GET["re"];

switch ($_GET["op"]) //Estructura Switch para elegir los casos a ejecutar.
{
 	case 'listarPuntosVenta': 
 		$rspta = $puntos_venta->listarPuntosVenta(); //Apuntamos al método listar()
 		$data = Array(); //Declaramos un arreglo

 		while ($reg=$rspta->fetch_object()) { //Recoremos el arreglo con el ciclo while 
 			$data[]= array(
				/*"0"=>'<button class="btn btn-primary" onclick="mostrar('.$reg->id_corredor.')"> <i class="fas fa-pen"></i> </button>'. ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_corredor.')"> <i class="fas fa-times"></i> </button>', //id_corredor se reemplaza por botones*/
 				"0"=>'#'.$reg->numero_corredor.' - '.$reg->nombre_local,
 				"1"=>$reg-> Nombre,
 				"2"=>'<a href="'.$reg->enlace_direccion.'" target="_blank">'.$reg->direccion.'</a>',
 				"3"=>$reg-> telefono,
 				"4"=>$reg-> teamviewer,
 				"5"=>$reg-> anydesk
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
    
    case 'listarRecorridoX': 
 		$rspta = $puntos_venta->listarRecorridoX($no_recorr); //Apuntamos al método listar()
 		$data = Array(); //Declaramos un arreglo

 		while ($reg=$rspta->fetch_object()) { //Recoremos el arreglo con el ciclo while 
 			$data[]= array(
 				"0"=>$reg-> numero_corredor,
 				"1"=>$reg-> Nombre,
                "2"=>'<a href="'.$reg->enlace_direccion.'" target="_blank">'.$reg->direccion.'</a>',
                "3"=>$reg-> telefono,
 				"4"=>$reg-> num_recorrido
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
        
    case 'listarTodosCorredores': 
 		$rspta = $puntos_venta->listarTodosCorredores(); //Apuntamos al método listar()
 		$data = Array(); //Declaramos un arreglo

 		while ($reg=$rspta->fetch_object()) { //Recoremos el arreglo con el ciclo while 
 			$data[]= array(
 				"0"=>$reg-> numero_corredor,
 				"1"=>$reg-> Nombre,
 				"2"=>'<a href="'.$reg->enlace_direccion.'" target="_blank">'.$reg->direccion.'</a>',
 				"3"=>$reg-> telefono,
 				"4"=>$reg-> tipo_corredor
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
        
    case 'select_lstrecorridos':
 		//hacemos referencia al modelo ategoria
 		require_once "../modelos/Persona.php";
 		$persona = new Persona();
 		$rspta =  $persona->select_lstrecorridos($no_recorr);
        echo '<option value="t_corr">Todos los Corredores</option>';
        echo '<option value="p_venta">Puntos de Venta</option>';
 		//Recorremos los registros con un while
 		while ($reg = $rspta->fetch_object()) 
 		{
 			echo '<option value = '.$reg->id_recorrido.'>'.'Recorrido #'.$reg->nombre.'</option>';
 		}

 	break;    
    
}




?>