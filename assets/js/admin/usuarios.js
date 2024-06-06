$(document).ready(function () {
   tablaUsuarios = $("#tablaUsuarios").DataTable({
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

   //Agregar usuario
   $('#agregarUsuariosForm').submit(function (event) {
    event.preventDefault();

     var nombre = $('#nombreAgregar').val();
     var email = $('#emailAgregar').val();
     var contraseña = $('#contraseñaAgregar').val();
     var tipo = $("#tipoAgregar").val();

     $.ajax({
      url: '../../controller/agregarUsuario.php',
      method: 'POST',
      data: {
        nombre: nombre,
        email: email,
        contraseña: contraseña,
        tipo: tipo
      },
      success: function (response) {
        alert(response);
        // Recargar la página
        location.reload();
      },
     });
   });

   //Editar usuario
   $('.editarBtn').click(function () {
      //Obtener los datos
      var id = $(this).data('id');
      var nombre = $(this).closest('tr').find('td:eq(1)').text();
      var email = $(this).closest('tr').find('td:eq(2)').text();
      var contraseña = $(this).closest('tr').find('td:eq(3)').text();
      var tipo = $(this).closest('tr').find('td:eq(4)').text();

      //Llenar los campos del formulario
      $('#userId').val(id);
      $('#nombre').val(nombre);
      $('#email').val(email);
      $('#contraseña').val(contraseña);
      $('#tipo').val(tipo);
   });

   $('#guardarCambiosBtn').click(function () {
    var id = $('#userId').val();
    var nombre = $('#nombre').val();
    var email = $('#email').val();
    var contraseña = $('#contraseña').val();
    var tipo = $('#tipo').val();

    if (nombre === "" || email === "" || contraseña === "" || tipo === "") {
      alert("Todos los campos son obligatorios");
      return;
    }

    $.ajax({
        url: '../../controller/editarUsuario.php',
        method: 'POST',
        data: {
            id: id,
            nombre: nombre,
            email: email,
            contraseña: contraseña,
            tipo: tipo
        },
        success: function (response) {
            console.log(response);
            alert("Acutalizado correctamente")
            location.reload();//Recarga la página
        }
    });
  });

  //Eliminar usuario
  $('.eliminarBtn').click(function () {
    var id = $(this).data('id');

    if (confirm("¿Estás seguro de eliminar este usuario?")) {
      $.ajax({
          url: '../../controller/eliminarUsuario.php',
          method: 'POST',
          data: {
              id: id
          },
          success: function (response) {
              console.log(response);
              location.reload();
          }
      });
    }
  });
   
});