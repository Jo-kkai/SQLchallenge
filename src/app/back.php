
<?php
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
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
