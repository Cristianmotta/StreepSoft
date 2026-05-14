function toggleMenu() {
    const menu = document.getElementById("side-menu");
    const overlay = document.getElementById("overlay");
            
    // Alternamos las clases para activar la transición de CSS
    menu.classList.toggle("active");
    overlay.classList.toggle("active");

    // Bloquear el scroll del cuerpo cuando el menú esté abierto
    if (menu.classList.contains("active")) {
        document.body.style.overflow = "hidden";
    } else {
        document.body.style.overflow = "auto";
    }
}