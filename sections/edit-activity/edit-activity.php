<?php
$error = false;
session_start();
include('../../php/db_connection.php');
$isAdmin = $_SESSION['admin'];
$activity_id = $_GET['id'];
$query = "SELECT * FROM activity where Activity_ID = $activity_id";
$sql = $con->query($query);
$row = $sql->fetch_assoc();

$title = $row['Title'];
$date = $row['Date'];
$time = $row["Time"];
$duration = $row['Duration'];
$location = $row['Location'];
$description = $row['Description'];
$picture = base64_encode($row['Thumbnail']);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./edit-activity.css">
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
                <li><a href="../activitiy-list/activitiy-list.php">Activities</a></li>
        </ul></b>
    </nav>
    <script src="./edit-activity.js"></script>
    <main>
        <div class="form-container">
            <form method="post" enctype="multipart/form-data">
                <h1 id="form-title">Edit Activity</h1>

                <div id="preview" style="background-image: url('data:image/*;base64,<?php echo $picture  ?>');">
                    <label id="file-label" for="file">Upload Thumbnail</label>
                    <input accept='image/*' id='file' name='thumbnail' type="file" placeholder="Upload Thumnail" multiple>
                    <script>
                        updatePreview()
                    </script>
                </div>


                <div class="form-row">
                    <div class="form-group">
                        <input class="form-input" type="text" name="title" id="title" value=<?php echo $title ?> required>
                        <label class="form-label" for="title">Activity Title</label>
                        <div class="underline"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="dateTime">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input class="form-input" type="date" name="date" id="date" value=<?php echo $date ?> required>
                            <div class="underline"></div>
                        </div>
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input class="form-input" type="time" name="time" id="time" value=<?php echo $time ?> required>
                            <div class="underline"></div>
                        </div>
                    </div>

                    <div class="range">
                        <label for="duration">Duration</label>
                        <input type="range" min=0 max=30 name="duration" id="duration" oninput="updateTextInput(this.value)" value=<?php echo $duration ?> required>
                        <input type="number" class='textInput' id="textInput" oninput="updateRangeInput(this.value)" value=<?php echo $duration ?> onchange="onchanges()"> Hours
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <textarea class="form-input" type="text" name="location" id="location" required><?php echo $location ?></textarea>
                        <label class="form-label" for="location">Activit Location</label>
                        <div class="underline" style="top:80px"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <textarea class="form-input" type="text" name="description" id="description" required><?php echo $description ?></textarea>
                        <label class="form-label" for="description">Activit Description</label>
                        <div class="underline" style="top:80px"></div>
                    </div>
                </div>

                <div style="display: flex;justify-content:end">
                    <button name="update-activity" style="padding:10px;margin-right: 10px;border-radius:20px;">Update Activity</button>
                </div>
        </div>
        </form>
        </div>
    </main>
</body>

</html>
<?php
if (isset($_POST['update-activity'])) {

    $title = $_POST['title'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $duration = $_POST['duration'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $thumbnail = 0;

    if (isset($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['name'] != '') {
        $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);
    } else {
        $thumbnail = $row['Thumbnail'];
    }



    $query = "UPDATE activity SET Title = '$title', Date = '$date', Time = '$time', 
        Duration = $duration, Location = '$location' , Description= '$description' , Thumbnail = ? WHERE Activity_ID = $activity_id";

    $sql = mysqli_prepare($con, $query);
    $sql->bind_param('s', $thumbnail);
    $sql->execute();

    if ($sql) {
        echo
        "<script>
            alert('Update Successfully');
        </script>";
    } else {
        echo
        "<script>
            alert('Update Failed');
        </script>";
    }
    echo "<script>window.location.href = '../manage-activity/manage-activity.php'</script>";
}
?>