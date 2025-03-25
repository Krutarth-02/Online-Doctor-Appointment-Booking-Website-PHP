<?php
session_start();
if(isset($_SESSION['username'])){
    $us = $_SESSION['username'];
}else{
    header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
    <link rel="stylesheet" href="../user/main.css">
 <style>
.edit-btn {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
}

.edit-btn:hover {
    background-color: #45a049;
    text-decoration: none;
}
.logout-btn {
    background-color: #2e87b7; /* Red background for the button */
    color: white; /* White text color for the button */
    border: none; /* No border */
    padding: 10px 20px; /* Padding for the button */
    text-align: center; /* Center the text in the button */
    text-decoration: none; /* No underline */
    display: inline-block; /* Make the button inline-block */
    font-size: 16px; /* Font size for the button text */
    margin: 4px 2px; /* Margin around the button */
    cursor: pointer; /* Pointer cursor on hover */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s; /* Transition effect for background color */
}

/* Change background color on hover */
.logout-btn:hover {
    background-color: #d32f2f; /* Darker red on hover */
}
</style>
</head>
<body>
<div class="header">Admin Dashboard
<button class="logout-btn"><?php  echo $us; ?></button>
</div>
<div class="container">
<div class="sidebar">
            <h3>Menu</h3>
            <ul>
                <li>
                    <img src="img/performance.png" alt="Icon 1">
                    <a href="main.php">Dashboard</a>
                </li>
                <li>
                    <img src="img/doctor.png" alt="Icon 2">
                    <a href="doctor_list.php">Doctors</a>
                </li>
                <li>
                    <img src="img/calendar.png" alt="Appointment Icon">
                    <a href="appointment.php">Appointments</a>
                </li>
                <li>
                    <img src="img/account.png" alt="Icon 4">
                    <a href="account.php">Account</a>
                </li>
                <li>
                    <img src="img/logout.png" alt="Icon 3">
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    <div class="doctor-cards-container">
<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'healthcare');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch doctors from the database
$sql = "SELECT * FROM doctor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='doctor-card'>";
        if (!empty($row['profile'])) {
            $profilePicturePath = 'uploads/' . $row['profile'];
            if (file_exists($profilePicturePath)) {
                echo '<img src="' . $profilePicturePath . '" alt="Doctor Profile Picture" class="profile-pic">';
            } else {
                echo '<img src="uploads/default-profile-picture.jpg" alt="Default Profile Picture" class="profile-pic">';
                echo '<p>Profile picture not found.</p>';
            }
        } else {
            echo '<img src="uploads/default-profile-picture.jpg" alt="Default Profile Picture" class="profile-pic">';
            echo '<p>No profile picture specified.</p>';
        }
        echo "<div class='doctor-info'>";
        echo "<h2>" . $row['doctor_fullname'] . "</h2>";
        echo "<p>Email: " . $row['email'] . "</p>";
        echo "<p>Qualification: " . $row['qualification'] . "</p>";
        echo "<p>Specialization: " . $row['specialization'] . "</p>";
        echo "<p>Doctor status: ".$row['status']. "</p>";
        echo "</div>";
        // Add Edit Button
        echo "<div class='doctor-actions'>";
        echo "<a href='edit_doctor.php?doctor_id=" . $row['doctor_id'] . "' class='edit-btn'>Edit</a>";
        echo "</div>";
        echo "</div>"; // Close doctor-card
    }
    echo "</div>"; // Close the flex container23:02 06-02-2025
} else {
    echo "<p>No doctors found.</p>";
}

$conn->close();
?>
</div>
</div>
</body>
</html>
   