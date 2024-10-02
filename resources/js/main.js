// Función para agregar un producto al carrito
function agregarAlCarrito(productoId) {
    // Envía una solicitud POST para agregar el producto al carrito
    fetch('/carrito/agregar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ producto_id: productoId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Producto agregado al carrito');
        } else {
            alert('Hubo un problema al agregar el producto');
        }
    })
    .catch(error => console.error('Error al agregar al carrito:', error));
}
