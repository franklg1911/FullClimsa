$(document).ready(function() {
    var carrito = [];

    // Función para agregar producto al carrito
    $('.agregar-btn').click(function() {
        var productoId = $(this).data('producto-id');

        $.ajax({
            type: 'POST',
            url: '../../controller/agregarCarrito.php', 
            data: { producto_id: productoId }, 
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    agregarProductoAlCarrito(response.producto);
                    console.log(response.message);
                } else {
                    console.error('Error al agregar producto:', response.message);
                }
            },
        });
    });

    // Función para agregar el producto a la tabla del carrito
    function agregarProductoAlCarrito(producto) {
        carrito.push(producto); // Agregar el producto al arreglo carrito

        var fila = `
            <tr>
                <td>${producto.nombre}</td>
                <td>${producto.descripcion}</td>
                <td>S/.${producto.precio}</td>
                <td><button class="btn btn-danger eliminar-btn">Eliminar</button></td>
            </tr>
        `;
        $('#tablaCarrito tbody').append(fila);

        // Actualizar total del carrito
        calcularTotalCarrito();

        // Actualizar contador de productos en el carrito
        actualizarContadorCarrito();
    }

    // Función para calcular el total del carrito
    function calcularTotalCarrito() {
        var total = 0;
        carrito.forEach(function(producto) {
            total += parseFloat(producto.precio);
        });
        $('#tablaCarrito tfoot td:eq(3)').text('S/.' + total.toFixed(2));
    }

    // Función para actualizar el contador del carrito
    function actualizarContadorCarrito() {
        var cantidadProductos = carrito.length;
        $('#cart-counter').text(cantidadProductos);

        $('.quitar-btn').hide();
        carrito.forEach(function(producto) {
            $('.quitar-btn[data-producto-id="' + producto.id + '"]').show();
        });
    }

    // Función para quitar producto del carrito
    $(document).on('click', '.eliminar-btn', function() {
        var index = $(this).closest('tr').index();
        carrito.splice(index, 1);
        $(this).closest('tr').remove();
        calcularTotalCarrito();
        actualizarContadorCarrito();
    });
});
