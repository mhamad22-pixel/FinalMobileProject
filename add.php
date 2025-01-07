---add


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

$name = $_POST['name'] ?? '';
$type = $_POST['type'] ?? '';
$dosage = $_POST['dosage'] ?? '';
$email = $_POST['email'] ?? '';

if (empty($name) || empty($type) || empty($dosage) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit();
}

$sql = "INSERT INTO pills (name, type, dosage, email) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $type, $dosage, $email);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Pill added successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to add pill']);
}

$stmt->close();
$conn->close();
?>
