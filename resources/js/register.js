document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("LoginFrom");
    const registerForm = document.getElementById("RegistrationFrom");
    const formTitle = document.getElementById("formTitle");

    const showLoginBtn = document.getElementById("ShowLoginBtn");
    const showRegisterBtn = document.getElementById("ShowRegistrationBtn");

    function ShowLoginForm() {
        loginForm.style.display = "block";
        registerForm.style.display = "none";
        formTitle.textContent = "Ielogoties";
        
        showLoginBtn.classList.add("active");
        showRegisterBtn.classList.remove("active");
    }

    function ShowRegistrationForm() {
        loginForm.style.display = "none";
        registerForm.style.display = "block";
        formTitle.textContent = "Reģistrēties";

        showRegisterBtn.classList.add("active");
        showLoginBtn.classList.remove("active");
    }

    ShowLoginForm();

    showLoginBtn.addEventListener("click", ShowLoginForm);
    showRegisterBtn.addEventListener("click", ShowRegistrationForm);

    console.log("1, 2 buckle my shoeeee")
    console.log("3, 4 buckle some moorreee")
});
