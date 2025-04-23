function ValidateLoginForm() {
    RemoveAllErrorMessage();

    var LoginEmail = document.getElementById('LoginEmail').value;
    var LoginPassword = document.getElementById('LoginPassword').value;

    var emailValidationMessage = isValidEmail(LoginEmail);
    if (emailValidationMessage !== "valid") {
        ShowErrorMessage('LoginEmail', emailValidationMessage);
        return false;
    }

    var passwordValidationMessage = isValidPassword(LoginPassword);
    if (passwordValidationMessage !== "valid") {
        ShowErrorMessage('LoginPassword', passwordValidationMessage);
        return false;
    }
	const a = document.createElement('a')
	a.href = "../index.html"
	a.click()
	a.remove()
	return true;
}

function ValidateRegistrationForm() {
    RemoveAllErrorMessage();

    var RegiName = document.getElementById('RegiName').value;
    var RegiEmailAddres = document.getElementById('RegiEmailAddres').value;
    var RegiPassword = document.getElementById('RegiPassword').value;
    var RegiConfirmPassword = document.getElementById('RegiConfirmPassword').value;

    if (RegiName === "") {
        ShowErrorMessage('RegiName', "Lūdzu aizpildi visus laukus.");
        return false;
    } else if (RegiName.length < 3 || RegiName.length > 20) {
        ShowErrorMessage('RegiName', "Vārdam jābūt no 3 līdz 20 rakstzīmēm.");
        return false;
    }

    var emailValidationMessage = isValidEmail(RegiEmailAddres);
    if (emailValidationMessage !== "valid") {
        ShowErrorMessage('RegiEmailAddres', emailValidationMessage);
        return false;
    }

    var passwordValidationMessage = isValidPassword(RegiPassword);
    if (passwordValidationMessage !== "valid") {
        ShowErrorMessage('RegiPassword', passwordValidationMessage);
        return false;
    }

    if (RegiPassword !== RegiConfirmPassword) {
        ShowErrorMessage('RegiConfirmPassword', "Paroles nesakrīt!");
        return false;
    }

    return true;
}

function ValidateForgotPasswordForm() {
    RemoveAllErrorMessage();

    var forgotPassEmail = document.getElementById('forgotPassEmail').value;
    var emailValidationMessage = isValidEmail(forgotPassEmail);

    if (emailValidationMessage !== "valid") {
        ShowErrorMessage('forgotPassEmail', emailValidationMessage);
        return false;
    }

    return true;
}
function RemoveAllErrorMessage() {
    var allErrorMessage = document.getElementsByClassName('error-message');
    var allErrorFields = document.getElementsByClassName('error-input');

    while (allErrorMessage.length > 0) {
        allErrorMessage[0].remove();
    }

    while (allErrorFields.length > 0) {
        allErrorFields[0].classList.remove('error-input');
    }
}

function ShowErrorMessage(InputBoxID, Message) {
    var InputBox = document.getElementById(InputBoxID);
    InputBox.classList.add('error-input');

    var ErrorMessageElement = document.createElement("p");
    ErrorMessageElement.innerHTML = Message;
    ErrorMessageElement.classList.add('error-message');
    ErrorMessageElement.setAttribute("id", InputBoxID + '-error');

    InputBox.parentNode.insertBefore(ErrorMessageElement, InputBox.nextSibling);
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === "") {
        return "Lūdzu aizpildi visus laukus.";
    }

    if (!emailRegex.test(email)) {
        return "Neeksistējošs e-pasts.";
    }

    return "valid";
}

function isValidPassword(password) {
    const minLength = 8;
    const maxLength = 32;
    const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z\d!@#$%^&*]{8,}$/;

    if (password === "") {
        return "Lūdzu aizpildi visus laukus.";
    }

    if (password.length < minLength || password.length > maxLength) {
        return "Parolei jābūt no 8 līdz 32 rakstzīmēm";
    }
    return "valid";
}