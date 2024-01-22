<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./participant-list.css">
</head>

<body>
    <div class="container">
        <?php
        include("../../php/db_connection.php");

        $activity_id = $_GET['id'];
        $query = "SELECT User_ID, Name, Email_Address, Gender,DOB,User_Description,Profile_Picture_Link FROM user where User_ID in (select User_ID from activity_participants where Activity_ID = '$activity_id')";
        $sql = $con->query($query);
        $json = array();
        while ($row = $sql->fetch_assoc()) {
            $id = $row["User_ID"];
            $name = $row["Name"];
            $email = $row["Email_Address"];
            $gender = $row["Gender"];
            $dob = $row["DOB"];
            $description = $row["User_Description"];
            $picture = base64_encode($row["Profile_Picture_Link"]);

            echo "
                <div class='user-container'>
                    
                    <div class='bio-info'>
                        <img class='profile-pic' src='data:image/jpeg;base64,{$picture}'>
                        <p class='dob'>$dob</p>
                        <p class='gender'>$gender</p>
                    </div>

                    <div class='user-info'>
                        <p class='name'>$name</p>
                        <a class='email' href='mailto:$email'>$email</a>
                        <div class='description'>$description</div>
                    </div>
                </div>

                ";
        } ?>

    </div>
</body>


</html>