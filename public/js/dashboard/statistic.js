const ctx = document.getElementById('grafica');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            '30 Enero 2026', '30 Febrero 2026', '30 Marzo 2026', '30 Abril 2026', 
            '30 Mayo 2026', '30 Junio 2026', '30 Julio 2026', '30 Agosto 2026', 
            '30 Septiembre 2026', '30 Noviembre 2026', '30 Diciembre 2026'
        ],
        datasets: [{
            label: 'Ventas',
            data: [11, 8, 17, 5, 9, 14, 15, 14, 12, 12, 17],
            backgroundColor: '#D09E10',
            borderRadius: 2,
            barPercentage: 0.9 // Grosor de las barras
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(72, 69, 69, 0.27)', // Líneas horizontales tenues
                },
                ticks: {
                    color: '#fff',
                    stepSize: 8
                }
            },
            x: {
                grid: {
                    display: false // Sin líneas verticales
                },
                ticks: {
                    color: '#fff',
                    maxRotation: 0,
                    minRotation: 0,
                    font: { size: 7.5 }
                }
            }
        }
    }
});