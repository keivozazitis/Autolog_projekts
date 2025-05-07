// register.js
// Optimized script to toggle between login and registration forms

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("LoginFrom");
    const registerForm = document.getElementById("RegistrationFrom");
    const formTitle = document.getElementById("formTitle");
  
    const showLoginBtn = document.getElementById("ShowLoginBtn");
    const showRegisterBtn = document.getElementById("ShowRegistrationBtn");
  
    const toggleForms = (showLogin) => {
      loginForm.style.display = showLogin ? "block" : "none";
      registerForm.style.display = showLogin ? "none" : "block";
      formTitle.textContent = showLogin ? "Ielogoties" : "Reģistrēties";
      showLoginBtn.classList.toggle("active", showLogin);
      showRegisterBtn.classList.toggle("active", !showLogin);
    };
  
    // Initialize with login form
    toggleForms(true);
  
    // Event listeners
    showLoginBtn.addEventListener("click", () => toggleForms(true));
    showRegisterBtn.addEventListener("click", () => toggleForms(false));
  });
  