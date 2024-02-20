<?php
session_start();
include('../../php/db_connection.php');
$isAdmin = $_SESSION['admin'];

$query = "SELECT * FROM activity JOIN user ON activity.Organizer_ID = user.User_ID ORDER BY Activity_ID DESC LIMIT 3";
$sql = $con->query($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServeConnect</title>
    <link rel="stylesheet" href="main-page.css">
    <link rel="stylesheet" href="../../header.css">
</head>

<body>
    <header>
        <h2 id="logo"><a id="home" href="./main-page.php">ServeConnect</a></h2>
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
        </ul></b>
    </nav>
    </div>
    <main>
        <div class="gallery-container">
            <div>
                <svg id='backButton' data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18"></path>
                </svg>
            </div>
            <div id="gallery">
                <img src="../../pic/OIP (1).jpg" alt="">
                <img src="../../pic/Why Community Service is Essential for a High Schooler (1).webp" alt="">
                <img src="../../pic/why-is-community-service-important.webp" alt="">

                <img src="../../pic/135538151-56a93a6e5f9b58b7d0f96fed.jpg" alt="">
                <img src="../../pic/OIP (2).jpg" alt="">
                <img src="../../pic/iStock-626891236-scaled.webp" alt="">

            </div>
            <div>
                <svg id='nextButton' data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"></path>
                </svg>
            </div>
        </div>
        <script src="main-page.js"></script>
        <div id="create-container">
            <h1>Come out with an idea?</h1>
            <button>Organized an activity now</button>
        </div>
    </main>
    <h1 style="margin:20px 50px;">What New</h1>
    <div id="events">
        <?php
        if ($sql) {
            while ($row = $sql->fetch_assoc()) {
                $activity_id = $row['Activity_ID'];
                $name = $row['Title'];
                $date = $row['Date'];
                $time = $row['Time'];
                $location = $row['Location'];
                $picture = base64_encode($row['Thumbnail']);

                echo
                "
                <div class='event-container' onclick='showDetail(\"$activity_id\")'>
                <div>
                    <img src='data:image/*;base64,$picture' alt='' />
                </div>
                    <div>
                        <h1>$name</h1>
                        <p>$date  $time</p>
                        <p>$location</p>
                    </div>
                </div>
                ";
            }
        }
        ?>

        <?php
        if (isset($_GET['id'])) {
            echo "<div class='container'>";
            $id = $_GET['id'];
            $query = "SELECT * FROM activity join user on Organizer_ID = user.User_ID WHERE Activity_ID = $id";
            $sql = $con->query($query);
            $row = $sql->fetch_assoc();

            $title = $row['Title'];
            $organizer = $row['Name'];
            $date = $row['Date'];
            $time = $row['Time'];
            $duration = $row['Duration'];
            $location = $row['Location'];
            $description = $row['Description'];
            $picture = base64_encode($row['Thumbnail']);



            echo
            "
   
        <div class='event-detail' id='event-detail'>
            <img src='data:image/*;base64,$picture' alt=''/>
            <div>
                <form method='post'>
                    <h1>$title</h1>
                    <p>Organized by <strong>$organizer</strong></p>

                    <h2>Date :</h2>
                    <p>$date</p>

                    <h2>Time :</h2>
                    <p>$time</p>

                    <h2>Activity Duration :</h2>
                    <p>$duration hours</p>

                    <h2>Activity Description :</h2>
                    <p>$description</p>

                </form>
                </div>
            </div>";

            echo '<div class="participant-list">';
            echo "<h1>Participant List</h1>";
            $query = "SELECT * FROM activity_participants ap join user on ap.User_ID = user.User_ID  where Activity_ID = $id";
            $sql = $con->query($query);

            if ($sql) {
                while ($row = $sql->fetch_assoc()) {
                    $participant_name = $row['Name'];
                    $participant_id = $row['User_ID'];
                    $profile = base64_encode($row['Profile_Picture']);

                    echo
                    "
                    <div class='participant'>
                        <img src='data:image/*;base64,$profile'>
                        <a href='../view-user-profile/view-user-profile.php?user_id=$participant_id'><p>$participant_name</p></a>
                    </div>
                    ";
                }
            }
            echo
            "
            </div>
            </div> 
            <script>
                blurBackground();
                removeBlur();
            </script>
            ";
        }
        ?>
    </div>

</body>

</html>