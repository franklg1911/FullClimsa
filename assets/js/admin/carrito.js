$(document).ready(function() {
    // Agregar producto al carrito
    $('.agregar-carrito').on('click', function() {
        var productId = $(this).closest('.card').data('product-id');

        $.ajax({
            type: 'POST',
            url: '../../controller/agregarCarrito.php',
            data: { productId: productId },
            success: function(response) {
                // Actualizar contador de carrito (opcional)
                $('#cart-counter').text(response.totalItems);
                alert('Producto agregado al carrito');
            },
            error: function(err) {
                console.error('Error al agregar producto al carrito', err);
                alert('Error al agregar producto al carrito');
            }
        });
    });

    // Quitar producto del carrito
    $('.quitar-carrito').on('click', function() {
        var productId = $(this).closest('.card').data('product-id');

        $.ajax({
            type: 'POST',
            url: '../../controller/quitarProducto.php',
            data: { productId: productId },
            success: function(response) {
                // Actualizar contador de carrito (opcional)
                $('#cart-counter').text(response.totalItems);
                alert('Producto eliminado del carrito');
            },
            error: function(err) {
                console.error('Error al quitar producto del carrito', err);
                alert('Error al quitar producto del carrito');
            }
        });
    });
});
