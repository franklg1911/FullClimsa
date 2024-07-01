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

   //Editar proveedor
   $('.editarBtn').click(function () {
      //Obtener los datos
      var id = $(this).data('id');
      var ruc = $(this).closest('tr').find('td:eq(1)').text();
      var razon_social = $(this).closest('tr').find('td:eq(2)').text();
      var direccion = $(this).closest('tr').find('td:eq(3)').text();
      var distrito = $(this).closest('tr').find('td:eq(4)').text();
      var provincia = $(this).closest('tr').find('td:eq(5)').text();
      var departamento = $(this).closest('tr').find('td:eq(6)').text();
      var celular = $(this).closest('tr').find('td:eq(7)').text();
      var correo = $(this).closest('tr').find('td:eq(8)').text();

      //Llenar los campos del formulario
      $('#userId').val(id);
      $('#ruc').val(ruc);
      $('#razonSocial').val(razon_social);
      $('#direccion').val(direccion);
      $('#distrito').val(distrito);
      $('#provincia').val(provincia);
      $('#departamento').val(departamento);
      $('#celular').val(celular);
      $('#correo').val(correo);
   });

   $('#guardarCambiosBtn').click(function () {
    var id = $('#userId').val();
    var ruc = $('#ruc').val();
    var razon_social = $('#razonSocial').val();
    var direccion = $('#direccion').val();
    var distrito = $('#distrito').val();
    var provincia = $('#provincia').val();
    var departamento = $('#departamento').val();
    var celular = $('#celular').val();
    var correo = $('#correo').val();

    if (ruc === "" || razon_social === "" || direccion === "" || distrito === "" || provincia === "" || departamento === "" || celular === "" || correo === "" ) {
      alert("Todos los campos son obligatorios");
      return;
    }

    $.ajax({
        url: '../../controller/editarProveedor.php',
        method: 'POST',
        data: {
            id: id,
            ruc: ruc,
            razon_social: razon_social,
            direccion: direccion,
            distrito: distrito,
            provincia : provincia,
            departamento: departamento,
            celular : celular,
            correo : correo,
        },
        success: function (response) {
            console.log(response);
            alert("Acutalizado correctamente")
            location.reload();//Recarga la página
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