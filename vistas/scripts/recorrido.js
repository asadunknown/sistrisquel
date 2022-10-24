var tabla;//Variable global para manipular la tabla

function init() //Función init() que se ejecutará al iniciar la invocación del listado de los corredores
{
	panelinicio();//Cargamos las funciones: mostrarlistado(), listar(),
	listar();
    
}

function panelinicio()
{
    limpiar();
    
    $("#formrecorrido").hide();
    $("#tbllistrecorr").show();
    $("#titulo").html("Listado de Recorridos:");
    $("#btnnuevorecorrido").show();
}

function limpiar()//Método para limpiar
{
    $("#nombre").val("");
    $("#verifrecorrido").val("");
    $('#btncancelar').html('Cancelar');
    $('#btnguardaredit').prop("disabled", false);
}

function mostrarformulario()//Función para mostrar el formulario
{ 
    $("#nombre").prop("maxlength", "1");
    $("#formrecorrido").slideDown('slow');
    $("#titulo").html("Agregar Nuevo Recorrido:");
    $("#btnnuevorecorrido").hide();
    $("#btnguardaredit").hide();
    $("#btnguardar").show();
    $("#nombre").focus();
}

function mostrarlistado()//funcion para mostrar la tabla con los corredores ya listados
{
    limpiar();
    $("#btnguardaredit").hide();
    $("#formrecorrido").slideUp('slow');
    $("#tbllistrecorr").show();
    $("#titulo").html("Listado de Recorridos:");
    $("#btnnuevorecorrido").show();
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
            url: '../ajax/recorrido.php?op=listarRecorrido',
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

function eliminar(id_recorrido)//Función para eliminar un registro
{
    Swal.fire
    ({
        title: '¿Eliminar el recorrido?',
        icon: 'warning',
        showCancelButton: true, 
        confirmButtonColor: '#3085d6', 
        cancelButtonColor: '#d33', 
        confirmButtonText: 'Sí, borrar Recorrido!', 
        cancelButtonText: 'Cancelar'
    }).then((result) => 
    {
        if (result.isConfirmed) 
        {
            $.post("../ajax/recorrido.php?op=eliminar", {id_recorrido : id_recorrido}, function(e)
            {
                Swal.fire("Borrado!","El recorrido ha sido eliminado exitosamente","success");
                tabla.ajax.reload();
            });
        }
        else
        {
            Swal.fire("Error!","El recorrido no se ha eliminado","error");
            tabla.ajax.reload();
        }
    })
}

$(document).ready(function()//Función para insertar datos a la tabla
{
    $('#btnguardar').click(function() 
    {
        var datos = $('#frmrecorrido').serialize();
        
        $.ajax
        ({
            type:"POST",
            url: "../ajax/recorrido.php?op=guardaryeditar",
            data:datos,
            success:function(r)
            {
                switch(r)
                {
                    case '1':
                        Swal.fire("Guardado!","El recorrido ha sido guardado exitosamente.","success");
                        limpiar();
                        mostrarlistado()
                        tabla.ajax.reload();
                    break;
                    
                    case '2':
                        Swal.fire("Advertencia!","El nombre de éste recorrido ya está registrado, por favor intente con otro nombre.","warning");
                        tabla.ajax.reload();
                    break;
                        
                    case '3':
                        Swal.fire("Advertencia!","El nombre del recorrido está vacío, favor de escribir un nombre.","warning");
                        tabla.ajax.reload();
                    break;
                    
                    default:
                        Swal.fire("Error!","No se ha podido guardar el recorrido","error");
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
        var datos = $('#frmrecorrido').serialize();
    
        $.ajax
        ({
            type:"POST",
            url: "../ajax/recorrido.php?op=soloeditar",
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
                    Swal.fire("Advertencia!","Este nombre de recorrido ya está registrado, por favor intente con otro nombre.","warning");
                    tabla.ajax.reload();
                }
                else
                {
                    Swal.fire("Error!","No se ha podido modificar el recorrido","error");
                    tabla.ajax.reload();
                }
            }
        });
        return false;
    });
});

function mostrar(id_recorrido)//función para mostrar datos de un registro
{
    $.post("../ajax/recorrido.php?op=mostrar", {id_recorrido : id_recorrido}, function(data, status)
    {
        data = JSON.parse(data);
        //$("#nombre").prop("maxlength", "11");
        $("#formrecorrido").slideDown('slow');
        $("#titulo").html("Editar Nombre del Recorrido:");
        $("#btnnuevorecorrido").hide();
		$("#btnguardaredit").show();
		$("#btnguardar").hide();
        
        $("#nombre").val(data.nombre);
        $("#verifrecorrido").val(data.nombre);
		$("#id_recorrido").val(data.id_recorrido);
        $("#nombre").focus();
        
    })
}
init();
 









