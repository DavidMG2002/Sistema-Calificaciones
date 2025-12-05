// frontend/app.js
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("loginForm");

    if (loginForm) {
        loginForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            const user = document.getElementById("user").value;
            const pass = document.getElementById("pass").value;

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ user, pass })
                });

                const data = await response.json();

                if (data.success) {
                    window.location.href = data.redirect; // "/alumnos"
                } else {
                    document.getElementById("msg").innerText = data.message;
                }
            } catch (error) {
                document.getElementById("msg").innerText = "Error de conexión";
                console.error("Error:", error);
            }
        });
    }
});