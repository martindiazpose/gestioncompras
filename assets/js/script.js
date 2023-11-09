// Ejecutando función
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);

// Declarando variables
let formulario_login = document.querySelector(".formulario__login");
let contenedor_login_register = document.querySelector(".contenedor__login-register");
let caja_trasera_login = document.querySelector(".caja__trasera-login");

// Función iniciarSesion
function iniciarSesion() {
    if (window.innerWidth > 850) {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "10px";
        caja_trasera_login.style.opacity = "0";
    } else {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        caja_trasera_login.style.display = "none";
    }
}



