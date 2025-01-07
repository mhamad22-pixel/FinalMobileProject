---delete.php

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

$sql = "DELETE FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Account deleted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete account']);
}

$stmt->close();
$conn->close();
?>
