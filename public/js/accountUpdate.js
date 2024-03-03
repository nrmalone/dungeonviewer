function displayInput(type) {  
    updateSubmitButton = document.getElementById("updateSubmitButton");
    if (updateSubmitButton.checkVisibility()) {
    updateSubmitButton.setAttribute("style", "visibility: visible");
    }

    if (type === 'email') {
        //store existing email
        pAcctInfoEmail = document.getElementById("pAcctInfoEmail");
        existingEmail = pAcctInfoEmail.textContent;

        //swap email text for stylized email input field
        pAcctInfoEmail.remove();
        tdAcctInfoEmail = document.getElementById("tdAcctInfoEmail");
        inputAcctInfoEmail = document.createElement("input");
        inputAcctInfoEmail.classList.add("textField");
        inputAcctInfoEmail.name = "email";
        inputAcctInfoEmail.type = "email";
        inputAcctInfoEmail.value = existingEmail;
        tdAcctInfoEmail.appendChild(inputAcctInfoEmail);

        emailButton = document.getElementById("emailButton");
        emailButton.remove();
    }

    if (type === 'username') {
        //store existing username
        pAcctInfoUsername = document.getElementById("pAcctInfoUsername");
        existingUsername = pAcctInfoUsername.textContent;

        //swap username text for stylized username input field
        pAcctInfoUsername.remove();
        tdAcctInfoUsername = document.getElementById("tdAcctInfoUsername");
        inputAcctInfoUsername = document.createElement("input");
        inputAcctInfoUsername.classList.add("textField");
        inputAcctInfoUsername.type = "text";
        inputAcctInfoUsername.name = "username";
        inputAcctInfoUsername.value = existingUsername;
        tdAcctInfoUsername.appendChild(inputAcctInfoUsername);
        
        usernameButton = document.getElementById("usernameButton");
        usernameButton.remove();
    }
}