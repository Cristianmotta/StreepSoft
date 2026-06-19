import  loadSection  from "./loader.js";

document.addEventListener('DOMContentLoaded', () => {
    Promise.all([
        loadSection('nav-card', '/streepsoft/app/views/navegacion/navegacion.php')
    ])
    .then(() => {
        console.log('Secciones cargadas');
    })
    .catch(error => {
        console.error('Error:', error);
    })
});