document.addEventListener('DOMContentLoaded', () => {

    // Tomamos TODOS los botones "Descargar" de la tabla de reportes de una vez
    const botonesDescargar = document.querySelectorAll('.boton-descargar');

    botonesDescargar.forEach((boton) => {
        boton.addEventListener('click', () => {
            
            // 1. y 2. Encontrar la fila y el <select>
            const fila = boton.closest('tr');
            const select = fila.querySelector('.select-formato');
            
            // 3. Leer el tipo de reporte y el formato
            const tipo = boton.dataset.tipo;
            const formato = select.value;

            // --- EFECTO VISUAL ---
            const textoOriginal = boton.innerHTML; 
            boton.innerHTML = '<i class="fi fi-rr-spinner-alt"></i> Descargando...';
            boton.style.opacity = '0.7';
            boton.style.pointerEvents = 'none'; 

            // Restaurar el botón después de 2.5 segundos
            setTimeout(() => {
                boton.innerHTML = textoOriginal;
                boton.style.opacity = '1';
                boton.style.pointerEvents = 'auto';
            }, 2500);

            // 4. Armar la URL hacia el controlador 
            const url = `/streepsoft/reportes/generar?tipo=${tipo}&formato=${formato}`;

            // 5. Disparar la descarga. 
            window.location.href = url;
        });
    });

});