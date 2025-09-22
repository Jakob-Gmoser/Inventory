
function set_error_message(element, error_message) {
    element.style.display = "flex"
    element.style.animation = "none";
    element.offsetHeight;
    element.style.animation = null; 

    element.textContent = error_message;
}

function pressed_login_btn(event) {
    event.preventDefault();

    const error_message_div = document.getElementById("error-message");

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    fetch(config.login_api, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
                email: email,
                password: password
            })
        })
        .then(response => response.json())
        .then(data => {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    set_error_message(error_message_div, data.error)
                }
            }
        )
        .catch(error => console.error(error));
}
