
function set_error_message(element, error_message) {
    element.style.display = "flex"
    element.style.animation = "none";
    element.offsetHeight;
    element.style.animation = null; 

    element.textContent = error_message;
}

function pressed_register_btn(event) {
    event.preventDefault();

    const error_message_div = document.getElementById("error-message");

    const email = document.getElementById("email").value;
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    fetch(config.registration_api, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
                email: email,
                username: username,
                password: password
            })
        })
        .then(response => response.text())
        .then(data => 
            set_error_message(error_message_div, data)
        )
        .catch(error => console.error(error));
}
