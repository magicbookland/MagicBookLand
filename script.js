// Obtener elementos del DOM
const modal = document.getElementById("imageModal");
const expandedImg = document.getElementById("expandedImg");
const closeBtn = document.getElementById("closeBtn");

// Agregar un evento de clic a todas las miniaturas
const thumbnails = document.querySelectorAll(".thumbnail");
thumbnails.forEach(img => {
    img.addEventListener("click", function() {
        modal.style.display = "flex"; // Mostrar el modal
        expandedImg.src = this.src; // Cambiar la imagen ampliada
    });
});

// Cerrar el modal al hacer clic en la "X"
closeBtn.addEventListener("click", function() {
    modal.style.display = "none"; // Ocultar el modal
});







document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');

    // Verifica si el elemento se encontró
    if (themeToggle) {
        // Verifica el tema guardado en localStorage al cargar la página
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-theme');
            themeToggle.checked = true; // Marca el interruptor como activado
        }

        // Funcionalidad del interruptor de tema
        themeToggle.addEventListener('change', () => {
            document.body.classList.toggle('dark-theme');
            const theme = document.body.classList.contains('dark-theme') ? 'dark' : 'light';
            localStorage.setItem('theme', theme); // Guarda la preferencia del tema
        });
    } else {
        console.error('No se encontró el interruptor de tema en el DOM');
    }
});

