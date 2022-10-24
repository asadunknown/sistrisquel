jQuery(document).on('submit', '#formlg', function(event){
    event.preventDefault();
    
    jQuery.ajax({
        url: '../ajax/login.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){
            $('#botonlg').val('Validando...');
            $('#botonlg').prop("disabled", true);
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.error)
        {
            if(respuesta.tipo == 'Administracion' || respuesta.tipo == 'Sistemas')
            {
                location.href = 'dashboard.php';
            }
            else
            {
                location.href = 'dashboard.php';
            }
        }
        else
        {
            Swal.fire("Error!","El nombre de usuario o la contraseña son incorrectos","error");
            $('#botonlg').prop("disabled", false);
            $('#botonlg').val('Iniciar  Sesión...');
        }
        
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(resp){
        console.log("complete");
    });
});