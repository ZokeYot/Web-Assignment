<?php
header('Content-Type', "application/json");
include("./DB_Connection.php");

$data = json_decode(file_get_contents('php://input'), true);
$email = $data["Email_Address"];
$password = $data["Password"];

$query = "SELECT Password from user where Email_Address = ?";
$sql = $con->prepare($query);
$sql->bind_param("s", $email);
$sql->execute();
$result = $sql->get_result();
if ($row = $result->fetch_assoc()) {
    echo json_encode(['status' => $row["Password"] === $password ? "success" : "failed"]);
} else {
    http_response_code(500);
    echo json_encode(['status' => "invalid"]);
}
