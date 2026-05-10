let index = 0;
const slides = document.querySelectorAll('.slide');
const total = slides.length;
const contenedor = document.querySelector('.imagenes');
const indicadores = document.querySelector('.indicadores')

/* Crear punticos */

for (let i = 0; i < total; i++){
    let punto = document.createElement('span');
    punto.addEventListener('click', () => {
        index = i;
        actualizar();
    });
    indicadores.appendChild(punto);
}

function actualizar() {
    contenedor.style.transform = `translateX(-${index * 100}%)`;

    document.querySelectorAll('.indicadores span').forEach((p, i) => {
        p.classList.toggle('activo', i === index);
    });
}

/* Botones */
document.querySelector('.next').onclick = () => {
    index = (index + 1) % total;
    actualizar();
}

document.querySelector('.prev').onclick = () => {
    index = (index - 1 + total) % total;
    actualizar();
}

/* Automatico */

setInterval(() => {
    index = (index + 1) % total;
    actualizar();
}, 6000);

actualizar();
