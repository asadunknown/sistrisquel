<?php 
//Requerimos de los datos de global.php
require_once 'global.php';

//Declamos la variable para crear nuestro objeto y usar las constantes
//de global.php
$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

//Validamos el uso de los caracteres especiales o codificación
mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');

//Si tenemos algún en la conexión 
if (mysqli_connect_errno()) {
	printf("Falla de la conexión a la base de datos %s", mysqli_connect_error());
	exit();
}

//Validar funciones que usaremos en los modelos o en otros archivos

if (!function_exists('ejecutarConsulta')) {
	
	function ejecutarConsulta($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		return $query;
	}

	function ejecutarConsultaSimpleFila($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		$row = $query->fetch_assoc();
		return $row;
	}

	function ejecutarConsulta_retornarID($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		return $conexion->insert_id;
	}

	function limpiarCadena($str)
	{
		global $conexion;
		$str= mysqli_real_escape_string($conexion, trim($str));
		return htmlspecialchars($str);
	}

}

?>