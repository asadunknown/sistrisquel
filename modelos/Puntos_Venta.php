<?php 
//Incluir la conexión a la base de datos
require '../config/Conexion.php'; 

//Creamos la clase principal
Class Puntos_Venta
{
	//Creamos un constructor para poder hacer las instancias
	public function __construct()
	{

	}

	public function listarPuntosVenta() //Implementar un método para listar los registros de las categorias
	{
        $sql="SELECT corredor.numero_corredor, corredor.nombre_local, CONCAT(persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno)Nombre, persona.direccion, persona.enlace_direccion, persona.telefono, corredor.teamviewer, corredor.anydesk FROM corredores corredor INNER JOIN personas persona on persona.id_persona = corredor.id_persona WHERE corredor.tipo_corredor = 'Virtual' ORDER BY corredor.numero_corredor ASC";
		return ejecutarConsulta($sql); 
	}
    public function listarTodosCorredores() //Implementar un método para listar los registros de las categorias
	{
        $sql="SELECT corredor.numero_corredor, CONCAT(persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno)Nombre, persona.direccion, persona.enlace_direccion, persona.telefono, corredor.tipo_corredor FROM corredores corredor INNER JOIN personas persona on persona.id_persona = corredor.id_persona ORDER BY corredor.numero_corredor ASC";
		return ejecutarConsulta($sql); 
	}
    
    public function listarRecorridoX($no_recorr) //Implementar un método para listar los registros de las categorias
	{
        $sql="SELECT corredor.numero_corredor, CONCAT(persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno)Nombre, persona.telefono, persona.direccion, persona.enlace_direccion, recorrido.nombre num_recorrido FROM corredores corredor INNER JOIN personas persona on persona.id_persona = corredor.id_persona INNER JOIN asignacion_recorrido asignacion on asignacion.id_corredor = corredor.id_corredor INNER JOIN recorridos recorrido on recorrido.id_recorrido = asignacion.id_recorrido WHERE recorrido.id_recorrido = '$no_recorr' ORDER BY corredor.numero_corredor ASC";
		return ejecutarConsulta($sql); 
	}
}

?>