<?php 
//Requerir el archivo donde está la clase: Categoria.php
require_once '../modelos/Corredor.php';    

//Variable para guardar el objeto o clase
$corredor = new Corredor();

//Variables para insertar, editar, según la operación a realizar
$id_corredor     = isset($_POST["id_corredor"])?       limpiarCadena($_POST["id_corredor"]):"";
$id_persona      = isset($_POST["id_nombre_persona"])? limpiarCadena($_POST["id_nombre_persona"]):"";
$numero_corredor = isset($_POST["numero_corredor"])?   limpiarCadena($_POST["numero_corredor"]):"";
$verifcorr       = isset($_POST["verifcorr"])?         limpiarCadena($_POST["verifcorr"]):"";
$tipo_corredor   = isset($_POST["tipo_corredor"])?     limpiarCadena($_POST["tipo_corredor"]):"";
$nombre_local    = isset($_POST["nombre_local"])?      limpiarCadena($_POST["nombre_local"]):"";
$teamviewer      = isset($_POST["teamviewer"])?        limpiarCadena($_POST["teamviewer"]):"0";
$anydesk         = isset($_POST["anydesk"])?           limpiarCadena($_POST["anydesk"]):"0";
$fecha_registro  = date('Y-m-d');
$hora_registro   = date('H:i:s');

//Estructura Switch para elegir los casos a ejecutar
switch ($_GET["op"]) 
{
 	case 'guardaryeditar'://funcion para guarda la información
        if($numero_corredor == "" || $tipo_corredor == "")
        {
            echo 5;
        }
        else
        {
            $sql = "SELECT numero_corredor FROM corredores WHERE numero_corredor = '$numero_corredor'";
            $fila_nocorredor = mysqli_query($conexion, $sql);

            if(mysqli_num_rows($fila_nocorredor) > 0)
            {
                echo 2;
            }
            else
            {
                $sql = "SELECT teamviewer FROM corredores WHERE teamviewer = '$teamviewer' AND tipo_corredor = 'Virtual' AND teamviewer != ''";
                $filas_teamviewer = mysqli_query($conexion, $sql);

                if(mysqli_num_rows($filas_teamviewer) > 0)
                {
                    echo 3;
                }
                else
                {
                    $sql = "SELECT anydesk FROM corredores WHERE anydesk = '$anydesk' AND tipo_corredor = 'Virtual'  AND anydesk != ''";
                    $filas_anydesk = mysqli_query($conexion, $sql);

                    if(mysqli_num_rows($filas_anydesk) > 0)
                    {
                        echo 4;
                    }
                    else
                    {
                        $sql ="INSERT INTO corredores(id_persona, numero_corredor, tipo_corredor, nombre_local, teamviewer, anydesk, fecha_registro, hora_registro) 
                        VALUES('$id_persona', '$numero_corredor', '$tipo_corredor', '$nombre_local', '$teamviewer', '$anydesk', '$fecha_registro', '$hora_registro')";
                        echo mysqli_query($conexion, $sql);
                    }
                } 
            }
        }
        
    break;
        
    case 'soloeditar':  //funcion para editar la informacion
                
        $sql = "SELECT numero_corredor FROM corredores WHERE numero_corredor = '$numero_corredor' AND numero_corredor != '$verifcorr'";
        $fila_nocorredor = mysqli_query($conexion, $sql);

        if(mysqli_num_rows($fila_nocorredor) > 0)
        {
            echo 2;
        }
        else
        {
            if($tipo_corredor == "Manual") { $nombre_local = ""; $teamviewer = ""; $anydesk = ""; }
            
            $sql="UPDATE corredores SET id_persona = '$id_persona', numero_corredor = '$numero_corredor', tipo_corredor = '$tipo_corredor', nombre_local = '$nombre_local', teamviewer = '$teamviewer', anydesk = '$anydesk' WHERE id_corredor = '$id_corredor'";
	        echo mysqli_query($conexion, $sql);
        }
 		break;
 	
    case 'eliminar':
 		$rspta=$corredor->eliminar($id_corredor);
 		echo $rspta? "Corredor eliminado" : "El Corredor no se pudo eliminar";
 		break;
 	
    case 'mostrar':
 		$rspta=$corredor->mostrar($id_corredor);
 		//Codificamos el resultado utilizando json
 		echo json_encode($rspta);
 		break;
        
 	case 'listarCorredor':
 		//Apuntamos al método listar()
 		$rspta = $corredor->listarCorredor();
 		//Declaramos un arreglo
 		$data = Array();

 		//Recoremos el arreglo con el ciclo while 
 		while ($reg=$rspta->fetch_object()) {
 			$data[]= array(
				"0"=>'<button class="btn btn-primary" style="background-color: #0582ca;" onclick="mostrar('.$reg->id_corredor.')"> <i class="fas fa-pen"></i> </button>'. ' <button class="btn btn-danger" style="color: white;" onclick="eliminar('.$reg->id_corredor.')"> <i class="fas fa-times"></i> </button>', //id_corredor se reemplaza por botones
 				"1"=>$reg-> numero_corredor,
 				"2"=>$reg-> Nombre,
                "3"=>'<a href="'.$reg->enlace_direccion.'" target="_blank">'.$reg->direccion.'</a>',
 				"4"=>$reg-> telefono,
 				"5"=>$reg-> tipo_corredor
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
 		//hacemos referencia al modelo ategoria
 		require_once "../modelos/Persona.php";
 		$persona = new Persona();
 		$rspta =  $persona->select();

 		//Recorremos los registros con un while
 		while ($reg = $rspta->fetch_object()) 
 		{
 			echo '<option value = '.$reg->id_persona.'>'.$reg->Nombre.'</option>';
 		}

 	break;
}




?>