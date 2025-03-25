<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'healthcare');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the total number of doctors
$sql = "SELECT COUNT(*) as doctorCount FROM doctor";
$result = $conn->query($sql);
$doctorCount = $result->fetch_assoc()['doctorCount'];

$sql = "SELECT COUNT(*) as patientCount FROM appointment";
$result = $conn->query($sql);
$patientCount = $result->fetch_assoc()['patientCount'];

$sql = "SELECT COUNT(*) as appointmentCount FROM appointment";
$result = $conn->query($sql);
$appointmentCount = $result->fetch_assoc()['appointmentCount'];

// Return the counts as JSON
echo json_encode(array('doctorCount' => $doctorCount, 'patientCount' => $patientCount, 'appointmentCount' => $appointmentCount));


$conn->close();
?>