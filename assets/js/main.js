// assets/js/main.js

document.addEventListener('DOMContentLoaded', () => {
    
    // Funcionalidad del Menú Móvil
    const btnMobile = document.getElementById('mobile-menu-btn');
    const navMenu = document.getElementById('navbar-sticky');

    if(btnMobile && navMenu) {
        btnMobile.addEventListener('click', () => {
            navMenu.classList.toggle('hidden');
            // Cambiar icono si quieres (opcional)
        });
    }

    // Cerrar menú al hacer click en un enlace (UX móvil)
    navMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            if(window.innerWidth < 768) { // Solo en móvil
                navMenu.classList.add('hidden');
            }
        });
    });
});