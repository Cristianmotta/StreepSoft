const inputs = document.querySelectorAll('.pin-input');
const btnVerificar = document.querySelector('.buttonRecover');

let intentos = 0;
const MAX_INTENTOS = 5;
const TIEMPO_BLOQUEO = 30;

inputs.forEach((input, i) => {
    input.addEventListener('keydown', (e) => {
        const permitidos = ['Backspace', 'Delete', 'Tab', 'ArrowLeft', 'ArrowRight'];
        if (!/^\d$/.test(e.key) && !permitidos.includes(e.key)) {
            e.preventDefault();
        }

        // Backspace: borra y vuelve a la anterior, bloqueándola
        if (e.key === 'Backspace' && input.value === '' && i > 0) {
            inputs[i - 1].disabled = false;
            inputs[i - 1].value = '';
            inputs[i - 1].focus();
            input.disabled = true; // bloquea la actual de nuevo
        }
    });

    input.addEventListener('input', () => {
        input.value = input.value.replace(/\D/g, '');

        // Al completar, habilita la siguiente y salta
        if (input.value.length === 1 && i < inputs.length - 1) {
            inputs[i + 1].disabled = false;
            inputs[i + 1].focus();
        }
    });
});

// Verificar PIN - fix del redirect
btnVerificar.addEventListener('click', (e) => {
    e.preventDefault();

    if (btnVerificar.disabled) return;

    const pin = Array.from(inputs).map(i => i.value).join('');

    if (pin.length < 5) {
        mostrarMensaje('Por favor ingresa los 5 dígitos.', 'advertencia');
        return;
    }

    // Cambia const true por la validación real
    // const pinCorrecto = true;
    const pinCorrecto = pin === '12345';

    if (pinCorrecto) {
        mostrarMensaje('PIN correcto ✓', 'exito');
        setTimeout(() => {
            window.location.href = 'actualizarContraseña.php';
        }, 600); // pequeña pausa para que vean el mensaje
    } else {
        intentos++;
        const restantes = MAX_INTENTOS - intentos;

        if (intentos >= MAX_INTENTOS) {
            bloquear();
        } else {
            mostrarMensaje(`PIN incorrecto. Te quedan ${restantes} intento(s).`, 'error');
            limpiarInputs();
        }
    }
});

function bloquear() {
    let segundos = TIEMPO_BLOQUEO;
    inputs.forEach(i => i.disabled = true);
    btnVerificar.disabled = true;
    btnVerificar.style.backgroundColor = '#888';

    const intervalo = setInterval(() => {
        mostrarMensaje(`Demasiados intentos. Espera ${segundos}s para continuar.`, 'error');
        segundos--;

        if (segundos < 0) {
            clearInterval(intervalo);
            intentos = 0;
            inputs.forEach((input, i) => {
                input.value = '';
                input.disabled = i !== 0; // solo habilita la primera
            });
            btnVerificar.disabled = false;
            btnVerificar.style.backgroundColor = '#f5c400';
            inputs[0].focus();
            mostrarMensaje('Ya puedes intentarlo de nuevo.', 'advertencia');
        }
    }, 1000);
}

function limpiarInputs() {
    inputs.forEach((input, i) => {
        input.value = '';
        input.disabled = i !== 0; // solo la primera queda habilitada
    });
    inputs[0].focus();
}

function mostrarMensaje(texto, tipo) {
    let msg = document.querySelector('.pin-mensaje');
    if (!msg) {
        msg = document.createElement('p');
        msg.className = 'pin-mensaje';
        btnVerificar.parentElement.insertBefore(msg, btnVerificar);
    }
    msg.textContent = texto;
    msg.style.color = tipo === 'error' ? '#ff4d4d'
        : tipo === 'exito' ? '#4dff88'
            : '#f5c400';
}