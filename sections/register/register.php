<title>Register Form</title>
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

    .login a {
        color: blue;
        text-decoration: none;
    }

    .login a:hover {
        text-decoration: underline;
    }

    .login a {
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
</style>
</head>

<body>
    <main>
        <div class="header">
            <p>ServeConnect</p>
        </div>
        <form action="main-page.html" method="post">
            <h1>WELCOME</h1>

            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Your Name">
            </div>

            <div>
                <label for="email">Email</label>
                <input name="user_email" type="email" id="email" placeholder="Your Email">
            </div>

            <div>
                <label for="password"></label>
                <input name="user_password" type="password" id="password" placeholder="Create Password">
            </div>

            <div>
                <select type="gender" name="gender" id="gender">
                    <option value="">Please select your gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="prefer not to say">Prefer Not to Say</option>
                </select>
            </div>

            <div>
                <label for="dob">
                    <input type="date" name="dob" id="dob">
            </div>

            <div>
                <label for="description">Introduce Yourself</label>
                <textarea name="description" id="description">Let us know more about you</textarea>
            </div>



            <div>
                <input type="submit" name="register" value="Register">
            </div>


            <div class="login">
                <p class="login-text">Already have an account? <a href="login.html">Login</a></p>
            </div>
        </form>
    </main>
</body>

</html>