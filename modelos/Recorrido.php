<?php 
//Incluir la conexión a la base de datos
require '../config/Conexion.php'; 

//Creamos la clase principal
Class Recorrido
{
	//Creamos un constructor para poder hacer las instancias
	public function __construct()
	{

	}

    //Método para eliminar un registro
    public function eliminar($id_recorrido) 
    {
        $sql = "DELETE FROM recorridos WHERE id_recorrido = '$id_recorrido'";
        return ejecutarConsulta($sql); 
    }

	//Implementar un método para mostrar los datos de un registro mediante un arreglo
	public function mostrar($id_recorrido)
	{
        $sql="SELECT id_recorrido, nombre FROM recorridos WHERE id_recorrido = '$id_recorrido'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros de las categorias
	public function listarRecorrido()
	{
        $sql="SELECT id_recorrido, nombre FROM recorridos";
		return ejecutarConsulta($sql);
	}
}

?>