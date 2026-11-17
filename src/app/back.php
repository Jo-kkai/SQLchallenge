
<?php
$conn = mysqli_connect("db", "testuser", "testpass", "testdb");

if (!$conn) {
    http_response_code(500);
    echo "Database connection failed";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.html");
    exit;
}

$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

$query = "SELECT * FROM users WHERE username = '$user' AND password = '$pass' ";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    header("Location: win.html");
    exit;
}

http_response_code(200);
echo "invalid credentials";
