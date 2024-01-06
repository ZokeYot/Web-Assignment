function checkFormValidity() {
    const inputs = document.querySelectorAll("input[required]");
    let isValid = true;
    inputs.forEach(input => {
        if (input.value === "") {
            isValid = false;
        }
    })

    if (isValid) {
        registerUser();
    }
    else {
        alert("Please filled out all necessary field !!")
    }
}

document.querySelector('form').addEventListener('submit', event => {
    event.preventDefault();
    registerUser();
})


function registerUser() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const dob = document.getElementById("dob").value;
    const gender = document.getElementById("gender").value;
    const description = document.getElementById("description").value;

    const data = {
        Name: name,
        Email_Address: email,
        Password: password,
        Gender: gender,
        DOB: dob,
        User_Description: description,
    };
    const jsonData = JSON.stringify(data);

    fetch("http://localhost/Web-Assignment/php/Register.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "error") {
                alert("An error occured: " + data.messages);
                window.location.reload();
            }
            else {
                alert(data.messages);
                window.location.href = "../login-page/login-page.html";
            }

        })

}

