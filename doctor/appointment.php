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
    </style>
</head>
<body>
        <!-- Header Section -->
<div class="header">
    <div class="header-left">
        <h3>Doctor Dashboard</h3>
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
                    <img src="img/logout.png" alt="Icon 3">
                    <a href="../logout.php">Logout</a>
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
                // $doctor_id = $_SESSION['doctor_id'];
                // Get the appointments for the doctor
                $query = "SELECT * FROM appointment WHERE doctor_id = '1' ";
                $result = $conn->query($query);

                // Close the database connection
                $conn->close();

                // Display the appointments
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