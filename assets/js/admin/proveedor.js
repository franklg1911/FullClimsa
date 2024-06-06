$(document).ready(function () {
   tablaProveedor = $("#tablaProveedor").DataTable({
     language: {
      lengthMenu: "Mostrar _MENU_ registros",
      zeroRecords: "<strong>No se encontraron resultados</strong>",
      info: "Mostrando registros del <strong>_START_</strong> al <strong>_END_</strong> de un total de <strong>_TOTAL_</strong> registros.",
      infoEmpty:
        "Mostrando registros del <strong> 0 </strong> al <strong> 0 </strong> de un total de <strong> 0 </strong> registros.",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      sSearch: "Buscar:",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Ultimo",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      sProcessing: "Procesando....",
    },
    scrollX: true,
   }); 


   //Agregar proveedor
   $('#agregarProveedorForm').submit(function () {
    event.preventDefault();

    var razon_social = $('#razonSocial').val();
    var ruc = $('#ruc').val();
    var celular = $('#celular').val();
    var correo = $('#correo').val();
    var direccion = $('#direccion').val();
    var provincia = $('#provincia').val();
    var departamento = $('#departamento').val();
    var distrito = $('#distrito').val();


    $.ajax({
        url: '../../controller/agregarProveedor.php',
        method: 'POST',
        data: {
            ruc: ruc,
            razon_social: razon_social,
            direccion: direccion,
            distrito: distrito,
            provincia: provincia,
            departamento: departamento,
            celular: celular,
            correo: correo,
            direccion: direccion
        },
        success: function (response) {
            alert(response);
            //Recargue la pagina
            location.reload();
        }
    });
   });

   
   //Consultar RUC
    $("#consultarRUC").click(function () {
        var ruc = $("#ruc").val();

        if (ruc.trim() === '' || ruc.length !== 11) {
            Swal.fire({
                type: 'warning',
                title: 'Advertencia',
                text: 'Por favor, ingresa un RUC válido de 11 dígitos antes de consultar.',
            });
            return;
        }

        $.ajax({
            url: '../../api/consultarRUC.php',
            type: 'POST',
            dataType: 'json',
            data: {
                ruc: ruc,
            },
            success: function (apiResponse) {
                console.log(apiResponse);
                actualizarCampos(apiResponse);
            },
            error: function (error) {
                console.error('Error en la llamada a la API', error);
            }
        });
    });
    function actualizarCampos(apiResponse) {
        $("#departamento").val(apiResponse.departamento);
        $("#razonSocial").val(apiResponse.nombre);
        $("#provincia").val(apiResponse.provincia);
        $("#distrito").val(apiResponse.distrito);
        $("#direccion").val(apiResponse.direccion);
    }

});