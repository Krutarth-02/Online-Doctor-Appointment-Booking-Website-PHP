// accept_appointment.php
<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "healthcare");

// Get the appointment ID from the request
$appointment_id = $_POST['appointment_id'];

// Update the appointment status in the database
$sql = "UPDATE appointment SET status = 'accepted' WHERE appointment_id = '$appointment_id'";
$conn->query($sql);

$conn->close();
?>
