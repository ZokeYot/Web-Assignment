<?php
session_start();

include("../../php/db_connection.php");

$id = $_SESSION['id'];
$isAdmin = $_SESSION['admin'];
$query = "SELECT * FROM user where User_ID = $id";
$sql = $con->query($query);
$row = $sql->fetch_assoc();

$name = $row['Name'];
$email = $row['Email_Address'];
$dob = $row['DOB'];
$description = $row['User_Description'];
$picture = base64_encode($row['Profile_Picture']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../header.css">
    <link rel="stylesheet" href="edit-profile.css">
</head>

<body>
    <header>
        <h2 id="logo"><a id="home" href="../mian-page/main-page.php">ServeConnect</a></h2>
        <svg id="company_logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 75" x="0px" y="0px"><a id="home" href="#">
                <title>UXUI (NOUNPROJECT)</title>
                <path d="M30,25a6.994,6.994,0,1,1,3.90918-1.19043A6.95021,6.95021,0,0,1,30,25Zm0-12a5.00143,5.00143,0,0,0-2.79,9.15137,5.08852,5.08852,0,0,0,5.5791.001A5.00163,5.00163,0,0,0,30,13Z" fill="white" stroke="white" stroke-width="0.2" />
                <path d="M16,49a7.00248,7.00248,0,1,1,7-7A7.00848,7.00848,0,0,1,16,49Zm0-12a4.98887,4.98887,0,1,0,2.43945.63086A5.00588,5.00588,0,0,0,16,37Z" fill="white" stroke="white" stroke-width="0.2" />
                <path d="M44,49a7,7,0,1,1,7-7A7.00848,7.00848,0,0,1,44,49Zm0-12a5,5,0,1,0,5,5A5.02384,5.02384,0,0,0,44,37Z" fill="white" stroke="white" stroke-width="0.2" />
                <path d="M18.92871,37.75977a1,1,0,0,1-.87109-1.48926l7.7207-13.7793a.99994.99994,0,1,1,1.74414.97852L19.80176,37.249A.9974.9974,0,0,1,18.92871,37.75977Z" fill="white" stroke="white" stroke-width="0.2" />
                <path d="M41.07129,37.75977a.9974.9974,0,0,1-.873-.51075l-7.7207-13.77929a.99994.99994,0,0,1,1.74414-.97852l7.7207,13.7793a1,1,0,0,1-.87109,1.48926Z" fill="white" stroke="white" stroke-width="0.2" />
                <path d="M38,43H22a1,1,0,0,1,0-2H38a1,1,0,0,1,0,2Z" fill="white" stroke="white" stroke-width="0.2" />
            </a></svg>
        <input type="search" class="search_bar" id="main_search" name="main_search">
        <a href="../user-profile/user-profile.php"><input type="button" class="account_button" id="account_button" name="account_button" value="Account"></a>
    </header>
    <nav class="navbar">
        <ul><b>
                <li><a onclick='manageActivity("<?php echo $isAdmin ?>")'>Manage</a></li>
                <li><a href="../create-activity/create-activity.php">Create</a></li>
                <li><a href="../activitiy-list/activity-list.php">Activities</a></li>
                <li><a href="">Chat</a></li>
        </ul></b>
    </nav>
    <main>
        <script src="./edit-profile.js"></script>
        <form method="post" enctype="multipart/form-data">
            <div id="profile">
                <div style="background-image : url('data:image/*;base64,<?php echo $picture ?>')" id="image"></div>
                <input accept='image/*' type="file" name="profile-picture" id="profile" multiple>
                <script>
                    updatePreview()
                </script>
            </div>
            <div class="form=container">
                <h1>Edit Profile</h1>
                <div class="form-row">
                    <div class="form-group">
                        <input class="form-input" type="text" name="name" id="name" value=<?php echo $name  ?> required>
                        <label class="form-label" for="name">Name</label>
                        <div class="underline"></div>
                    </div>

                    <div class="form-group">
                        <input class="form-input" type="email" name="email" id="email" value=<?php echo $email  ?> required>
                        <label class="form-label" for="email">Email Address</label>
                        <div class="underline"></div>
                    </div>
                </div>

                <div class=form-row>
                    <div class="form-group">
                        <label class="form-label" style='top:-20px' for="dob">Date Of Birth</label>
                        <input class="form-input" type="date" name="dob" id="dob" value=<?php echo $dob  ?> required>
                        <div class="underline"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" style="width: 90%;">
                        <textarea class="form-input" style="resize:none;height:70px;padding-top:10px;" name="description" id="description" required><?php echo $description  ?></textarea>
                        <div class="underline" style="top:80px"></div>
                        <label class="form-label" style='top:-20px' for="descripton">Introduce About Yourself</label>
                    </div>
                </div>
            </div>
            <button name="edit">Edit Profile</button>
        </form>
    </main>
</body>

</html>
<?php
if (isset($_POST['edit'])) {
    $update_name = $_POST['name'];
    $update_email = $_POST['email'];
    $update_dob = $_POST['dob'];
    $update_description = $_POST['description'];
    $update_profile = 0;
    if (isset($_FILES['profile-picture']['name']) && $_FILES['profile-picture']['name'] != '') {
        $update_profile = file_get_contents($_FILES['profile-picture']['tmp_name']);
    } else {
        $update_profile = $row['Profile_Picture'];
    }

    $query = "UPDATE user SET Name = '$update_name' , Email_Address = '$update_email', DOB = '$update_dob ', User_Description = '$update_description', Profile_Picture = ? WHERE User_ID = $id";
    $sql = mysqli_prepare($con, $query);
    $sql->bind_param('s', $update_profile);
    $sql->execute();

    if ($sql) {
        echo '<script>alert("Profile Update Successfully")</script>';
    } else {
        echo '<script>alert("Profile Update Failed")</script>';
    }

    echo '<script>window.location.href = "../user-profile/user-profile.php"</script>';
}




?>