document.addEventListener("DOMContentLoaded", () => {
    // Captura de elementos usando tus IDs exactos
    const nuevaPassword = document.getElementById("nuevaPassword");
    const confirmarPassword = document.getElementById("confirmarPassword");
    const strengthContainer = document.querySelector(".password-strength");
    const strengthFill = document.getElementById("strengthFill");
    const strengthText = document.getElementById("strengthText");
    const reqMsg = document.getElementById("reqMsg");
    const matchMsg = document.getElementById("matchMsg");
    const btnActualizar = document.getElementById("btnActualizar");

    // Función para validar la coincidencia de las contraseñas
    function verificarCoincidencia() {
        const pass = nuevaPassword.value;
        const confPass = confirmarPassword.value;

        if (confPass.length === 0) {
            matchMsg.textContent = "";
            btnActualizar.disabled = false;
            return;
        }

        if (pass === confPass) {
            matchMsg.textContent = "✓ Las contraseñas coinciden.";
            matchMsg.style.color = "#2ecc71"; // Verde exitoso
            btnActualizar.disabled = false; // Habilita el botón
        } else {
            matchMsg.textContent = "✕ Las contraseñas no coinciden.";
            matchMsg.style.color = "#ff4d4d"; // Rojo error
            btnActualizar.disabled = true; // Bloquea el envío si están mal
        }
    }

    // Escuchar cuando escriben en el primer input (Fuerza y Requisitos)
    nuevaPassword.addEventListener("input", (e) => {
        const value = e.target.value;

        if (value.length === 0) {
            if (strengthContainer) strengthContainer.classList.remove("visible");
            strengthFill.style.width = "0%";
            strengthText.textContent = "";
            reqMsg.textContent = "";
            verificarCoincidencia();
            return;
        }

        if (strengthContainer) strengthContainer.classList.add("visible");

        let points = 0;
        let feedback = [];

        // Evaluaciones de seguridad
        if (value.length >= 8) { points++; } else { feedback.push("mínimo 8 caracteres"); }
        if (/[A-Z]/.test(value)) { points++; } else { feedback.push("una mayúscula"); }
        if (/[0-9]/.test(value)) { points++; } else { feedback.push("un número"); }
        if (/[^A-Za-z0-9]/.test(value)) { points++; } else { feedback.push("un carácter especial"); }

        // Cambios de color y tamaños según la fuerza
        if (points <= 1) {
            strengthFill.style.width = "33%";
            strengthFill.style.backgroundColor = "#ff4d4d"; // Rojo
            strengthText.textContent = "Débil";
            strengthText.style.color = "#ff4d4d";
        } else if (points === 2 || points === 3) {
            strengthFill.style.width = "66%";
            strengthFill.style.backgroundColor = "#f5c400"; // Tu amarillo corporativo
            strengthText.textContent = "Medio";
            strengthText.style.color = "#f5c400";
        } else if (points === 4) {
            strengthFill.style.width = "100%";
            strengthFill.style.backgroundColor = "#2ecc71"; // Verde
            strengthText.textContent = "Fuerte";
            strengthText.style.color = "#2ecc71";
        }

        // Mostrar lo que falta en el párrafo reqMsg
        if (feedback.length > 0) {
            reqMsg.textContent = "Te falta: " + feedback.join(", ") + ".";
            reqMsg.style.color = "#cccccc";
        } else {
            reqMsg.textContent = "¡Contraseña excelente y segura!";
            reqMsg.style.color = "#2ecc71";
        }

        // Ejecutar también aquí por si cambian la primera contraseña después de escribir la segunda
        verificarCoincidencia();
    });

    // Escuchar cuando escriben en el segundo input (Confirmación)
    confirmarPassword.addEventListener("input", verificarCoincidencia);
});