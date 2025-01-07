---account.php

<?php
header('Content-Type: application/json');


$servername = "https://12033267srour.atwebpages.com";
$username = "mhmd";
$password = "mhmd717";
$dbname = "4572107_mhmdsrour";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

$email = $_POST['email'] ?? '';

if (empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Email is required']);
    exit();
}

$sql = "SELECT id, name, email, age, gender FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userInfo = [];
    while ($row = $result->fetch_assoc()) {
        $userInfo[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $userInfo]);
} else {
    echo json_encode(['success' => false, 'message' => 'User not found']);
}

$stmt->close();
$conn->close();
?>
