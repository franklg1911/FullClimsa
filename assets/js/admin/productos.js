$(document).ready(function () {
   tablaProductos = $("#tablaProductos").DataTable({
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
    paging: false,
   }); 

   //Agregar productos
   $('#agregarProductosForm').submit(function (event) {
    event.preventDefault();

    var formData = new FormData(); 
    formData.append('nombre', $('#nombreAgregar').val());
    formData.append('descripcion', $('#descripcionAgregar').val());
    formData.append('precio', $('#precioAgregar').val());
    formData.append('stock', $("#stockAgregar").val());
    formData.append('categoria', $("#categoriaAgregar").val());
    formData.append('imagen', $('#imagenAgregar')[0].files[0]); 
    formData.append('id_proveedor', $("#proveedorAgregar").val());
    
    $.ajax({
      url: '../../controller/agregarProducto.php',
      method: 'POST',
      data: formData,
      processData: false, // Deshabilitar el procesamiento de datos
        contentType: false, // Deshabilitar el tipo de contenido
        success: function (response) {
            alert(response);
            // Recargar la página
            location.reload();
        },
    });
  });

    //Editar productos
    $('.editarBtn').click(function () {
      //Obtener los datos
      var id = $(this).data('id');
      var idProveedor = $(this).closest('tr').find('td:eq(1)').text();
      var proveedor = $(this).closest('tr').find('td:eq(2)').text();
      var nombre = $(this).closest('tr').find('td:eq(3)').text();
      var descripcion = $(this).closest('tr').find('td:eq(4)').text();
      var precio = $(this).closest('tr').find('td:eq(5)').text();
      var stock = $(this).closest('tr').find('td:eq(6)').text();
      var categoria = $(this).closest('tr').find('td:eq(7)').text();
      // URL de la imagen actual
      var imagenActual = $(this).closest('tr').find('td:eq(8) img').attr('src');
      $('#imagenActual').attr('src', imagenActual);

      //Llenar los campos
      $('#userId').val(id);
      $('#proveedorId').val(idProveedor);
      $('#proveedorEditar').val(idProveedor); 
      $('#nombre').val(nombre);
      $('#descripcion').val(descripcion);
      $('#precio').val(precio);
      $('#stock').val(stock);
      $('#categoria').val(categoria);
  });

  //Seleccionamos una nueva img
  $('#nuevaImagen').change(function () {
        // Obtener el archivo de imagen seleccionado
        var imagenSeleccionada = this.files[0];
        // Mostrar una vista previa de la nueva imagen en el modal
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagenActual').attr('src', e.target.result);
        };
        reader.readAsDataURL(imagenSeleccionada);
    });

    // Guardar cambios
    $('#guardarCambiosBtn').click(function () {
        var id = $('#userId').val();
        var id_proveedor = $('#proveedorEditar').val();
        var nombre = $('#nombre').val();
        var descripcion = $('#descripcion').val();
        var precio = $('#precio').val();
        var stock = $('#stock').val();
        var categoria = $('#categoria').val();
        var nuevaImagen = $('#nuevaImagen').prop('files')[0];

        // Crear un objeto FormData para enviar los datos del formulario
        var formData = new FormData();
        formData.append('id', id);
        formData.append('id_proveedor', id_proveedor);
        formData.append('nombre', nombre);
        formData.append('descripcion', descripcion);
        formData.append('precio', precio);
        formData.append('stock', stock);
        formData.append('categoria', categoria);
        formData.append('nuevaImagen', nuevaImagen);

        $.ajax({
            url: '../../controller/editarProducto.php',
            method: 'POST',
            data: formData,
            processData: false, // Deshabilitar el procesamiento de datos
            contentType: false, // Deshabilitar el tipo de contenido
            success: function (response) {
                console.log(response);
                alert("Producto actualizado correctamente");
                // Recargar la página o realizar otras acciones necesarias
                location.reload();
            },
        });
    });

    //Eliminar producto
    $('.eliminarBtn').click(function () {
      //Obtenemos el ID del producto a eliminar
      var id = $(this).data('id');
      //Confirmar eliminación
      if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
        $.ajax({
            url: '../../controller/eliminarProducto.php',
            method: 'POST',
            data: { id: id },
            success: function (response) {
                alert(response);
                // Recargar la página o actualizar la tabla de productos
                location.reload();
            },
        });
      }
    });
});