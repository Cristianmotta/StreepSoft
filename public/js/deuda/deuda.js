
        const nombreInput = document.getElementById('nombreCompleto');
        const fechaInput = document.getElementById('fechaDeuda');
        const montoInput = document.getElementById('montoDeuda');
        const tipoSelect = document.getElementById('tipoSelect');
        const searchInput = document.getElementById('searchAlumno');

        const summaryNombre = document.getElementById('summaryNombre');
        const summaryFecha = document.getElementById('summaryFecha');
        const summaryTipo = document.getElementById('summaryTipo');
        const summaryMonto = document.getElementById('summaryMonto');

        function formatFecha(dateString) {
            const date = new Date(dateString);
            if (Number.isNaN(date.getTime())) return '';
            return date.toLocaleDateString('es-ES', {
                day: '2-digit',
                month: '2-digit',
                year: '2-digit'
            });
        }

        function formatMonto(value) {
            const number = Number(value);
            if (Number.isNaN(number)) return '0.00';
            return number.toLocaleString('es-ES', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function actualizarResumen() {
            summaryNombre.textContent = nombreInput.value || '—';
            summaryFecha.textContent = formatFecha(fechaInput.value) || '—';
            summaryTipo.textContent = tipoSelect.value;
            summaryMonto.textContent = formatMonto(montoInput.value);
        }

        nombreInput.addEventListener('input', actualizarResumen);
        fechaInput.addEventListener('change', actualizarResumen);
        montoInput.addEventListener('input', actualizarResumen);
        tipoSelect.addEventListener('change', actualizarResumen);

        document.getElementById('assignBtn').addEventListener('click', () => {
            alert('Deuda asignada correctamente. Puedes cambiar la fecha, el valor y el tipo desde el formulario.');
        });

        searchInput.addEventListener('input', () => {
            // Aquí podrías agregar lógica para buscar alumnos reales.
            console.log('Buscar alumno:', searchInput.value);
        });

        actualizarResumen();
    