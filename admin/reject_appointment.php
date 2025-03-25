<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "healthcare");

// Get the appointment ID from the request
$appointment_id = $_POST['appointment_id'];

// Delete the appointment from the database
$sql = "DELETE FROM appointment WHERE appointment_id = '$appointment_id'";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Appointment deleted successfully!";
} else {
    echo "Error deleting appointment: " . $conn->error;
}

// Close the connection
$conn->close();
?>
