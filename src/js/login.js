$(document).ready(() => {
    $("#user-login").on("submit", (evt) => {
        evt.preventDefault();
        let userName = $("input[name=userName]").val();
        let password = $("input[name=password]").val();
        let user = { userName };
        $("#error").addClass('d-none');
        $("#error").html("Oops! Wrong password/user combination.");
        fetch("/user",
            {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                method: "POST",
                body: JSON.stringify({ user, password })
        })
        .then(res => res.json())
        .then(respJson => {
            console.log(respJson);    
            if (respJson?.isUserLoggedIn == true) {
                window.location = "/user";
            } else {
                $("#error").removeClass('d-none');
            }
        })
        .catch(err => {
            console.log(err);
            $("#error").removeClass('d-none');
            $("#error").html("An error occurred whiled trying to log you in. Please try again later?");
        });
    });
});