<?php
$host = "localhost";
$dbName = "serveconnect";
$username = "root";
$password = "";
$con = mysqli_connect($host, $username, $password, $dbName);
// Check connection (optional)
if (mysqli_connect_errno()) {
    echo "Failed to connect to MsesySQL: " . mysqli_connect_error();
}
