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
        .doctor-cards-container {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    align-items: center;
    padding: 20px;
    width: 1000px; /* Set a maximum width for the container */
    height: 180px; /* Set a maximum height for the container */
    overflow-y: auto; /* Add a scrollbar when the content exceeds the height */
    scrollbar-width: none;
}
 .doctor-card {
    border: 1px solid #ccc; /* Light gray border */
    border-radius: 5px; /* Rounded corners */
    padding: 15px; /* Space inside the card */
    margin: 10px 0; /* Space outside the card */
    background-color: #f9f9f9; /* Light background color */
    display: flex; /* Use flexbox for layout */
    align-items: center; /* Center items vertically */
    margin-left: 40px;

}

.doctor-info {
    display: flex; /* Use flexbox for inline display */
    justify-content: space-between; /* Space between label and value */
    width: 100%; /* Full width for the info */
    margin-left: 15px; /* Space between image and text */
    
}

.doctor-info span {
    font-weight: bold; /* Bold labels */
    width: 150px; /* Fixed width for labels */
    margin-right: 20px; /* Space between labels */
}

.doctor-info span:last-child {
    margin-right: 0; /* No margin for the last label */
}
/* Style for the header */
.header {
    background-color: #2e87b7; /* Green background */
    color: white; /* White text color */
    padding: 15px; /* Padding around the header */
    text-align: center; /* Center the text */
    font-size: 24px; /* Font size for the header text */
}

/* Style for the logout button */
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
    

        <div id="dashboard-container">
            <h2 id="dashboard-label">Dashboard</h2>
            <button id="add-doctor-btn">Add Doctor</button>
            <!-- New Section for Totals -->
            <div id="totals-container">
                <div class="totals-box">
                    <img src="img/appointment.png" alt="Total Appointments" class="totals-icon">
                    <h4>Total Appointments</h4>
                    <p id="total-appointments">1</p>
                </div>
                <div class="totals-box">
                    <img src="img/fever.png" alt="Total Patients" class="totals-icon">
                    <h4>Total Patients</h4>
                    <p id="total-patients">0</p>
                </div>
                <div class="totals-box">
                    <img src="img/medical-team.png" alt="Total Doctors" class="totals-icon">
                    <h4>Total Doctors</h4>
                    <p id="total-doctors">0</p>
                </div>
            </div>
<!-- Doctor List -->

    <div id="doctor-list" >
        <!-- Doctor cards will be populated here -->
        <h2>Doctor List</h2>
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
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="doctor-card">';
                    echo '<div class="doctor-info">';
                    // echo '<img src="uploads/' . $row['profile'] .'">';
                    echo '<span>' . $row['doctor_fullname'] . '</span>';
                    echo '<span>' . $row['specialization'] . '</span>';
                    echo '<span>' . $row['qualification'] . '</span>';
                    echo '<span>' . $row['experience'] . ' years of experience</span>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo 'No doctors found.';
            }

            $conn->close();
            ?>
        </div>
    </div>
<!-- Add Doctor Form -->
<!-- Doctor form (initially hidden) -->
<div id="add-doctor-form" style="display: none;">
    <!-- Your doctor form fields here --> 
    <form method="post" action="add_doctor.php">
        <!-- Form fields -->
       <center><h2>Add Doctor Form</h2></center><br>
        <label for="fullname">Full Name:</label>
  <input type="text" id="doctor_fullname" name="doctor_fullname">

  <label for="username">Username:</label>
  <input type="text" id="username" name="username">

  <label for="email">Email:</label>
  <input type="email" id="email" name="email">

  <label for="password">Password:</label>
  <input type="password" id="password" name="password">

  <label for="qualification">Qualification:</label>
  <input type="text" id="qualification" name="qualification">

  <label for="specialization">Specialization:</label>
  <input type="text" id="specialization" name="specialization">

  <label for="experience">Experience:</label>
  <input type="number" id="experience" name="experience">

  <label for="gender">Gender:</label>
  <select id="gender" name="gender">
    <option value="">Select Gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select>

  <label for="doctor_time">Doctor Time:</label>
  <input type="time" id="doctor_time" name="doctor_time">

  <label for="address">Address:</label>
  <input type="text" id="address" name="address">

  <label for="phone">Phone:</label>
  <input type="text" id="phone" name="phone">

  <label for="status">Status:</label>
  <select id="status" name="status">
    <option value="">Select Status</option>
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
  </select>

  <label for="profile">Profile:</label>
  <input type="file" id="profile" name="profile">

  <button type="submit" onclick="">Submit</button>
    </form>
</div>
        </div>
    </div>
<script>
    // Get the doctor card count element
const doctorCountElement = document.getElementById('total-doctors');
const patientCountElement = document.getElementById('total-patients');
const appointmentCountElement = document.getElementById('total-appointments');

// Function to update the doctor card count
function updateDoctorCount() {
    // Fetch the total number of doctors from the database
    fetch('fetch_doctor_count.php')
        .then(response => response.json())
        .then(data => {
            // Update the doctor card count element
            doctorCountElement.textContent = data.doctorCount;
            patientCountElement.textContent = data.patientCount;
            appointmentCountElement.textContent = data.appointmentCount;
        })
        .catch(error => console.error('Error:', error));
}

// Call the updateDoctorCount function when the page loads
document.addEventListener('DOMContentLoaded', updateDoctorCount);

// Call the updateDoctorCount function when a new doctor is added
document.getElementById('add-doctor-form').addEventListener('submit', updateDoctorCount);
</script>
<script>
        document.getElementById('add-doctor-btn').addEventListener('click', function() {
            const form = document.getElementById('add-doctor-form');
            form.style.display  === 'none' ? 'flex' : 'none';
        
        });
    </script>
    <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>