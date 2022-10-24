<?php 
//Incluir la conexión a la base de datos
require '../config/Conexion.php'; 

//Creamos la clase principal
Class Persona
{
	//Creamos un constructor para poder hacer las instancias
	public function __construct()
	{

	}
    
    //Método para eliminar un registro
    public function eliminar($id_persona)
    {
        $sql = "DELETE FROM personas WHERE id_persona = '$id_persona'";
        return ejecutarConsulta($sql);
    }

	//Implementar un método para mostrar los datos de un registro mediante un arreglo
	public function mostrar($id_persona)
	{
		$sql="SELECT id_persona, nombre, apellido_paterno, apellido_materno, telefono, direccion, enlace_direccion, fecha_nac, comentarios FROM personas WHERE id_persona= '$id_persona'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//método para listar los datos en la tabla de personas -> personas.php
	public function listarPersona()
	{
        $sql="SELECT id_persona, CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) Nombre, telefono, enlace_direccion, direccion, DATE_FORMAT(fecha_nac,'%d - %c - %Y') AS fecha_nac, comentarios FROM personas";
		
        return ejecutarConsulta($sql);
        
	}
    
    //FUNCIONES PARA SELECCIONAR EL NOMBRE Y EL ID Y LLENAR LOS SELECTS
    //Implementar un método para listar los ids y nombres de las personas en agregar nuevo corredor
	public function select()
	{
		$sql="SELECT personas.id_persona, CONCAT(personas.nombre, ' ', personas.apellido_paterno, ' ', personas.apellido_materno) Nombre FROM personas WHERE personas.id_persona NOT IN(SELECT usuarios.id_persona FROM usuarios) ";
		return ejecutarConsulta($sql);
	}
    
    public function selectEmpleado($id_usuario)
	{
		$sql="SELECT personas.id_persona, CONCAT(personas.nombre, ' ', personas.apellido_paterno, ' ', personas.apellido_materno) Nombre FROM personas  WHERE personas.id_persona NOT IN(SELECT corredores.id_persona FROM corredores) AND personas.id_persona NOT IN(SELECT usuarios.id_persona FROM usuarios WHERE usuarios.id_usuario != '$id_usuario')";
		return ejecutarConsulta($sql);
	}
    
    
    //Implementar un método para listar los ids y nombres de las personas en agregar una nueva asignacion al recorrido
	public function select_corredorPer()
	{
		$sql="SELECT corredor.id_corredor, CONCAT('#',corredor.numero_corredor, ' - ', persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno)Nombre FROM corredores corredor INNER JOIN personas persona on persona.id_persona = corredor.id_persona ORDER BY corredor.numero_corredor ASC";
		return ejecutarConsulta($sql);
	}
    
    //Implementar un método para listar los ids y nombres de las personas en agregar nuevo corredor
	public function select_recorrido()
	{
		$sql="SELECT id_recorrido, CONCAT('Recorrido #', nombre) AS nombre FROM recorridos";
		return ejecutarConsulta($sql);
	}
    
    public function select_lstrecorridos()
	{
		$sql="SELECT id_recorrido, nombre from recorridos";
		return ejecutarConsulta($sql);
	}
}

?>