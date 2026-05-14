const nuevaPassword     = document.getElementById('nuevaPassword');
const confirmarPassword = document.getElementById('confirmarPassword');
const btnActualizar     = document.getElementById('btnActualizar');
const strengthFill      = document.getElementById('strengthFill');
const strengthText      = document.getElementById('strengthText');
const reqMsg            = document.getElementById('reqMsg');
const matchMsg          = document.getElementById('matchMsg');
const strengthContainer = document.querySelector('.password-strength');

const reglas = [
    { regex: /^.{8,16}$/,                                    msg: 'Debe tener entre 8 y 16 caracteres' },
    { regex: /[A-Z]/,                                         msg: 'Agrega al menos una letra mayúscula' },
    { regex: /[a-z]/,                                         msg: 'Agrega al menos una letra minúscula' },
    { regex: /[0-9]/,                                         msg: 'Agrega al menos un número' },
    { regex: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/,       msg: 'Agrega al menos un símbolo (!@#$...)' },
];

// ── Eventos ──────────────────────────────────────────────
nuevaPassword.addEventListener('input', () => {
    if (nuevaPassword.value.length > 16) {
        nuevaPassword.value = nuevaPassword.value.slice(0, 16);
    }
    validarPassword();
    validarMatch();
});

confirmarPassword.addEventListener('input', validarMatch);

btnActualizar.addEventListener('click', () => {
    validarPassword();
    validarMatch();

    if (!todoCumplido()) return;

    reqMsg.textContent  = '¡Contraseña actualizada correctamente!';
    reqMsg.style.color  = '#4dff88';

    setTimeout(() => {
        window.location.href = 'login.html';
    }, 1000);
});

// ── Funciones ─────────────────────────────────────────────
function validarPassword() {
    const val = nuevaPassword.value;

    // Sin texto: limpia todo
    if (val === '') {
        reqMsg.textContent = '';
        strengthFill.style.width = '0%';
        strengthText.textContent = '';
        strengthContainer.style.display = 'none';
        return;
    }

    strengthContainer.style.display = 'flex';

    // Primera regla que falla
    const falla = reglas.find(r => !r.regex.test(val));

    if (falla) {
        reqMsg.textContent = '⚠ ' + falla.msg;
        reqMsg.style.color = '#f5c400';
    } else {
        reqMsg.textContent = '✓ Contraseña válida';
        reqMsg.style.color = '#4dff88';
    }

    // Barra de seguridad
    const cumplidos  = reglas.filter(r => r.regex.test(val)).length;
    const porcentaje = (cumplidos / reglas.length) * 100;
    strengthFill.style.width = porcentaje + '%';

    if (cumplidos <= 2) {
        strengthFill.style.backgroundColor = '#ff4d4d';
        strengthText.textContent            = 'Débil';
        strengthText.style.color            = '#ff4d4d';
    } else if (cumplidos <= 4) {
        strengthFill.style.backgroundColor = '#f5c400';
        strengthText.textContent            = 'Media';
        strengthText.style.color            = '#f5c400';
    } else {
        strengthFill.style.backgroundColor = '#4dff88';
        strengthText.textContent            = 'Fuerte';
        strengthText.style.color            = '#4dff88';
    }
}

function validarMatch() {
    if (confirmarPassword.value === '') {
        matchMsg.textContent = '';
        return;
    }
    if (nuevaPassword.value === confirmarPassword.value) {
        matchMsg.textContent = '✓ Las contraseñas coinciden';
        matchMsg.style.color = '#4dff88';
    } else {
        matchMsg.textContent = '✗ Las contraseñas no coinciden';
        matchMsg.style.color = '#ff4d4d';
    }
}

function todoCumplido() {
    return reglas.every(r => r.regex.test(nuevaPassword.value))
        && nuevaPassword.value === confirmarPassword.value;
}

// Oculta la barra al inicio
strengthContainer.style.display = 'none';