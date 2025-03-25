<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "healthcare");
session_start();
$us = $_SESSION['username'];
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$doctor_id = $_GET['doctor_id'];
// Query to retrieve appointment details
$sql = "SELECT * FROM doctor WHERE doctor_id='$doctor_id'";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result) {
    // Get appointment details
    $row = mysqli_fetch_assoc($result);
    $doctor_fullname = $row["doctor_fullname"];
    $username = $row['username'];
    $email = $row['email'];
    $password = $row["password"];
    $qualification = $row["qualification"];
    $specialization = $row["specialization"];
    $experience = $row['experience'];
    $gender = $row['gender'];
    $time = $row['doctor_time'];
    $address = $row['address'];
    $phone_number = $row['phone'];
    $status = $row['status'];
    $profile = $row['profile'];
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="main.css">
    <style>
        /* Form Styles */
        form {
    width: 350%;
    margin: 40px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    max-height: 550px; /* adjust this value to your desired height */
    overflow:auto;
    margin-left: 20px;
    }
    ::-webkit-scrollbar{
        display: none;
    }
        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="date"], input[type="time"], select {
            width: 100%;
            height: 40px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            height: 40px;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
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
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <!-- Content Area -->
        <div>
            <h2>Edit Appointment</h2>
            <form action="update_appointment.php" method="post">
                <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
                <label for="fullname">Full Name:</label>
                <input type="text" id="doctor_fullname" name="doctor_fullname" value="<?php echo $doctor_fullname; ?>">
                <label for="user">User:</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" value="<?php echo $password; ?>">
                <label for="qualification">Qualification:</label>
                <input type="text" id="qualification" name="qualification" value="<?php echo $qualification; ?>">
                <label for="specialization">Specialization:</label>
                <input type="text" id="specialization" name="specialization" value="<?php echo $specialization; ?>">
                <label for="experience">Experience:</label>
                <input type="text" id="experience" name="experience" value="<?php echo $experience; ?>">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="<?php echo $gender; ?>">Male</option>
                    <option value="<?php echo $gender; ?>">Female</option>
                </select>
                <label for="doctor time">Doctor Time:</label>
                <input type="time" id="doctor_time" name="doctor_time" value="<?php echo $time; ?>">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $address; ?>">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $phone_number; ?>">
                <label for="status">Status:</label>
                <select id="" name="status">
                    <option vstatusalue="<?php echo $status; ?>">Active</option>
                    <option value="<?php echo $status; ?>">Inactive</option>
                </select>
             <br>
                <input type="submit" value="Update Doctor">
            </form>
        </div>
    </div>
</body>
</html>