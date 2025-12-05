document.addEventListener("DOMContentLoaded", () => {

    // Botón para ir a alumnos
    const btnAlumnos = document.getElementById("btn-alumnos");
    if (btnAlumnos) {
        btnAlumnos.addEventListener("click", () => {
            window.location.href = "pages/alumnos.html";
        });
    }

    // Botón para ir a profesores
    const btnProfesores = document.getElementById("btn-profesores");
    if (btnProfesores) {
        btnProfesores.addEventListener("click", () => {
            window.location.href = "pages/profesores.html";
        });
    }

    // Botón para ir a exámenes
    const btnExamenes = document.getElementById("btn-examenes");
    if (btnExamenes) {
        btnExamenes.addEventListener("click", () => {
            window.location.href = "pages/examenes.html";
        });
    }

    // Botón de login
    const btnLogin = document.getElementById("btn-login");
    if (btnLogin) {
        btnLogin.addEventListener("click", () => {
            window.location.href = "pages/login.html";
        });
    }
});
