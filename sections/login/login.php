<title>Login Form</title>
<style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    main {
        text-align: center;
        order: 2;
    }

    form {
        width: 280px;
        margin: auto;
        background: #f4f4f4;
        padding: 20px;
        border-radius: 8px;
    }

    h1 {
        font-size: 30px;
        margin-bottom: 20px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        text-align: center;
    }

    input[type="submit"] {
        background-color: black;
        color: white;
        cursor: pointer;
        font-size: 16px;
    }

    .forgot-password a,
    .register a {
        color: blue;
        text-decoration: none;
    }

    .forgot-password a:hover,
    .register a:hover {
        text-decoration: underline;
    }

    .register a {
        margin-left: 10px;
    }

    .header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: black;
        padding: 10px;
        height: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        font-size: 40px;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    .errorMsg {
        order: 1;
        box-sizing: border-box;
        text-align: center;
        width: 320px;
        padding: 20px 80px;
        border-radius: 30px;
        margin-bottom: 20px;
        border: 2px solid red;
        background-color: #ffaeae;
        font-size: large;
        animation-name: comeIn;
        animation-duration: 1s;
    }

    @keyframes comeIn {
        from {
            opacity: 0;
            transform: translateY(20px);

        }

        to {
            opacity: 1;

        }
    }
</style>
</head>

<body>
    <main>
        <div class="header">
            <p>ServeConnect</p>
        </div>
        <form method="post">
            <h1>WELCOME</h1>
            <div>
                <input name="user_email" type="email" value="" placeholder="Email">
            </div>
            <div>
                <input name="user_password" type="password" value="" placeholder="Password">
            </div>
            <div>
                <input type="submit" name="login" value="Login">
            </div>
            <div class="forgot-password">
                <a href="../forgot-password/forgot-password.php">Forgot Password</a>
            </div>
            <div class="register">
                <p class="register-text">Don't have an account? <a href="../register/register.php">Register</a></p>
            </div>
        </form>
    </main>
</body>

</html>

<?php
include("../../php/db_connection.php");
if (isset($_POST['login'])) {
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    $validateUser = "SELECT * FROM user where Email_Address = '$email'";
    $sql = $con->query($validateUser);
    $row = $sql->fetch_assoc();


    if (!$row) {
        echo "
        <div class = 'errorMsg animation'>User Not Found</div>
        ";
        return;
    }
    if ($row['Password'] !== $password) {
        echo
        " <div div class = 'errorMsg animation' >Incorrect Password</div>";
        return;
    }
    echo  "
        <script>
        alert('Welcome');  
        window.location.href = '../main-page/main-page.html'                             
    </script>";
}
?>