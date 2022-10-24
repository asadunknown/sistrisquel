//====================================================================================================================
// FUNCIONES PARA EL MODULO DE EDITAR CONTRASENA
function limpiarpsw()//Método para limpiarpsw
{
    $("#contrasena").focus();
    $("#contrasena").val("");
    $("#confirmarcontrasena").val("");
}

function cancelarformpsw()//Función para cancelar el formulario
{
	limpiarpsw();
	window.location="dashboard.php";
}

$(document).ready(function()//Función para insertar datos a la tabla
{
    $('#btnguardareditpass').click(function() 
    {
        var datos = $('#frmeditpass').serialize();
        
        $.ajax
        ({
            type:"POST",
            url: "../ajax/empleado.php?op=actualizarpass",
            data:datos,
            success:function(r)
            {
                if(r == 1)
                {
                    Swal.fire
                    ({
                        title: 'Contraseña Actualizada',
                        text:'La contraseña ha sido actualizada exitosamente. Por favor inicie sesión de nuevo.',
                        icon: 'success',
                        showCancelButton: false, 
                        confirmButtonColor: '#3085d6', 
                        cancelButtonColor: '#d33', 
                        confirmButtonText: 'Aceptar'
                    }).then((result) =>
                    {
                        limpiarpsw();
                        window.location="login/cerrar_sesion.php";
                    })
                }
                else if(r == 3)
                {
                    Swal.fire("Advertencia!","Las contraseñas no coinciden, favor de verificar.","warning");
                }
                else if(r == 2)
                {
                    Swal.fire("Advertencia!","Uno o varios de los campos están vacíos, favor de verificar.","warning");
                }
                else if(r == 4)
                {
                    Swal.fire("Advertencia!","La contraseña debe de tener más de 5 caracteres.","warning");
                }
                else
                {
                    Swal.fire("Error!","No se ha podido actualizar la contraseña.","error");
                }
                
                
            }
        });
        return false;
    });
});

function showpass()
{
  if(document.getElementById("ver").checked == true) // Si la checkbox de mostrar contraseña está activada
  {
      document.getElementById("contrasena").type = "text";
      document.getElementById("confirmarcontrasena").type = "text";
  }
  else // Si no está activada
  {
      document.getElementById("contrasena").type = "password";
      document.getElementById("confirmarcontrasena").type = "password";
  }
}
 
//====================================================================================================================

// FUNCIONES PARA EL MODULO DE EDITAR INFROMACION DEL USUARIO
function limpiaruser()//Método para limpiarpsw
{
    //$("#no_user").val("");
    $("#nombre").val("");
    $("#ap_paterno").val("");
    $("#ap_materno").val("");
    $("#telefono").val("");
    $("#direccion").val("");
    $("#enlace_direccion").val("");
    $("#nombre_usuario").val("");
    $("#tipo_empleado").val("");
    $("#verftel").val("");
    $("#verfuser").val("");
}

function cancelarformuser()//Función para cancelar el formulario
{
	limpiaruser();
	window.location="dashboard.php";
}

$(document).ready(function()//Función para insertar datos a la tabla
{
    $('#btnguardaredituser').click(function() 
    {
        var datos = $('#frmeditinfo').serialize();
        
        $.ajax
        ({
            type:"POST",
            url: "../ajax/empleado.php?op=actualizaruser",
            data:datos,
            success:function(r)
            {
                if(r == 1)
                {                    
                    Swal.fire
                    ({
                        title: 'Información Actualizada',
                        text:'Se han modificado los datos exitosamente. Por favor inicie sesión de nuevo para comprobar los cambios.',
                        icon: 'success',
                        showCancelButton: false, 
                        confirmButtonColor: '#3085d6', 
                        cancelButtonColor: '#d33', 
                        confirmButtonText: 'Aceptar'
                    }).then((result) =>
                    {
                        limpiaruser();
                        window.location="login/cerrar_sesion.php";
                    })
                }
                else if(r == 3)
                {
                    Swal.fire("Advertencia!","Este número de teléfono ya está registrado, por favor intente con otro número.","warning");
                    $("#telefono").focus();
                }
                else if(r == 2)
                {
                    Swal.fire("Advertencia!","Este nombre de usuario ya está registrado, por favor intente con otro nombre.","warning");
                    $("#nombre_usuario").focus();
                }
                else
                {
                    Swal.fire("Error!","No se han podido Actualizar los Datos.","error");
                }
                
            }
        });
        return false;
    });
});