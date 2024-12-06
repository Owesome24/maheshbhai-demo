<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);

$mysqli = new mysqli("localhost", "username", "password", "database");

if ($mysqli->connect_error) {
    die(json_encode(["message" => "Database connection failed: " . $mysqli->connect_error]));
}

$stmt = $mysqli->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    echo json_encode(["message" => "Signup successful"]);
} else {
    echo json_encode(["message" => "Signup failed"]);
}

$stmt->close();
$mysqli->close();
?>
