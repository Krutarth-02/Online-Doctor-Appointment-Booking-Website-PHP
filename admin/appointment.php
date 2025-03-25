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
    <title>Admin</title>
    <link rel="stylesheet" href="main.css">
    <style>
        /* Table View Styles */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        td {
            background-color: #fff;
        }

        th:first-child, td:first-child {
            padding-left: 20px;
        }

        th:last-child, td:last-child {
            padding-right: 20px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        /* Action Links Styles */
        td a {
            text-decoration: none;
            color: #337ab7;
            margin-right: 10px;
        }

        td a:hover {
            color: #23527c;
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
        <!-- Content Area -->
        <div>
            <h2>Appointments</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Connect to database
                    $conn = mysqli_connect("localhost", "root", "", "healthcare");

                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Query to retrieve appointments
                    $sql = "SELECT * FROM appointment";
                    $result = mysqli_query($conn, $sql);

                    // Check if query was successful
                    if ($result) {
                        // Loop through each appointment
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["appointment_id"] . "</td>";
                            echo "<td>" . $row["fullname"] . "</td>";
                            echo "<td>" . $row["doctor_fullname"] . "</td>";
                            echo "<td>" . $row["gender"] . "</td>";
                            echo "<td>" . $row["age"] . "</td>";
                            echo "<td>" . $row["appointment_date"] . "</td>";
                            echo "<td>" . $row["appointment_time"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            echo '<td>';
                            echo '<button class="accept-btn" onclick="acceptAppointment(' . $row['appointment_id'] . ')">Accept</button>';
                            echo '<button class="reject-btn" onclick="rejectAppointment(' . $row['appointment_id'] . ')">Reject</button>';
                            echo '</td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }

                    // Close connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
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