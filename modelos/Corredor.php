<?php 
//Incluir la conexión a la base de datos
require '../config/Conexion.php'; 

//Creamos la clase principal
Class Corredor
{
	//Creamos un constructor para poder hacer las instancias
	public function __construct()
	{

	}

    //Método para eliminar un registro
    public function eliminar($id_corredor) 
    {
        $sql = "DELETE FROM corredores WHERE id_corredor = '$id_corredor'";
        return ejecutarConsulta($sql); 
    }

	//Implementar un método para mostrar los datos de un registro mediante un arreglo
	public function mostrar($id_corredor)
	{
        $sql="SELECT id_corredor, id_persona, numero_corredor, tipo_corredor, nombre_local, teamviewer, anydesk FROM corredores WHERE id_corredor = '$id_corredor'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros de los corredores
	public function listarCorredor()
	{
        $sql="SELECT corredor.id_corredor, persona.id_persona, corredor.numero_corredor, CONCAT(persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno)Nombre, persona.direccion, persona.enlace_direccion, persona.telefono, corredor.tipo_corredor FROM corredores corredor INNER JOIN personas persona on persona.id_persona = corredor.id_persona ORDER BY corredor.numero_corredor ASC";
		return ejecutarConsulta($sql);
	}
    
   
}

?>