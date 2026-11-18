<?php
session_start();
header('Content-Type: application/json');


$conn = mysqli_connect("db", "testuser", "testpass", "testdb");

if (!$conn) {
    http_response_code(500);
    echo json_encode(["success" => false, "error" => "db_connection_failed"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.html");
    echo json_encode(["success" => false, "error" => "method_not_allowed"]);
    exit;
}

$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

$query = "SELECT * FROM users WHERE username = '$user' AND password = '$pass' ";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    readfile(__DIR__ . '/win.html');
    exit;
}

echo json_encode(["success" => false]);
