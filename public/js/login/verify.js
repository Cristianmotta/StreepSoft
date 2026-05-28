document.addEventListener("DOMContentLoaded", () => {
            const inputs = document.querySelectorAll(".pin-container .pin-input");

            inputs.forEach((input, index) => {
                // 1. Controlar lo que se escribe y avanzar
                input.addEventListener("input", (e) => {
                    const value = e.target.value;
                    
                    // Validar que solo sean números (si deseas permitir letras, borra esta línea)
                    e.target.value = value.replace(/[^0-9]/g, "");

                    if (e.target.value.length >= 1) {
                        // Si no es el último input, pasar al siguiente
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                    }
                });

                // 2. Controlar la tecla de borrar (Backspace) para retroceder
                input.addEventListener("keydown", (e) => {
                    if (e.key === "Backspace") {
                        // Si el campo actual está vacío, retroceder al anterior y borrarlo
                        if (input.value === "" && index > 0) {
                            inputs[index - 1].focus();
                            inputs[index - 1].value = "";
                        } else {
                            // Si tiene texto, simplemente lo borra
                            input.value = "";
                        }
                        e.preventDefault();
                    }
                });

                // 3. Soporte para Pegar (Paste) un código completo (ej: 12345)
                input.addEventListener("paste", (e) => {
                    e.preventDefault();
                    const data = e.clipboardData.getData("text").trim();
                    
                    // Validar que sean solo números y correspondan al tamaño
                    if (/^\d+$/.test(data)) {
                        const digits = data.split("");
                        inputs.forEach((inp, idx) => {
                            if (digits[idx]) {
                                inp.value = digits[idx];
                            }
                        });
                        // Poner el foco en el último input lleno o en el botón de enviar
                        const focusIndex = Math.min(digits.length, inputs.length - 1);
                        inputs[focusIndex].focus();
                    }
                });
            });
        });