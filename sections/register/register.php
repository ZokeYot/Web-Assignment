<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include("../../php/db_connection.php");

if (isset($_POST['register'])) {
    try {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $description = $_POST['description'];
        $blob_img = file_get_contents('../../pic/default-pic.jpg');


        $query = "INSERT INTO user(Name,Email_Address,Gender,Password,DOB,User_Description,Profile_Picture)
        Values('$name' , '$email' , '$gender' , '$password' , '$dob' , '$description' , ?)";

        $stmt = mysqli_prepare($con, $query);
        $stmt->bind_param('s', $blob_img);
        $stmt->execute();
        $result = $stmt->affected_rows;

        if ($result == 1) {
            echo "
            <script>
                    alert('Welcome $name');
                    window.location.href= '../../index.html';
            </script>";
        } else {
            echo 'Could Not Upload liao';
        }
    } catch (Exception $e) {
        $messagesHtml = "<div class='error-messages'>" . $e->getMessage() . "</div>";
    }
}

if (isset($_POST['login'])) {
    try {
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $validateUser = "SELECT * FROM user where Email_Address = '$email'";
        $sql = $con->query($validateUser);
        $row = $sql->fetch_assoc();

        if (!$row) {
            echo "
            <div class = 'errorMsg animation'>User Not Found</div>
            ";
            exit();
        }
        if ($row['Password'] !== $password) {
            echo
            " <div div class = 'errorMsg animation' >Incorrect Password</div>";
            exit();
        }
        echo  "
        <script>
        alert('Welcome');  
        window.location.href = '../main-page/main-page.html'                             
    </script>";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>

<html>

<head>
    <title>Register Form</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <main>
        <div class="header">
            <p>ServeConnect</p>
        </div>

        <div class="flip">
            <div class="flip-inner">
                <div class="register">
                    <div class="form-container">
                        <form class='register-form' action="" method="post" enctype="multipart/form-data" onsubmit="return CheckPassword()">
                            <h1 style="margin-bottom:50px;">WELCOME</h1>

                            <div class="form-row">
                                <div class="form-group">
                                    <input class="form-input" type="text" name="name" id="name" required>
                                    <label class="form-label" for="name">Name</label>
                                    <div class="underline"></div>
                                </div>

                                <div class="form-group">
                                    <input class="form-input" type="email" name="email" id="email" required>
                                    <label class="form-label" for="email">Email Address</label>
                                    <div class="underline"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <input class="form-input" type="password" name="password" id="password" oninput="CheckPassword()" required>
                                    <label class="form-label" for="password">Create Password</label>
                                    <div class="underline"></div>
                                </div>

                                <div class="form-group">
                                    <input class="form-input" type="password" name="re_password" id="re_password" oninput=CheckPassword() required>
                                    <label class="form-label" for="re_password">Enter Password Again</label>
                                    <div class="underline"></div>
                                    <p id="password-error" class="hidden">Password Does Not Match</p>
                                </div>
                            </div>

                            <div class=form-row>
                                <div class="form-group">
                                    <label class="form-label" style='top:-20px' for="dob">Date Of Birth</label>
                                    <input class="form-input" type="date" name="dob" id="dob" placeholder="" required>
                                    <div class="underline"></div>
                                </div>

                                <div class="gender">
                                    <label for="option1" style="position:absolute;top:-20">Select Your Gender</label>
                                    <div class="options">
                                        <input type="radio" name="gender" id="option1">
                                        <label for="option1">Male</label>
                                    </div>

                                    <div class="options">
                                        <input type="radio" name="gender" id="option2">
                                        <label for="option2">Female</label>
                                    </div>

                                    <div class="options">
                                        <input type="radio" name="gender" id="option3">
                                        <label for="option3">Prefer Not to say</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group" style="width: 90%;">
                                    <textarea class="form-input" style="resize:none;height:70px;padding-top:10px;" name="description" id="description" required></textarea>
                                    <div class="underline" style="top:65px;left:-340px"></div>
                                    <label class="form-label" style='top:-20px' for="descripton">Introduce About Yourself</label>

                                </div>
                            </div>


                            <u><a class="flip-button" onclick=" flipPage()">Log in</a></u>
                            <button class='submit-button' name="register">Register</button>

                        </form>
                        <div>
                            <?php echo isset($messagesHtml) ? $messagesHtml : "" ?>
                            <p id="errorMsg"></p>
                        </div>
                    </div>
                </div>

                <div class="login">
                    <div class="form-container">
                        <form class='login-form' action="" method="post" enctype="multipart/form-data">
                            <h1 style="margin-bottom: 50px;">WELCOME BACK</h1>

                            <div class="form-row">
                                <div class="form-group">
                                    <input class="form-input" type="email" name="login_email" id="login_email" required>
                                    <label class="form-label" for="login_email">Email Address</label>
                                    <div class="underline"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <input class="form-input" type="password" name="login_password" id="login_password" required>
                                    <label class="form-label" for="login_password">Password</label>
                                    <div class="underline"></div>
                                </div>
                            </div>



                            <button class='submit-button' name="login">Log in</button>
                            <u> <a class="flip-button" onclick="flipPage()">Register</a></u>


                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="register.js"></script>
</body>

</html>