$(document).ready(function() {
    $('#formulario_crear_actividad').submit(function(e) {
        e.preventDefault(); 
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                if(response.success) {
                    Swal.fire('Éxito', response.message, 'success');
                    form[0].reset();
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'No se pudo conectar con el servidor', 'error');
            }
        });
    });
});
