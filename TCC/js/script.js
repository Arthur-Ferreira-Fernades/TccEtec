const container = document.getElementById ('container');
const registerBtn = document.getElementById('Empresa');
const voltarBtn = document.getElementById('Voltar');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

voltarBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});