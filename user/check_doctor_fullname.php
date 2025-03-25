<?php

$conn = mysqli_connect('localhost', 'root', '', 'healthcare');

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

$doctorFullname = $_POST['doctor_fullname'];

$stmt = $conn->prepare("SELECT * FROM doctor WHERE doctor_fullname = ?");
$stmt->bind_param("s", $doctorFullname);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo 'true';
} else {
    echo 'false';
}

$stmt->close();
$conn->close();
?>