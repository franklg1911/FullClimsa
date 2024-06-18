  $(document).ready(function() {
    var carrito = [];

    // Función para agregar producto al icono de carrito contador
    $('.agregar-btn').click(function() {
      var productoId = $(this).data('producto-id');
      carrito.push(productoId);
      actualizarCarrito();
    });

    // Función para quitar producto del icono de carrito contador
    $('.quitar-btn').click(function() {
      var productoId = $(this).data('producto-id');
      var index = carrito.indexOf(productoId);
      if (index !== -1) {
        carrito.splice(index, 1);
        actualizarCarrito();
      }
    });

    // Función para actualizar el contador del carrito
    function actualizarCarrito() {
      var cantidadProductos = carrito.length;
      $('#cart-counter').text(cantidadProductos);

      // Mostrar/ocultar botones de quitar según el estado del carrito
      $('.quitar-btn').hide();
      carrito.forEach(function(productoId) {
        $('.quitar-btn[data-producto-id="' + productoId + '"]').show();
      });
    }
  });

