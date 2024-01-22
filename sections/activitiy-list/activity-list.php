<?php

include("../../php/db_connection.php");

$query = "SELECT * FROM activity Join user on activity.User_ID = user.User_ID";
$sql = $con->query($query);
$column = ["Activity_ID", "Name", "Title", "Date", "Duration", "Location", "Description", "Status"]
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./activity-list.css">
</head>

<body>
    <main>
        <script src="./activity-list.js"></script>
        <table class="table">
            <thead class="table-head">
                <th>Activity_ID</th>
                <th>Organizer</th>
                <th>Title</th>
                <th>Date</th>
                <th>Duration</th>
                <th>Location</th>
                <th>Description</th>
                <th>Status</th>
            </thead>
            <?php
            if ($sql) {
                while ($row = $sql->fetch_assoc()) {
                    $activity_id = $row["Activity_ID"];
                    $user_id = $row['User_ID'];
                    echo "<tr class = 'table-row'>";
                    foreach ($column as $data) {
                        echo "<td class = 'table-cell'> $row[$data]</td>";
                    }
                    echo "<td>
                            <button onclick='showDetails(\"$activity_id\")' id='details-button'>Details</button> 
                            <button onclick='joinActivity(\"$user_id\" , \"$activity_id\")' id='join-button'>Join</button> 
                        </td>";
                    echo "</tr>";
                }
            }
            ?>

        </table>
    </main>
    <div class="event-container">
        <div>
            <img class='activity-pic' src='data:image/jpeg;base64,{$picture}'>
        </div>
        <div class="event-title">
            <p></p>
        </div>
    </div>

</body>

</html>