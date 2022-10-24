<?php 
//Incluir la conexión a la base de datos
require '../config/Conexion.php'; 

//Creamos la clase principal
Class Empleado
{
	//Creamos un constructor para poder hacer las instancias
	public function __construct(){}

    //Método para eliminar un registro
    public function eliminar($id_usuario) 
    {
        $sql = "DELETE FROM usuarios WHERE id_usuario = '$id_usuario'";
        return ejecutarConsulta($sql); 
    }

	//Implementar un método para mostrar los datos de un registro mediante un arreglo
	public function mostrar($id_usuario)
	{
        $sql="SELECT id_usuario, id_persona, nombre_usuario, contrasena, tipo_empleado FROM usuarios WHERE id_usuario = '$id_usuario'";
		return ejecutarConsultaSimpleFila($sql);
	}
    
    /*public function mostrarinfouser($id_persona)
	{
        $sql="SELECT usuario.id_usuario, persona.id_persona, persona.nombre, persona.apellido_paterno, persona.apellido_materno, persona.telefono, persona.direccion, persona.enlace_direccion, usuario.nombre_usuario, usuario.tipo_empleado FROM usuarios usuario INNER JOIN personas persona ON persona.id_persona = usuario.id_persona WHERE persona.id_persona = '$id_persona'";
		return ejecutarConsultaSimpleFila($sql);
	}*/

	//Implementar un método para listar los registros de las categorias
	public function listarEmpleado()
	{
        $sql="SELECT usuario.id_usuario, persona.id_persona, CONCAT(persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) Nombre, persona.direccion, persona.enlace_direccion, persona.telefono, usuario.tipo_empleado, usuario.nombre_usuario FROM usuarios usuario INNER JOIN personas persona ON persona.id_persona = usuario.id_persona";
		return ejecutarConsulta($sql);
	}
    
    public function selectEmpleado($id_usuario)
	{
		$sql="SELECT personas.id_persona, CONCAT(personas.nombre, ' ', personas.apellido_paterno, ' ', personas.apellido_materno) Nombre FROM personas  WHERE personas.id_persona NOT IN(SELECT corredores.id_persona FROM corredores) AND personas.id_persona NOT IN(SELECT usuarios.id_persona FROM usuarios WHERE usuarios.id_usuario != '$id_usuario')";
		return ejecutarConsulta($sql);
	}
        
    //Implementar un método para listar los nombres de las personas
	public function select()
	{
		$sql="SELECT id_persona, CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) Nombre FROM personas";
		return ejecutarConsulta($sql);
	}
/*    
    //funcion para permitir el acceso al sistema
    public function verificar($user, $pass)
    {
        $sql="SELECT persona.id_persona, usuario.id_usuario, CONCAT(persona.nombre, ' ', persona.apellido_paterno,' ', persona.apellido_materno) AS Nombre FROM usuarios usuario INNER JOIN personas persona ON persona.id_persona = usuario.id_persona WHERE nombre_usuario = '$user' and contrasena = '$pass'";
		return ejecutarConsulta($sql);
    }*/
}

?>


















