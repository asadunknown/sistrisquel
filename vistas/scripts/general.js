var sombra = "box-shadow: 5px 3px 10px black;";
//var bordes = "border-top: 1px solid; border-bottom: 1px solid; border-left: 1px solid;";*/

function initgen() 
{
    //funciones que se ejecutarán cuando cargue el documento
    val_letrasspace();
    val_letras();
    val_numeros();
    estilotabla();
    
    
}

function val_numeros()
{
    jQuery('.solonumeros').keypress(function (numero) 
    { if (numero.charCode >=65 && numero.charCode <= 90 || numero.charCode >= 97 && numero.charCode <= 122 || numero.charCode == 13 || numero.charCode == 32) {return false;}});
}

function val_letras()
{
    jQuery('.sololetras').keypress(function (letras) 
    { if (letras.charCode >=48 && letras.charCode <= 57 || letras.charCode == 13) {return false;}});
}

function val_letrasspace()
{
    jQuery('.letrasspace').keypress(function (letrassp) 
    { if (letrassp.charCode >=48 && letrassp.charCode <= 57 || letrassp.charCode == 13 || letrassp.charCode == 32) {return false;}});
}

function estilotabla()
{
    var listados = document.getElementById("tbllistado"); listados.style.cssText = sombra;
    var listadostc = document.getElementById("tbllistadotodoscorr"); listadostc.style.cssText = sombra;
    var tbllistadorecX = document.getElementById("tbllistadorecX"); tbllistadorecX.style.cssText = sombra;
}