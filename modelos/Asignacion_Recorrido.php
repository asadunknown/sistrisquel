<?php 
//Incluir la conexión a la base de datos
require '../config/Conexion.php'; 

//Creamos la clase principal
Class Asignacion
{
	//Creamos un constructor para poder hacer las instancias
	public function __construct()
	{

	}

    //Método para eliminar un registro
    public function eliminar($id_asignacion_recorrido) 
    {
        $sql = "DELETE FROM asignacion_recorrido WHERE id_asignacion_recorrido = '$id_asignacion_recorrido'";
        return ejecutarConsulta($sql); 
    }

	//Implementar un método para mostrar los datos de un registro mediante un arreglo
	public function mostrar($id_asignacion_recorrido)
	{
        $sql="SELECT asignacion.id_asignacion_recorrido, corredor.id_corredor, CONCAT('#', corredor.numero_corredor, ' - ', persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno)Nombre, recorrido.id_recorrido, recorrido.nombre num_recorrido FROM corredores corredor INNER JOIN personas persona on persona.id_persona = corredor.id_persona INNER JOIN asignacion_recorrido asignacion on asignacion.id_corredor = corredor.id_corredor INNER JOIN recorridos recorrido on recorrido.id_recorrido = asignacion.id_recorrido WHERE id_asignacion_recorrido = '$id_asignacion_recorrido'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros de las asignacinoes
	public function listarAsignaciones()
	{
        $sql="SELECT asignacion.id_asignacion_recorrido, corredor.numero_corredor, CONCAT(persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno)Nombre, recorrido.nombre num_recorrido FROM corredores corredor INNER JOIN personas persona on persona.id_persona = corredor.id_persona INNER JOIN asignacion_recorrido asignacion on asignacion.id_corredor = corredor.id_corredor INNER JOIN recorridos recorrido on recorrido.id_recorrido = asignacion.id_recorrido ORDER BY corredor.numero_corredor ASC";
		return ejecutarConsulta($sql);
	}
}

?>