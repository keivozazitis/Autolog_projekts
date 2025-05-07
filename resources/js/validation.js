// validation.js
// This script validates the registration form passwords: ensures they match and are at least 8 characters long.

// Wait for DOM content to be loaded
document.addEventListener('DOMContentLoaded', function() {
    const regiForm = document.querySelector('#RegistrationFrom form');
    if (!regiForm) return;
  
    regiForm.addEventListener('submit', function(event) {
      const password = document.getElementById('RegiPassword').value;
      const confirmPassword = document.getElementById('RegiConfirmPassword').value;
  
      // Clear previous error
      let existingError = document.querySelector('.password-error');
      if (existingError) {
        existingError.remove();
      }
  
      // Check length
      if (password.length < 8) {
        showError('Parolei jābūt vismaz 8 rakstzīmēm garai.');
        event.preventDefault();
        return;
      }
  
      // Check match
      if (password !== confirmPassword) {
        showError('Paroles nesakrīt. Lūdzu, pārbaudi un mēģini vēlreiz.');
        event.preventDefault();
        return;
      }
  
      // If validations pass, form will submit
    });
  
    function showError(message) {
      const errorElem = document.createElement('div');
      errorElem.className = 'password-error';
      errorElem.innerText = message;
      errorElem.style.color = 'red';
      errorElem.style.marginTop = '10px';
      const container = document.querySelector('#RegistrationFrom .center');
      container.appendChild(errorElem);
    }
  });
  
  
  // register.js
  // This script toggles between login and registration forms on the page.
  
  function ShowLoginForm() {
    document.getElementById('LoginFrom').style.display = 'block';
    document.getElementById('RegistrationFrom').style.display = 'none';
    document.getElementById('ShowLoginBtn').classList.add('active');
    document.getElementById('ShowRegistrationBtn').classList.remove('active');
    document.getElementById('formTitle').innerText = 'Ielogoties';
  }
  
  function ShowRegistrationForm() {
    document.getElementById('LoginFrom').style.display = 'none';
    document.getElementById('RegistrationFrom').style.display = 'block';
    document.getElementById('ShowLoginBtn').classList.remove('active');
    document.getElementById('ShowRegistrationBtn').classList.add('active');
    document.getElementById('formTitle').innerText = 'Reģistrēties';
  }
  
  // Initialize view on page load
  
  window.onload = function() {
    ShowLoginForm();
  };
  