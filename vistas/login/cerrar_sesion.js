function cerrar_sesion()
{
    Swal.fire
    ({
        title: '¿Seguro que desea salir?',
        icon: 'warning',
        showCancelButton: true, 
        confirmButtonColor: '#3085d6', 
        cancelButtonColor: '#d33', 
        confirmButtonText: 'Sí, cerrar sesión!', 
        cancelButtonText: 'Cancelar'
    }).then((result) => 
    {
        if (result.isConfirmed) 
        {
            location.href ="login/cerrar_sesion.php";
        }
        else
        {
            
        }
    })
}