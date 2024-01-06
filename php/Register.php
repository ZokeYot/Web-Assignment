<?php
header('Content-Type', "application/json");
try {
    include("./DB_Connection.php");

    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data["Name"];
    $email = $data["Email_Address"];
    $password = $data["Password"];
    $gender = $data["Gender"];
    $dob = $data["DOB"];
    $description = $data["User_Description"];

    $filter = "SELECT EMAIL_Address FROM user where EMAIL_Address = ?";
    $filter_sql = $con->prepare($filter);
    $filter_sql->bind_param("s", $email);
    $filter_sql->execute();
    $result = $filter_sql->get_result();


    if ($result->num_rows > 0) {
        throw new Exception("Email Address already exists in the database");
    }
    $query = "INSERT INTO user(Name, Email_Address, Password, Gender, DOB, User_Description) VALUES (? , ? , ? , ? , ? , ?)";
    $sql = $con->prepare($query);
    $sql->bind_param("ssssss", $name, $email, $password, $gender, $dob, $description);
    $sql->execute();
    echo json_encode(['status' => 'success', 'messages' => 'User registered successfully']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'messages' => $e->getMessage()]);
}
