$(document).ready(function() {
    $('#consultaReclamoForm').submit(function(event) {
        event.preventDefault();

        var nombre = $('#nombre').val();
        var correo = $('#correo').val();
        var mensaje = $('#mensaje').val();

        $.ajax({
            url: '../FullClimsa/controller/guardarConsulta.php',
            method: 'POST',
            dataType: 'json', // Esperamos una respuesta JSON del servidor
            data: {
                nombre: nombre,
                correo: correo,
                mensaje: mensaje
            },
            success: function(response) {
                if (response.success) {
                    // Si la consulta se envía correctamente, mostramos una alerta
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        type: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        // Limpiamos los campos del formulario después de enviar la consulta
                        $('#nombre').val('');
                        $('#correo').val('');
                        $('#mensaje').val('');
                    });
                } else {
                    // Si hay un error al enviar la consulta, mostramos una alerta de error
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        type: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            },
        });
    });
});
