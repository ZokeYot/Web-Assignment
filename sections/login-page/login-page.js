function checkFormValidity() {
    const inputs = document.querySelectorAll("input[required]");
    let isValid = true;
    inputs.forEach(input => {
        if (input.value === "") {
            isValid = false;
        }
    })
    if (isValid) {
        login();
    }
    else {
        alert("Please filled out all necessary field !!");
    }
}

function login() {
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const PasErrorMsg = document.getElementById("pass-error");
    const PasSuccessMsg = document.getElementById("pass-success");
    const data = {
        Email_Address: email.value,
        Password: password.value
    };
    const jsonData = JSON.stringify(data);

    fetch("http://localhost/Web-Assignment/php/Login.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonData
    })
        .then(response => response.json())
        .then(data => {
            PasErrorMsg.style.display = "none"
            switch (data.status) {
                case "success":
                    alert("Welcome");
                    window.location.href = "../main-page/main-page.html"
                    break;
                case "failed":
                    PasErrorMsg.style.display = "block";
                    password.value = "";
                    break;
                case "invalid":
                    alert("User not found");
                    email.value = "";
                    password.value = "";


            }
        })
}