$(document).ready(() => {
    const showError = () => { 
        $("#error").removeClass("d-none");
    };
    const hideError = () => { 
        $("#error").addClass("d-none");
    };
    const changeErrorText = text => {
        $("#error").html(text);
    };
    const showSuccess = () => { 
        $("#success").removeClass("d-none");
    };
    const hideSuccess = () => { 
        $("#success").addClass("d-none");
    };

    $("#user-register").on("submit", (evt) => {
        evt.preventDefault();
        const inputs = document.querySelectorAll('input:invalid');
        inputs.forEach(i => {
            if (i.value.trim() !== "") {
                i.classList.add('invalid-inputs');
            }
        });
        
        hideError();
        hideSuccess();

              

        const userNameInput = $("input[name=userName]")[0];
        if (!userNameInput.validity.valid) {
            changeErrorText("A user name is required");
            showError();
            return;   
        } 
        const userName = userNameInput.value;
        
        const firstNameInput = $("input[name=firstName]")[0];
        if (!firstNameInput.validity.valid) {
            changeErrorText("A first name is required");
            showError();
            return
        }
        const firstName = firstNameInput.value;
        
        const passwordInput = $("input[name=password]")[0];
        if (!passwordInput.validity.valid) {
            changeErrorText("Please make sure the password contains 8 characters with at least 1 special character and 1 capital letter");
            showError();
            return;
        };
        const password = passwordInput.value;

        const passwordInput2 = $("input[name=password2]")[0];
        console.log(password,passwordInput2.value);

        if (passwordInput2.value !== password) {
            changeErrorText("Confirmation password does not match");
            showError();
            return;
        };
        


        const lastNameInput = $("input[name=lastName]")[0];
        const lastName = lastNameInput.value;

        const captchaInput = $("input[name=captcha]")[0];
        if (!captchaInput.validity.valid) {
            changeErrorText("Please make sure the password contains 8 characters with at least 1 special character and 1 capital letter");
            showError();
            return;
        };
        const captcha = captchaInput.value;

        const user = {
            userName,
            lastName,
            firstName
        };
        
        fetch("/create-user",
            {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                method: "POST",
                body: JSON.stringify({ user, password, captcha })
            })
            .then(res => res.json())
            .then(resData => { 
                if (resData?.userCreated === true) {
                    showSuccess();
                } else {
                    if (resData?.userCreated === "captcha_failed") {
                        changeErrorText("Captcha failed. Please try again?");    
                    } else {
                        changeErrorText("Could not create this user.");
                    }
                    showError();
                }
            })

    });
});