<?php
// Start session
session_start();
if(isset($_SESSION['username'])){
    $us = $_SESSION['username'];
}else{
    header('location: ../login.php');
}
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "healthcare");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$doctor_id = $_POST['doctor_id'];
$doctor_fullname = $_POST['doctor_fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$qualification = $_POST['qualification'];
$specialization = $_POST['specialization'];
$experience = $_POST['experience'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$phone_number = $_POST['phone'];
$status = $_POST['status'];
// Update doctor details
$sql = "UPDATE doctor SET 
        doctor_fullname = '$doctor_fullname', 
        username = '$username', 
        email = '$email', 
        password = '$password', 
        qualification = '$qualification', 
        specialization = '$specialization', 
        experience = '$experience', 
        gender = '$gender', 
        address = '$address', 
        phone = '$phone_number', 
        status = '$status' 
        WHERE doctor_id = '$doctor_id'";

// Execute query
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Doctor details updated successfully!');<script>";
    header("Location: doctor_list.php");
} else {
    echo "Error updating doctor details: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>