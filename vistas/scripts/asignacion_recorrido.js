var tabla;//Variable global para manipular la tabla

function init() //Función init() que se ejecutará al iniciar la invocación del listado de los corredores
{
	panelinicio();//Cargamos las funciones: mostrarlistado(), listar(),
	listar();
    //Mostrar el nombre de la persona con el numero de corredor
    $.post("../ajax/asignacion_recorrido.php?op=select_corredorPer", function(r) 
	{
		$("#id_corredorPer").html(r); 
	});
    
    $.post("../ajax/asignacion_recorrido.php?op=select_recorrido", function(r)
	{
		$("#id_recorrido").html(r);
	});
}

function limpiar()//Método para limpiar
{
    $("#id_corredorPer").val("");
    $("#id_recorrido").val("");
    $('#btncancelar').html('Cancelar');
    $('#btnguardaredit').prop("disabled", false);
}

function mostrarformulario()//Función para mostrar el formulario
{
    //$("#tbllistasignacion").hide();
    $("#formasignacion").slideDown('slow');
    $("#titulo").html("Agregar Nueva Asignación:");
    $("#btnnuevaasignacion").hide();
    $("#btnguardaredit").hide();
    $("#btnguardar").show();
    $("#id_corredorPer").focus();
}

function mostrarlistado()//funcion para mostrar la tabla con los corredores ya listados
{
    limpiar();
    $("#formasignacion").slideUp('slow');
    $("#tbllistasignacion").show();
    $("#titulo").html("Listado de Asignaciones:");
    $("#btnnuevaasignacion").show();
}

function panelinicio()//funcion para mostrar la tabla con los corredores ya listados
{
    limpiar();
    $("#formasignacion").hide();
    $("#tbllistasignacion").show();
    $("#titulo").html("Listado de Asignaciones:");
    $("#btnnuevaasignacion").show();
}

function cancelarform()//Función para cancelar el formulario
{
	limpiar();
	mostrarlistado();
    listar();
}

function listar()//Función para listar los registros de la base de datos
{
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
            url: '../ajax/asignacion_recorrido.php?op=listarAsignaciones',
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

function eliminar(id_asignacion_recorrido)//Función para eliminar un registro
{
    Swal.fire
    ({
        title: '¿Eliminar la Asignación Corredor-Recorrido?',
        icon: 'warning',
        showCancelButton: true, 
        confirmButtonColor: '#3085d6', 
        cancelButtonColor: '#d33', 
        confirmButtonText: 'Sí, borrar asignación!', 
        cancelButtonText: 'Cancelar'
    }).then((result) => 
    {
        if (result.isConfirmed) 
        {
            $.post("../ajax/asignacion_recorrido.php?op=eliminar", {id_asignacion_recorrido : id_asignacion_recorrido}, function(e)
            {
                Swal.fire("Borrado!","La asignacion ha sido eliminada exitosamente","success");
                tabla.ajax.reload();
            });
        }
        else
        {
            Swal.fire("Error!","La asignación no se ha eliminado","error");
            tabla.ajax.reload();
        }
    })
}

$(document).ready(function()//Función para insertar datos a la tabla
{
    $('#btnguardar').click(function() 
    {
        var datos = $('#frmasignacion').serialize();
        
        $.ajax
        ({
            type:"POST",
            url: "../ajax/asignacion_recorrido.php?op=guardaryeditar",
            data:datos,
            success:function(r)
            {
                switch(r)
                {
                    case '1':
                        Swal.fire("Guardado!","La asignación Corredor-Recorrido ha sido guardada exitosamente.","success");
                        limpiar();
                        mostrarlistado()
                        tabla.ajax.reload();
                    break;
                    case '2':
                        Swal.fire("Advertencia!","La asignación ya está registrada, favor de verificar.","warning");
                        tabla.ajax.reload();
                    break;
                    case '3':
                        Swal.fire("Advertencia!","Uno o varios de los campos están vacíos, favor de verificar.","warning");
                        tabla.ajax.reload();
                    break;
                    default:
                        Swal.fire("Error!","No se ha podido guardar la asignación","error");
                        tabla.ajax.reload();
                }
            }
        });
        return false;
    });
});


$(document).ready(function()//Funcion para editar los datos de una persona
{
    $('#btnguardaredit').click(function() 
    {
        var datos = $('#frmasignacion').serialize();
    
        $.ajax
        ({
            type:"POST",
            url: "../ajax/asignacion_recorrido.php?op=soloeditar",
            data:datos,
            success:function(r)
            {
/*                if(r == 1)
                {
                    Swal.fire("Guardado!","Se han modificado los datos exitosamente","success");
                    limpiar();
                    mostrarlistado()
                    tabla.ajax.reload();
                }
                else if(r == 2)
                {
                    Swal.fire("Advertencia!","La asignación ya está registrada, favor de verificar.","warning");
                    tabla.ajax.reload();
                }
                else if(r == 3)
                {
                    Swal.fire("Advertencia!","Uno o varios de los campos están vacíos, favor de verificar.","warning");
                    tabla.ajax.reload();
                }
                else
                {
                    Swal.fire("Error!","No se ha podido modificar la asignación","error");
                    tabla.ajax.reload();
                }*/
                switch(r)
                {
                    case '1':
                        Swal.fire("Guardado!","Se han modificado los datos exitosamente","success");
                        limpiar();
                        mostrarlistado()
                        tabla.ajax.reload();
                    break;
                    case '2':
                        Swal.fire("Advertencia!","La asignación ya está registrada, favor de verificar.","warning");
                        tabla.ajax.reload();
                    break;
                    case '3':
                        Swal.fire("Advertencia!","Uno o varios de los campos están vacíos, favor de verificar.","warning");
                        tabla.ajax.reload();
                    break;
                    default:
                        Swal.fire("Error!","No se ha podido modificar la asignación","error");
                        tabla.ajax.reload();
                }
            }
        });
        return false;
    });
});

function mostrar(id_asignacion_recorrido)//función para mostrar datos de un registro
{
    $.post("../ajax/asignacion_recorrido.php?op=mostrar", {id_asignacion_recorrido : id_asignacion_recorrido}, function(data, status)
    {
        data = JSON.parse(data);
        
        $("#id_corredorPer").focus();
        //$("#tbllistasignacion").hide();
        $("#formasignacion").slideDown('slow');
        $("#titulo").html("Editar la Asignación del Corredor:");
        $("#btnnuevaasignacion").hide();
		$("#btnguardaredit").show();
		$("#btnguardar").hide();
        
        $("#id_asignacion_recorrido").val(data.id_asignacion_recorrido); 
        $("#id_corredorPer").val(data.id_corredor); 
        $("#verifidcorrper").val(data.id_corredor); 
        $("#id_recorrido").val(data.id_recorrido); 
        $("#verifidrecorrido").val(data.id_recorrido); 
    })
}

init();
 









