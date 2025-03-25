<?php 
session_start();

// Store username and password in the session
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];

$us = $_SESSION['username'];                    
$ps = $_SESSION['password'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "healthcare";
 
$conn = new mysqli($servername, $username, $password, $database);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check for admin credentials
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Successful admin login
        header("Location: admin/main.php");
        exit();
    } else {
        // Check for doctor credentials
        $stmt = $conn->prepare("SELECT * FROM doctor WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Successful doctor login
            $doctor = $result->fetch_assoc(); // Fetch doctor data
            $_SESSION['doctor_id'] = $doctor['doctor_id']; // Store doctor_id in session
            $_SESSION['doctor_fullname'] = $doctor['doctor_fullname']; // Store doctor's full name in session
            $_SESSION['specialization'] = $doctor['specialization']; // Store doctor's specialization in session
            header("Location: doctor/main.php");
            exit();
        } else {
            // Check for user credentials
            $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows == 1) {
                // Successful user login
                $user = $result->fetch_assoc(); // Fetch user data
                $_SESSION['user_id'] = $user['user_id']; // Store user_id in session
                header("Location: user/main.php");
                exit();
            } else {
                // Redirect back to login.php with an error message
                $error_message = urlencode('Invalid username or password. Please try again.');
                header("Location: login.php?error=$error_message");
                exit();
            }
        }
    }
}

?>
