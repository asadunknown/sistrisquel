var tabla;//Variable global para manipular la tabla
var num_recorrido = document.getElementById("num_recorrido").value;

function init() //Función init() que se ejecutará al iniciar la invocación del listado de los corredores
{
	//Cargamos la funciones de listados(),
	listar();
	listarRecorridoX();
    listarTodosCorredores();
	primerlistado();
    numerolistarecorrido();
    
    $.post("../ajax/puntos_venta.php?op=select_lstrecorridos", function(r)
	{
		$("#num_recorrido").html(r);
		//$("#id_nombre_persona").selectpicker('refresh'); 
	});
}

function numerolistarecorrido(no_recorr)
{
    var no_recorr = document.getElementById("num_recorrido").value;
    $.post("../ajax/puntos_venta.php?op=listarRecorridoX",{no_recorr : no_recorr}, function(r)
	{
		//$("#no_recorr").html(r);
	});
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
            url: '../ajax/puntos_venta.php?op=listarPuntosVenta',
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

function listarRecorridoX(no_recorr)//Función para listar los registros de la base de datos
{
	tabla = $('#tbllistadorecX').dataTable
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
            url: '../ajax/puntos_venta.php?op=listarRecorridoX&re='+no_recorr,
            type: "get",
            dataType: "json",
            error: function(e) 
            {
                console.log(e.responseText);
            }
        },
        "bDestroy":true,      //Parámetro para seguir manipulando el datatable
        "iDisplayLength": 20, //Paginación
        "order": [[0,"desc"]] //Ordenar (columna, orden)
    }).DataTable();	
}

function listarTodosCorredores()//Función para listar los registros de la base de datos
{
	tabla = $('#tbllistadotodoscorr').dataTable
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
            url: '../ajax/puntos_venta.php?op=listarTodosCorredores',
            type: "get",
            dataType: "json",
            error: function(e) 
            {
                console.log(e.responseText);
            }
        },
        "bDestroy":true,      //Parámetro para seguir manipulando el datatable
        "iDisplayLength": 20, //Paginación
        "order": [[0,"desc"]] //Ordenar (columna, orden)
    }).DataTable();	
}

$('#num_recorrido').on('change',function(no_recorr) //funcion para ocultar los divs de teamviewer y anydesk si el cooredor es manual
{ 
    var selectValor = $(this).val();
    var no_recorr = document.getElementById("num_recorrido").value;
    switch(selectValor)
    { 
        case 'p_venta':
            $("#tbllistpuntoventa").show();
            $("#tbllistrecorridosX").hide();
            $("#tbllisttodoscorr").hide();
            $("#titulo").html("Listado de Puntos de Venta:");
        break;
            
        case 't_corr':
            $("#tbllistpuntoventa").hide();
            $("#tbllistrecorridosX").hide();
            $("#tbllisttodoscorr").show();
            $("#titulo").html("Listado de Todos los Corredores:");
        break;
        
        default:
            var combo = document.getElementById("num_recorrido");
            var selected = combo.options[combo.selectedIndex].text;
            $("#titulo").html("Listado del "+selected+":");
            $("#tbllistpuntoventa").hide();
            $("#tbllistrecorridosX").show();
            $("#tbllisttodoscorr").hide();
            listarRecorridoX(no_recorr);
        break; 
    }
});

function primerlistado()
{
    $("#tbllistpuntoventa").hide();
    $("#tbllistrecorridosX").hide();
    $("#tbllisttodoscorr").show();
    $("#titulo").html("Listado de Todos los Corredores:");
}

init();

