const nuevaPassword =
    document.getElementById('nuevaPassword');

const confirmarPassword =
    document.getElementById('confirmarPassword');

const strengthFill =
    document.getElementById('strengthFill');

const strengthText =
    document.getElementById('strengthText');

const reqMsg =
    document.getElementById('reqMsg');

const matchMsg =
    document.getElementById('matchMsg');

const form =
    document.getElementById('formPassword');


// ======================================
// FUERZA PASSWORD
// ======================================

nuevaPassword.addEventListener('input', () => {

    const value =
        nuevaPassword.value;

    let fuerza = 0;

    // Longitud
    if (value.length >= 8) {

        fuerza++;
    }

    // Mayúscula
    if (/[A-Z]/.test(value)) {

        fuerza++;
    }

    // Número
    if (/\d/.test(value)) {

        fuerza++;
    }

    // Especial
    if (/[\W]/.test(value)) {

        fuerza++;
    }

    // Texto fuerza
    switch (fuerza) {

        case 1:

            strengthFill.style.width = '25%';
            strengthText.textContent = 'Débil';

            break;

        case 2:

            strengthFill.style.width = '50%';
            strengthText.textContent = 'Media';

            break;

        case 3:

            strengthFill.style.width = '75%';
            strengthText.textContent = 'Buena';

            break;

        case 4:

            strengthFill.style.width = '100%';
            strengthText.textContent = 'Segura';

            break;

        default:

            strengthFill.style.width = '0%';
            strengthText.textContent = '';
    }

    // Requisitos
    reqMsg.textContent =
        'Debe tener 8 caracteres, mayúscula, número y símbolo.';
});


// ======================================
// CONFIRMAR PASSWORD
// ======================================

confirmarPassword.addEventListener('input', () => {

    if (
        confirmarPassword.value ===
        nuevaPassword.value
    ) {

        matchMsg.textContent =
            'Las contraseñas coinciden';

        matchMsg.style.color =
            'green';

    } else {

        matchMsg.textContent =
            'Las contraseñas no coinciden';

        matchMsg.style.color =
            'red';
    }
});


// ======================================
// VALIDAR FORM
// ======================================

form.addEventListener('submit', (e) => {

    const password =
        nuevaPassword.value;

    const confirmar =
        confirmarPassword.value;

    // Validar longitud
    if (password.length < 8) {

        e.preventDefault();

        Swal.fire({
            icon: 'error',
            title: 'Contraseña insegura',
            text: 'Debe tener mínimo 8 caracteres'
        });

        return;
    }

    // Validar coincidencia
    if (password !== confirmar) {

        e.preventDefault();

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Las contraseñas no coinciden'
        });

        return;
    }
});