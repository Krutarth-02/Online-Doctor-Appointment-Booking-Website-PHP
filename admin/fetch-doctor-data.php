<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'healthcare');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the doctor ID from the URL
$doctorId = $_GET['doctor_id'];

// Fetch the doctor's data from the database
$sql = "SELECT * FROM doctor WHERE doctor_id = '$doctorId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(array());
}

$conn->close();
?>