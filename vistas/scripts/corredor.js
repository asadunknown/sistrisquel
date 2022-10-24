var tabla;//Variable global para manipular la tabla

function init() //Función init() que se ejecutará al iniciar la invocación del listado de los corredores
{
	mostrarlistado();//Cargamos las funciones: mostrarlistado(), listar(),
	listar();
    //Mostrar el nombre de la persona
    $.post("../ajax/corredor.php?op=select_idnombrepersona", function(r)
	{
		$("#id_nombre_persona").html(r);
		//$("#id_nombre_persona").selectpicker('refresh'); 
	});
}

function limpiar()//Método para limpiar
{ 
    $("#divteamviewer").hide();
    $("#divanydesk").hide();
    $("#divnombre_local").hide();
    $("#numero_corredor").val("");
    $("#verifcorr").val("");
    $("#tipo_corredor").val("");
    $("#teamviewer").val("");
    $("#anydesk").val("");
    $("#nombre_local").val("");
    
    $('#btncancelar').html('Cancelar');
    $('#btnguardaredit').prop("disabled", false);
}

function mostrarformulario()//Función para mostrar el formulario
{
    $("#tbllistcorr").hide();
    $("#formcorredor").show();
    $("#titulo").html("Agregar Nuevo Corredor:");
    $("#btnnuevocorredor").hide();
    $("#btnlistacorredor").show();
    $("#btnguardaredit").hide();
    $("#btnguardar").show();
    $("#id_nombre_persona").focus();
}

function mostrarlistado()//funcion para mostrar la tabla con los corredores ya listados
{
    limpiar();
    $("#formcorredor").hide();
    $("#tbllistcorr").show();
    $("#titulo").html("Listado de Corredores:");
    $("#btnlistacorredor").hide();
    $("#btnnuevocorredor").show();
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
            url: '../ajax/corredor.php?op=listarCorredor',
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

function eliminar(id_corredor)//Función para eliminar un registro
{
    Swal.fire
    ({
        title: '¿Eliminar al corredor?',
        icon: 'warning',
        showCancelButton: true, 
        confirmButtonColor: '#3085d6', 
        cancelButtonColor: '#d33', 
        confirmButtonText: 'Sí, borrar corredor!', 
        cancelButtonText: 'Cancelar'
    }).then((result) => 
    {
        if (result.isConfirmed) 
        {
            $.post("../ajax/corredor.php?op=eliminar", {id_corredor : id_corredor}, function(e)
            {
                Swal.fire("Borrado!","El corredor ha sido eliminado exitosamente","success");
                tabla.ajax.reload();
            });
        }
        else
        {
            Swal.fire("Error!","El corredor no se ha eliminado","error");
            tabla.ajax.reload();
        }
    })
}

$(document).ready(function()//Función para insertar datos a la tabla
{
    $('#btnguardar').click(function() 
    {
        var datos = $('#frmcorredor').serialize();
        
        $.ajax
        ({
            type:"POST",
            url: "../ajax/corredor.php?op=guardaryeditar",
            data:datos,
            success:function(r)
            {
                switch(r)
                {
                    case '1':
                        Swal.fire("Guardado!","El corredor ha sido guardado exitosamente.","success");
                        limpiar();
                        mostrarlistado()
                        tabla.ajax.reload();
                    break;
                    case '2':
                        Swal.fire("Advertencia!","Este Número de Corredor ya está registrado, por favor intente con otro número.","warning");
                        tabla.ajax.reload();
                    break;
                    case '3':
                        Swal.fire("Advertencia!","El ID del TeamViewer ya está registrado, favor de verificar.","warning");
                        tabla.ajax.reload();
                    break;
                    case '4':
                        Swal.fire("Advertencia!","El ID del AnyDesk ya está registrado, favor de verificar.","warning");
                        tabla.ajax.reload();
                    break;
                    case '5':
                        Swal.fire("Advertencia!","Uno o varios de los campos están vacíos, favor de verificar.","warning");
                        tabla.ajax.reload();
                    break;
                    default:
                        Swal.fire("Error!","No se ha podido guardar al corredor","error");
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
        var datos = $('#frmcorredor').serialize();
    
        $.ajax
        ({
            type:"POST",
            url: "../ajax/corredor.php?op=soloeditar",
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
                else if (r == 2)
                {
                    Swal.fire("Advertencia!","Este Número de Corredor ya está registrado, por favor intente con otro número.","warning");
                    tabla.ajax.reload();
                }
                else
                {
                    Swal.fire("Error!","No se ha podido modificar al corredor","error");
                    tabla.ajax.reload();
                }
            }
        });
        return false;
    });
});

function mostrar(id_corredor)//función para mostrar datos de un registro
{
    $.post("../ajax/corredor.php?op=mostrar", {id_corredor : id_corredor}, function(data, status)
    {
        data = JSON.parse(data);
        
        $("#numero_corredor").focus();
        $("#tbllistcorr").hide();
        $("#formcorredor").show();
        $("#titulo").html("Editar Información de Corredor:");
        $("#btnnuevocorredor").hide();
        $("#btnlistacorredor").show();
		$("#btnguardaredit").show();
		$("#btnguardar").hide();
        
        $("#numero_corredor").val(data.numero_corredor);
        $("#verifcorr").val(data.numero_corredor);
        $("#tipo_corredor").val(data.tipo_corredor); 
		//$("#tipo_corredor").selectpicker('refresh');
        $("#teamviewer").val(data.teamviewer);
        $("#anydesk").val(data.anydesk);
        $("#nombre_local").val(data.nombre_local);
		$("#id_corredor").val(data.id_corredor);
        
        $("#id_nombre_persona").val(data.id_persona); 
        //$("#id_nombre_persona").selectpicker('refresh');
        
        var CorrSelec = $('#tipo_corredor').val();
        if (CorrSelec == 'Virtual') 
        { 
            $("#divnombre_local").show(); $("#divanydesk").show(); $("#divteamviewer").show(); 
        }
        else 
        { 
            $("#divnombre_local").hide(); $("#divanydesk").hide(); $("#divteamviewer").hide(); 
        }
        
    })
}

$('#tipo_corredor').on('change',function() //funcion para ocultar los divs de nombre_local, teamviewer y anydesk si el cooredor es manual
{ 
    var selectValor = $(this).val();

    if (selectValor == 'Manual') 
    {
        $("#divteamviewer").hide(); $("#divanydesk").hide(); $("#divnombre_local").hide();
    }
    else 
    {
        $("#divteamviewer").show(); $("#divanydesk").show(); $("#divnombre_local").show();
    }
});

init();
 









