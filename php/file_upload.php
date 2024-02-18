<?php
function uploadFile()
{
    include("./db_connection.php");

    $target_dir = "../upload";
    $target_file = $target_dir . basename($_FILES["contact_pic"]["name"]);

    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        return true;
    }
    return false;
}
