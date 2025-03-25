<?php
session_start();
$doctor_fullname = $_SESSION['doctor_fullname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
    <link rel="stylesheet" href="main.css">
    <style>
        .appointment-list {
    padding: 20px;
}

.appointment-list table {
    border-collapse: collapse;
    width: 160%;
}

.appointment-list th, .appointment-list td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
}

.appointment-list th {
    background-color: #f0f0f0;
}
.accept-btn {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.accept-btn:hover {
    background-color: #45a049;
}

.reject-btn {
    background-color: #e74c3c;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-left: 10px;
}

.reject-btn:hover {
    background-color: #c0392b;
}
.rejected-appointment {
    text-decoration: line-through;
    color: #ccc;
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
        <!-- Header Section -->
<div class="header">
    <div class="header-left">
        <h3>Doctor Dashboard
        <button class="logout-btn"><?php  echo $doctor_fullname; ?></button>
        </h3>
    </div>
</div>
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
                    <img src="img/account.png" alt="Icon 3">
                    <a href="account.php">Account</a>
                </li>
                            <li>
                    <img src="img/logout.png" alt="Icon 3">
                    <a href="logout.php">Logout</a>
                </li>
                        <!-- Add more menu items as needed -->
                        </ul>
                </div>
                <div class="appointment-list">
            <h2>Appointment List</h2>
            <table>
                <tr>
                    <th>Patient Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Action</th>
                </tr>
                <?php

// Database connection
$conn = new mysqli("localhost", "root", "", "healthcare");

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the query to fetch appointments for the logged-in doctor
$query = "SELECT * FROM appointment WHERE doctor_fullname = ?";

// Prepare the statement
$stmt = $conn->prepare($query);

// Bind the doctor_fullname parameter to the prepared statement
$stmt->bind_param("s", $doctor_fullname);

// Execute the statement
$stmt->execute();

// Get the result of the query
$result = $stmt->get_result();

// Display the appointments
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['fullname'] . '</td>';
        echo '<td>' . $row['appointment_date'] . '</td>';
        echo '<td>' . $row['appointment_time'] . '</td>';
        echo '<td>';
        echo '<button class="accept-btn" onclick="acceptAppointment(' . $row['appointment_id'] . ')">Accept</button>';
        echo '<button class="reject-btn" onclick="rejectAppointment(' . $row['appointment_id'] . ')">Reject</button>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4">No appointments found.</td></tr>';
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>


            </table>
        </div>
        </div>
        <script src="main.js"></script>
        <script>
            function acceptAppointment(appointment_id) {
    // Send a request to the server to accept the appointment
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "accept_appointment.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("appointment_id=" + appointment_id);

    // Update the appointment status in the database
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert("Appointment accepted successfully!");
        } else {
            alert("Error accepting appointment!");
        }
    };
}

function rejectAppointment(appointment_id) {
    if (confirm("Are you sure you want to reject this appointment?")) {
        // Send a request to the server to reject the appointment
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "reject_appointment.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("appointment_id=" + appointment_id);

        // Update the appointment status in the database
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert("Appointment rejected successfully!");
            } else {
                alert("Error rejecting appointment!");
            }
        };
    }
}
        </script>
</body>
</html>