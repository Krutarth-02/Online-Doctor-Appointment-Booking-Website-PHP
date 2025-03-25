<?php
session_start();



// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "healthcare";
$conn = new mysqli($servername, $username, $password, $database);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input values
    $name = $_POST['Name'];
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

        // SQL query to insert the user into the database
        $sql = "INSERT INTO user (Name, username, email, password) VALUES ('$name', '$user', '$email', '$pass')";

        if ($conn->query($sql) === TRUE) {
            // Get the inserted user ID
            $user_id = $conn->insert_id;
            $_SESSION['user_id'] = $user_id;

            // Redirect to login page
            header("Location: login.php");
        } else {
            // Show an error message if the query fails
            $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

?>
