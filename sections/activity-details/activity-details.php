<?php
include('../../php/db_connection.php');

$activity_id = 13;
$query = "SELECT * FROM activity join user on activity.User_ID = user.User_ID WHERE Activity_ID = '$activity_id'";
$sql = $con->query($query);
$result = $sql->fetch_assoc();
$picture = base64_encode($result['Thumbnail']);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServeConnect</title>
    <link rel="stylesheet" href="activity-details.css">
</head>

<body>
    <header>
        <h2 id="logo"><a id="home" href="/sections/main-page/main-page.html">ServeConnect</a></h2>
        <svg id="company_logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 75" x="0px" y="0px"><a id="home" href="/sections/main-page/main-page.html">
                <title>UXUI (NOUNPROJECT)</title>
                <path d="M30,25a6.994,6.994,0,1,1,3.90918-1.19043A6.95021,6.95021,0,0,1,30,25Zm0-12a5.00143,5.00143,0,0,0-2.79,9.15137,5.08852,5.08852,0,0,0,5.5791.001A5.00163,5.00163,0,0,0,30,13Z" fill="white" stroke="white" stroke-width="0.2" />
                <path d="M16,49a7.00248,7.00248,0,1,1,7-7A7.00848,7.00848,0,0,1,16,49Zm0-12a4.98887,4.98887,0,1,0,2.43945.63086A5.00588,5.00588,0,0,0,16,37Z" fill="white" stroke="white" stroke-width="0.2" />
                <path d="M44,49a7,7,0,1,1,7-7A7.00848,7.00848,0,0,1,44,49Zm0-12a5,5,0,1,0,5,5A5.02384,5.02384,0,0,0,44,37Z" fill="white" stroke="white" stroke-width="0.2" />
                <path d="M18.92871,37.75977a1,1,0,0,1-.87109-1.48926l7.7207-13.7793a.99994.99994,0,1,1,1.74414.97852L19.80176,37.249A.9974.9974,0,0,1,18.92871,37.75977Z" fill="white" stroke="white" stroke-width="0.2" />
                <path d="M41.07129,37.75977a.9974.9974,0,0,1-.873-.51075l-7.7207-13.77929a.99994.99994,0,0,1,1.74414-.97852l7.7207,13.7793a1,1,0,0,1-.87109,1.48926Z" fill="white" stroke="white" stroke-width="0.2" />
                <path d="M38,43H22a1,1,0,0,1,0-2H38a1,1,0,0,1,0,2Z" fill="white" stroke="white" stroke-width="0.2" />
            </a></svg>

        <input type="search" class="search_bar" id="main_search" name="main_search">
        <a href="profile.html"><input type="button" class="account_button" id="account_button" name="account_button" value="Account"></a>
    </header>
    <nav class="navbar">
        <ul><b>
                <li><a href="about.html">About us</a></li>
                <li><a href="manage.html">Manage</a></li>
                <li><a href="/sections/create-activity/create-activity.html">Create</a></li>
                <li><a href="activities.html">Activities</a></li>
                <li><a href="chat.html">Chat</a></li>
        </ul></b>
    </nav>
    <main>
        <div id='activity-container'>
            <?php
            echo "<img width=60% height=300px src='data:image/jpg;base64,$picture'>"
            ?>

            <div id="activity-detail">
                <h1><?php echo $result['Title'] ?></h1>
                <h3>Date : <?php echo $result['Date'] ?> </h3>
                <h3>Time : <?php echo $result['Time'] ?> </h3>
                <h4>Duration : <?php echo $result['Duration'] ?> hours </h4>
                <h4>Organizer : <?php echo $result['Name'] ?> </h4>
            </div>
        </div>
        <div>
            <p>
                <?php echo $result['Description'] ?></h4>
            </p>
        </div>





    </main>
</body>

</html>





<!-- <div class="grid-container">
            <div class="item item1"><?php echo $result['Title'] ?></div>
            <div class="item item2"><?php echo $result['Activity_ID'] ?></div>
            <div class="item item3">
                <div class="organizer_info">
                    <span class="organizer_name"><?php echo $result['Name'] ?></span>
                    <span class="organizer_number">Email Address : <?php echo $result['Email_Address'] ?></span>
                </div>
                <div class="chat_with_organizer">
                    <a href="chat.html" id="chat_w_organizerbtn">Chat With Organizer</a>
                </div>
            </div>
            <div class="item item5"><?php echo $result['Date'] ?></div>
            <div class="item item6"><strong>Time : </strong><?php echo $result['Time'] ?></div>
            <div class="item item7"><strong>Duration : </strong><?php echo $result['Duration'] ?> hours</div>\
            <div class="item item4"><?php echo $result['Location'] ?></div>
        </div>

        <div class="activity_desc">
            <h2>Description</h2>
            <hr>
            <div class="desc_section">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero soluta vel delectus repellendus fugiat, hic velit similique placeat nihil voluptatum, accusantium modi aspernatur! Rerum qui est eligendi dicta earum aspernatur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero soluta vel delectus repellendus fugiat, hic velit similique placeat nihil voluptatum, accusantium modi aspernatur! Rerum qui est eligendi dicta earum aspernatur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero soluta vel delectus repellendus fugiat, hic velit similique placeat nihil voluptatum, accusantium modi aspernatur! Rerum qui est eligendi dicta earum aspernatur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero soluta vel delectus repellendus fugiat, hic velit similique placeat nihil voluptatum, accusantium modi aspernatur! Rerum qui est eligendi dicta earum aspernatur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero soluta vel delectus repellendus fugiat, hic velit similique placeat nihil voluptatum, accusantium modi aspernatur! Rerum qui est eligendi dicta earum aspernatur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero soluta vel delectus repellendus fugiat, hic velit similique placeat nihil voluptatum, accusantium modi aspernatur! Rerum qui est eligendi dicta earum aspernatur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero soluta vel delectus repellendus fugiat, hic velit similique placeat nihil voluptatum, accusantium modi aspernatur! Rerum qui est eligendi dicta earum aspernatur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero soluta vel delectus repellendus fugiat, hic velit similique placeat nihil voluptatum, accusantium modi aspernatur! Rerum qui est eligendi dicta earum aspernatur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero soluta vel delectus repellendus fugiat, hic velit similique placeat nihil voluptatum, accusantium modi aspernatur! Rerum qui est eligendi dicta earum aspernatur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero soluta vel delectus repellendus fugiat, hic velit similique placeat nihil voluptatum, accusantium modi aspernatur! Rerum qui est eligendi dicta earum aspernatur.</p>
            </div>
        </div>
        <a id="participatebtn" href="#">Participate</a> -->