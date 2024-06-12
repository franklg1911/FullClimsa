document.addEventListener('DOMContentLoaded', () => {
    // Seleccionar todos los botones de "Agregar" por su clase
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    // Iterar sobre cada botón y agregar un controlador de eventos clic
    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Obtener el valor actual del contador del carrito
            let currentCount = parseInt(document.getElementById('cart-counter').textContent);

            // Aumentar el contador segun los productos
            currentCount++;

            // Actualizar el contador del carrito visualmente
            document.getElementById('cart-counter').textContent = currentCount;
        });
    });
});