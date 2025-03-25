<?php

session_start();
if(isset($_SESSION['username'])){
    $us = $_SESSION['username'];
}else{
    header('location: ../login.php');
}
// Database connection
$conn = new mysqli('localhost', 'root', '', 'healthcare');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the updated data from the request
$doctorId = $_POST['doctor_id'];
$fullname = $_POST['doctor_fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$specialization = $_POST['specialization'];
$qualification = $_POST['qualification'];
$time = $_POST['doctor_time'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$status = $_POST['status'];
// Update the doctor's profile in the database
$sql = "UPDATE doctor SET doctor_fullname = '$fullname', username = '$username',email = '$email',password = '$password', specialization = '$specialization', qualification = '$qualification', doctor_time = '$time'  ,address = '$address',phone = '$phone', status = '$status' WHERE doctor_id = '$doctorId'";
$conn->query($sql);

$conn->close();
?>