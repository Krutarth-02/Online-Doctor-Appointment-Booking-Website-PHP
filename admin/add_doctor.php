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

// Insert data into database
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['doctor_fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $qualification = $_POST['qualification'];
    $specialization = $_POST['specialization'];
    $experience = $_POST['experience'];
    $gender = $_POST['gender'];
    $time = $_POST['doctor_time'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    $profile = $_POST['profile'];

    // Move the uploaded file to the target directory
           // Prepare SQL statement
        $sql = "INSERT INTO doctor (doctor_fullname, username, email, password, qualification, specialization, experience, gender,doctor_time, address, phone, status, profile)
                VALUES ('$fullname', '$username', '$email', '$password', '$qualification', '$specialization', '$experience', '$gender','$time', '$address', '$phone', '$status', '$profile')";

        if ($conn->query($sql) === TRUE) {
            // Show alert and redirect
            echo "<script>
                    alert('Data Inserted Successfully.');
                    window.location.href = 'main.php';
                  </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } 

    $conn->close();

?>