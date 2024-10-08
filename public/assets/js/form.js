const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
    window.location.hash = "register";
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
    window.location.hash = "login";
});

if (window.location.hash === "#register") {
    container.classList.add("right-panel-active");
} else {
    container.classList.remove("right-panel-active");
}
