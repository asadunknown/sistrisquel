var tabla;//Variable global para manipular la tabla

function init(id_usuario) //Función init() que se ejecutará al iniciar la invocación del listado de los corredores
{
	mostrarlistado();//Cargamos las funciones: mostrarlistado(), listar(),
	listar();
    
    $.post("../ajax/empleado.php?op=select_idnombrepersona",{id_usuario : id_usuario}, function(r)//Mostrar el nombre de la persona
	{
		$("#id_nombre_persona").html(r);
        //$("#id_nombre_persona").selectpicker('refresh');  
	});
}

function limpiar()//Método para limpiar
{
    $("#tipo_empleado").val("");
    $("#nombre_usuario").val("");
    $("#verifuser").val(""); 
    $("#contrasena").val("");
    $('#btncancelar').html('Cancelar');
    $('#btnguardaredit').prop("disabled", false);
}

function mostrarformulario()//Función para mostrar el formulario
{
    $("#tbllistempleado").hide();
    $("#formempleado").show();
    $("#titulo").html("Agregar Nuevo Empleado:");
    $("#btnnuevoempleado").hide();
    $("#btnlistaempleado").show();
    $("#btnguardaredit").hide();
    $("#btnguardar").show();
    $("#id_nombre_persona").focus();
    $('#contrasena').prop("disabled", true);
    //$('#txtcontrasena').html('Contraseña ("12345" por defecto, depués puede ser actualizada por el usuario)');
}

function mostrarlistado()//funcion para mostrar la tabla con los corredores ya listados
{
    limpiar();
    $("#formempleado").hide();
    $("#tbllistempleado").show();
    $("#titulo").html("Listado de Empleados:");
    $("#btnlistaempleado").hide();
    $("#btnnuevoempleado").show();
    $("#contrasena").val("12345");

}

function cancelarform()//Función para cancelar el formulario
{
	limpiar();
	mostrarlistado();
    listar();
}

function listar()//Función para listar los registros de la base de datos
{
    var id_usuario = $("#idusuariodisable").val();
        
	tabla = $('#tbllistado').dataTable
    ({
        "autoWidth": false,
        "aProcessing": true, //Activamos el procesamiento del datatable
        "aServerDide": true, //Paginación y filtrado por parte del servidor
        dom: 'Bfrtip',       //Definimos los elementos de control de la tabla

        //buttons: [ 'excelHtml5', 'pdf' ], //botones para imprimir reportes con excel y pdfs
        buttons:[
            {
                extend: 'excelHtml5',
                text:   '<i class="fas fa-file-excel">&nbsp; Excel</i>',
                titleAttr: 'Exportar datos a Excel',
                className: 'btn btn-success'
            },
            {
                extend: 'pdfHtml5',
                text:   '<i class="fas fa-file-pdf">&nbsp; PDF</i>',
                titleAttr: 'Exportar datos en PDF',
                className: 'btn btn-danger'
            }
        ],
        
        
        "ajax":
        {
            url: '../ajax/empleado.php?op=listarEmpleado&id='+id_usuario,
            type: "get",
            dataType: "json",
            error: function(e)
            {
                console.log(e.responseText);
            }
        },

        "bDestroy":true,      //Parámetro para seguir manipulando el datatable
        "iDisplayLength": 10, //Paginación
        "order": [[0,"desc"]] //Ordenar (columna, orden)
    }).DataTable();	
}

function eliminar(id_usuario)//Función para eliminar un registro
{
    Swal.fire
    ({
        title: '¿Eliminar al empleado?',
        icon: 'warning',
        showCancelButton: true, 
        confirmButtonColor: '#3085d6', 
        cancelButtonColor: '#d33', 
        confirmButtonText: 'Sí, borrar empleado!', 
        cancelButtonText: 'Cancelar'
    }).then((result) => 
    {
        if (result.isConfirmed) 
        {
            $.post("../ajax/empleado.php?op=eliminar", {id_usuario : id_usuario}, function(e)
            {
                Swal.fire("Borrado!","El empleado ha sido eliminado exitosamente","success");
                tabla.ajax.reload();
                init();
            });
        }
        else
        {
            Swal.fire("Error!","El empleado no se ha eliminado","error");
            tabla.ajax.reload();
            init();
        }
    })
    
}

/*function mensajexd()
{
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Your work has been saved',
  showConfirmButton: false,
  timer: 1500
});
}*/

$(document).ready(function()//Función para insertar datos a la tabla
{
    $('#btnguardar').click(function() 
    {
        var datos = $('#frmempleado').serialize();
        
        $.ajax
        ({
            type:"POST",
            url: "../ajax/empleado.php?op=guardaryeditar",
            data:datos,
            success:function(r)
            {if(r == 1)
                {
                    Swal.fire("Guardado!","El empleado ha sido registrado exitosamente. La Contraseña por defecto es '12345', para después ser actualizada por el usuario","success");
                    //mensajexd();
                    limpiar();
                    mostrarlistado()
                    tabla.ajax.reload();
                    init();
                }
                else if(r == 2)
                {
                    Swal.fire("Advertencia!","Este nombre de usuario ya está registrado, por favor intente con otro nombre.","warning");
                    tabla.ajax.reload();
                }
                else if(r == 3)
                {
                    Swal.fire("Advertencia!","Uno o varios de los campos están vacíos, favor de verificar.","warning");
                    tabla.ajax.reload();
                }
                else
                {
                    Swal.fire("Error!","No se ha podido guardar al empleado","error");
                    tabla.ajax.reload();
                }
            }
        });
        //init();
        return false;
    });
});

$(document).ready(function()//Funcion para editar los datos de una persona
{
    $('#btnguardaredit').click(function() 
    {
        var datos = $('#frmempleado').serialize();
    
        $.ajax
        ({
            type:"POST",
            url: "../ajax/empleado.php?op=soloeditar",
            data:datos,
            success:function(r)
            {
                if(r == 1)
                {
                    Swal.fire("Guardado!","Se han modificado los datos exitosamente","success");
                    limpiar();
                    mostrarlistado()
                    tabla.ajax.reload();
                }
                else if(r == 2)
                {
                    Swal.fire("Advertencia!","Este nombre de usuario ya está registrado, por favor intente con otro nombre.","warning");
                    tabla.ajax.reload();
                }
                else
                {
                    Swal.fire("Error!","No se ha podido modificar el empleado","error");
                    tabla.ajax.reload();
                }
            }
        });
        return false;
    });
});

function mostrar(id_usuario)//función para mostrar datos de un registro
{
    //alert(id_usuario); 
    $.post("../ajax/empleado.php?op=mostrar", {id_usuario : id_usuario}, function(data, status)
    {
        data = JSON.parse(data);
        
        $("#tipo_empleado").focus();
        $("#tbllistempleado").hide();
        $("#formempleado").show();
        $("#titulo").html("Editar Información del Empleado:");
        $("#btnnuevoempleado").hide();
        $("#btnlistaempleado").show();
		$("#btnguardaredit").show();
		$("#btnguardar").hide();
        
        $("#tipo_empleado").val(data.tipo_empleado); 
		//$("#tipo_corredor").selectpicker('refresh');
		$("#id_usuario").val(data.id_usuario);
		$("#nombre_usuario").val(data.nombre_usuario);
		$("#verifuser").val(data.nombre_usuario);
        
        $("#id_nombre_persona").val(data.id_persona); 
        //$("#id_nombre_persona").selectpicker('refresh');
    })
    init(id_usuario);
}

//init();
