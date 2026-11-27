import loadSection from "./loader.js";
import "../notificaciones/notificaciones.js";
import { initAyuda } from "../ayuda/ayuda.js";

document.addEventListener('DOMContentLoaded', async () => {
    try {
        await loadSection('nav-card', '/streepsoft/nav-menu');

        // La navegación se inserta mediante innerHTML, por lo que los scripts
        // incluidos en el fragmento no se ejecutan. Inicializamos aquí el panel.
        if (typeof window.initStreepNotifications === 'function') {
            window.initStreepNotifications();
        }

        // Botón "?" con la guía del módulo actual
        initAyuda();
    } catch (error) {
        console.error('No se pudo inicializar la navegación:', error);
    }
});
