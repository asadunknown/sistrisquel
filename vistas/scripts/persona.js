//Variable global para manipular la tabla
var tabla;

//Función init() que se ejecutará al iniciar la invocación del listado de las categorias
function init() 
{
	//Cargamos las funciones: mostrarform(false), listar(),
    mostrarlistado(); 
    listar();
    desahabilitareliminarusuario();
    
}

//Método para limpiar
function limpiar()
{
	$("#id_persona").val("");
    $("#nombre").val("");
    $("#ap_paterno").val("");
    $("#ap_materno").val("");
    $("#telefono").val("");
    $("#veriftelefono").val("");
    $("#fecha_nac").val("");
    $("#direccion").val("");
    $("#enlace_direccion").val("");
    $("#comentarios").val("");
    $('#btncancelar').html('Cancelar');
    $('#btnguardaredit').prop("disabled", false);
}

//Función para mostrar el formulario
function mostrarformulario()
{
    $("#formpersona").show();
    $("#tbllistpersona").hide();
    $("#titulo").html("Agregar Nueva Persona:");
    $("#btnnuevapersona").hide();
    $("#btnlistapersona").show();
    $("#btnguardaredit").hide();
    $("#btnguardar").show();
    $("#nombre").focus();
}

//funcion para mostrar la tabla con los corredores ya listados
function mostrarlistado()
{
    //limpiar();
    $('#btneliminarp').prop("disabled", true);
    $("#tbllistpersona").show();
    $("#formpersona").hide();
    $("#titulo").html("Listado de Personas:");
    $("#btnlistapersona").hide();
    $("#btnnuevapersona").show();
    
    
    
    
}
//Función para cancelar el formulario
function cancelarform()
{
	//Invocamos la función limpiar
	limpiar();
	//Invocar o cargar la función mostrar formulario
	listar();
    mostrarlistado();
    //campos_llenos();
    
}

//Función para listar los registros de la base de datos
function listar()
{
    var id_persona = $("#idpersonadisable").val();
	tabla = $('#tbllistado').dataTable(
		{
            "autoWidth": false,
			"aProcessing": true,//Activamos el procesamiento del datatable
			"aServerDide": true,//Paginación y filtrado por parte del servidor
			dom: 'Bfrtip',//Definimos los elementos de control de la tabla
			
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
                titleAttr: 'Exportar datos como PDF',
                className: 'btn btn-danger'
            }
        ],
			//Parámetro para hacer la aplicación ajax
			"ajax":
			{
				url: '../ajax/persona.php?op=listarPersona&id='+id_persona,
				type: "get",
				dataType: "json",
				error: function(e){
					console.log(e.responseText);
				}
			},

			//Parámetro para seguir manipulando el datatable
			"bDestroy":true,
			"iDisplayLength": 10,//Paginación
			"order": [[0,"desc"]] //Ordenar (columna, orden)
		}

		).DataTable();
		
}

//Función para activar un registro
function eliminar(id_persona)
{
    Swal.fire(
    {
        title: '¿Eliminar a la persona?',
        icon: 'warning',
        showCancelButton: true, 
        confirmButtonColor: '#3085d6', 
        cancelButtonColor: '#d33', 
        confirmButtonText: 'Sí, borrar persona!', 
        cancelButtonText: 'Cancelar'
    }).then((result) => 
        {
            if (result.isConfirmed) 
            {
                $.post("../ajax/persona.php?op=eliminar", {id_persona : id_persona}, function(e)
                {
                    //alert(e);
                    Swal.fire("Borrado!","La persona ha sido eliminada exitosamente","success");
                    tabla.ajax.reload();
                });
            }
            else
            {
                Swal.fire("Error!","La persona no ha sido eliminada","error");
                tabla.ajax.reload();
            }
        }) 
}

//Función para insertar datos a la tabla
$(document).ready(function()
{
    $('#btnguardar').click(function() 
    {
        var datos = $('#frmpersona').serialize();
        $.ajax({
            type:"POST",
            url: "../ajax/persona.php?op=guardaryeditar",
            data:datos,
            success:function(r)
            {
                if(r == 1)
                {
                    Swal.fire("Guardado!","La persona ha sido guardada exitosamente","success");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarlistado();
                }
                else if(r == 2)
                {
                    Swal.fire("Advertencia!","Este Número de Teléfono ya está registrado, por favor intente con otro número.","warning");
                    tabla.ajax.reload();
                }
                else if(r == 3)
                {
                    Swal.fire("Advertencia!","Uno o varios de los campos están vacíos, favor de verificar.","warning");
                    tabla.ajax.reload();
                }
                else
                {
                    Swal.fire("Error!","No se ha podido guardar a la persona","error");
                    tabla.ajax.reload();
                }
            }
        });
        return false;
    });
});

//Funcion para editar los datos de una persona
$(document).ready(function()
{
    //campos_llenos();
    $('#btnguardaredit').click(function() 
    {
        var datos = $('#frmpersona').serialize();
        
        $.ajax({
            type:"POST",
            url: "../ajax/persona.php?op=soloeditar",
            data:datos,
            success:function(r)
            {
                if(r == 1)
                {
                    Swal.fire("Guardado!","Se han modificado los datos exitosamente","success");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarlistado();
                }
                else if(r == 2)
                {
                    Swal.fire("Advertencia!","Este número de teléfono ya está registrado, por favor intente con otro.","warning");
                    tabla.ajax.reload();
                }
                else
                {
                    Swal.fire("Error!","No se ha podido modificar a la persona","error");
                    tabla.ajax.reload();
                }
            }
        });
        return false;
        
    });
});



//función para mostrar datos de un registro
function mostrar(id_persona)
{
	$.post("../ajax/persona.php?op=mostrar", {id_persona : id_persona}, function(data, status)
		{
			data = JSON.parse(data);
			//mostrarformulario(true);
            $("#tbllistpersona").hide();
            $("#formpersona").show();
          //$("#titulo").html("Editar Información de: "+data.nombre+" "+data.apellido_paterno+" "+data.apellido_materno);
            $("#titulo").html("Editar Información de la Persona:");
            $("#btnnuevapersona").hide();
            $("#btnlistapersona").show();

			$("#btnguardaredit").show();
			$("#btnguardar").hide();
            $("#nombre").val(data.nombre);
            $("#ap_paterno").val(data.apellido_paterno);
            $("#ap_materno").val(data.apellido_materno);
			$("#telefono").val(data.telefono);
			$("#veriftelefono").val(data.telefono);
			$("#fecha_nac").val(data.fecha_nac);
            $("#direccion").val(data.direccion);
            $("#enlace_direccion").val(data.enlace_direccion);
			$("#comentarios").val(data.comentarios);
			$("#id_persona").val(data.id_persona);
            $("#nombre").focus();
		})
}


function desahabilitareliminarusuario()
{
    //var btneliminar = document.getElementById('btneliminarp');
    
    //var inputidpersona = document.getElementById('#idpersonadisable');
    if($("#btneliminarp").val == 1)
    {
       $('#btneliminarp').prop("disabled", true);
    }
}


init();


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    







