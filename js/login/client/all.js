const idElem = document.getElementById('button-register');
const regElem = document.getElementById('content-register-user');
const logElem = document.getElementById('content-login-user');
const boxLogin = document.getElementsByClassName('content-login');

idElem.addEventListener("click", showHide);

function showHide() {
    logElem.classList.toggle("hiding");
    regElem.classList.toggle("showing");
    boxLogin.classList.toggle("margin-top");
}