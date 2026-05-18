// Funcion para ocultar mensajes
const autoHide = (id) => {
  const el = document.getElementById(id);
    if (el) {
      setTimeout(() => {
        el.style.transition = "opacity 0.5s ease";
        el.style.opacity = "0";
        setTimeout(() => el.remove(), 500);
      }, 3000);
    }
};

autoHide("mensajeError");

// 1. Agarramos los elementos del HTML
//const form = document.querySelector('form');
//const email = document.getElementById('email');
//const password = document.getElementById('password');

// 2. Escuchamos cuando el usuario hace clic en "Login Now"
//form.addEventListener('submit', function(e) {

  // Evita que la página se recargue
  //e.preventDefault();

  // 3. Validar que no estén vacíos
  //if (email.value === '' || password.value === '') {
    //alert('Por favor completa todos los campos');
    //return; // Para aquí, no sigue
  //}

  // 4. Validar formato del email
  //if (!email.value.includes('@')) {
    //alert('Por favor ingresa un email válido');
    //return;
  //}

  // 5. Validar largo de contraseña
  //if (password.value.length < 6) {
    //alert('La contraseña debe tener mínimo 6 caracteres');
    //return;
  //}

  // 6. Si todo está bien
  //alert('¡Login exitoso! Bienvenido 🎉');
//});

