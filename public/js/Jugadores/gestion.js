document.addEventListener('DOMContentLoaded', function() {
    const inputBuscar = document.getElementById('buscarInput');
    const filas = document.querySelectorAll('.tabla tbody tr');
    const btnLimpiar = document.getElementById('btnLimpiarBusqueda');

    function filtrarTabla() {
        const texto = inputBuscar.value.toLowerCase().trim();
        
        filas.forEach(fila => {
            // Obtener todo el texto de la fila
            const textoFila = fila.textContent.toLowerCase();
            // Si el texto buscado está contenido, se muestra; si no, se oculta
            fila.style.display = textoFila.includes(texto) ? '' : 'none';
        });
    }

    // Al escribir
    inputBuscar.addEventListener('input', filtrarTabla);

    // Botón para limpiar el campo
    btnLimpiar.addEventListener('click', function() {
        inputBuscar.value = '';
        filtrarTabla();  // Actualizar la vista (mostrar todo)
    });
});