<?php
$error = false;
if (isset($_POST['create-activity'])) {
    try {
        include('../../php/db_connection.php');

        $organizer_id = 1;
        $title = $_POST['title'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $duration = $_POST['duration'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);


        $query = "INSERT INTO activity(User_ID , Title , Date , Time , Duration , Location , Description , Thumbnail , Status )
                    VALUES ('$organizer_id' , '$title' , '$date' , '$time' , '$duration' , '$location' , '$description' , ? , 'Waiting')";

        $sql = mysqli_prepare($con, $query);
        $sql->bind_param('s', $thumbnail);
        $sql->execute();
        $result = $stmt->affected_rows;

        if ($result == 1) {
            echo '<script>
            alert("Activity Created");
                </script>';
        } else {
            throw new Exception('Create Activity Faield');
        }
    } catch (Exception $e) {
        $error = true;
        $messagesHtml = "<div class='error-messages'>" . $e->getMessage() . "</div>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./create-activity.css">
    <style>
        form {
            display: flex;
            flex-direction: column;
            width: 40%;
            border: 2px solid black;
            margin: 0 auto
        }

        .form-group {
            position: relative;
            margin: 20px 0;
            display: flex;
            flex-direction: column;
        }

        /*
        input,
        textarea {
            display: block;
            border: none;
            border-bottom: 2ps solid rgba(0, 0, 0, 0.12);
        }

        input:focus~label {
            transform: translateY(-20px);
            font-size: 14px;
            color: #3498db;
        }

        label {
            position: absolute;
            bottom: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
        } */
    </style>
</head>

<body>
    <script>
        function updateTextInput(val) {
            document.getElementById('textInput').value = val;
        }

        function updateRangeInput(val) {
            document.getElementById('duration').value = val;
        }
    </script>
    <main>
        <div class="form-container">
            <form method="post" enctype="multipart/form-data">
                <h1>Create Activity </h1>
                <div class="form-group">
                    <label for="title">Activity Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="date">Activity Date:</label>
                    <input type="date" id="date" name="date" placeholder="Select Date" required>
                </div>

                <div class="form-group">
                    <label for="time">Activity Time</label>
                    <input type="time" id="time" name="time" requried> </input>
                </div>

                <div class="form-group">
                    <label for="duration">Activity Duration:</label>
                    <div>
                        <input type="range" id="duration" name="duration" max=30 min=0 oninput='updateTextInput(this.value)' required>
                        <input type="number" name="" id="textInput" max=30 min=0 oninput='updateRangeInput(this.value)' value=''>
                    </div>
                </div>



                <div class="form-group">
                    <label for="location">Activity Location</label>
                    <textarea id="location" name="location" requried> </textarea>
                </div>

                <div class="form-group">
                    <label for="description">Activity Description</label>
                    <textarea name='description' required></textarea>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Upload Picture</label>
                    <input type="file" name='thumbnail' id="thumbnail" accept="image/*">
                </div>

                <div class="form-group">
                    <button name="create-activity">Create Activity</button>
                </div>
            </form>

            <div>
                <?php if ($error) {
                    echo  $messagesHtml;
                } ?>
            </div>
        </div>
    </main>
</body>

</html>