<?php
session_start();
$us = $_SESSION['user_id'];
$user = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="main.css">
    <style>
        .doctor-card {
    width: 450px;
    height: 280px;
    border: 1px solid #ccc;
    border-radius: 15px;
    padding: 15px;
    background-color: #f9f9f9;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 20px;
    margin-top: 120px;
    flex-basis: 250px;
}

.profile-pic {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
}

.doctor-info {
    width: 100%;
    margin-left: 15px;
}

.doctor-info h2 {
    font-size: 18px;
    margin-bottom: 10px;
}

.doctor-info p {
    font-size: 14px;
    margin-bottom: 10px;
}

.book-btn {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.book-btn:hover {
    background-color: #45a049;
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
<div class="header">User Dashboard
<button class="logout-btn"><?php  echo $user; ?></button>    
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
                    <img src="img/invoice.png" alt="Icon 2">
                    <a href="invoice.php">Invoice</a>
                </li>
                <li>
                    <img src="img/bell.png" alt="Icon 3">
                    <a href="notification.php">Notification</a>
                </li>
                <li>
                    <img src="img/account.png" alt="Icon 3">
                    <a href="account.php">Account</a>
                </li>
                <li>
                    <img src="img/logout.png" alt="Icon 3">
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div id="dashboard-container">
            <h2 id="dashboard-label">Dashboard</h2>
             <button class="book-btn" onclick="showAppointmentDetails()">Book Appointment</button>
</div>
        <!-- Add a search bar to the top of the page -->
        <!-- Add a search bar to the right side of the body section -->
        <div class="search-bar-right">
            <form action="search.php" method="get">
                <input type="text" name="search" placeholder="Search for doctors...">
                <button type="submit">Search</button>
            </form>
        </div>
   
<!-- Create a container for the doctor cards -->

<div class="doctor-cards-container">

    <?php
    // Fetch doctor details from the database
    $conn = new mysqli('localhost','root','','healthcare');
    $sql = "SELECT * FROM doctor";
    $result = $conn->query($sql);
    $names = [];

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $names[] = $row['doctor_fullname'];
            echo '<div class="doctor-card">';
            if (!empty($row['profile'])) {
                echo '<img src="uploads/' . $row['profile'] . '" alt="Doctor Profile Picture" class="profile-pic">';
            } else {
                echo '<img src="uploads/default-profile-picture.jpg" alt="Default Profile Picture" class="profile-pic">';
            }
            echo '<div class="doctor-info">';
            echo '<h2>' . $row['doctor_fullname'] . '</h2>';
            echo '<p>Specialization: ' . $row['specialization'] . '</p>';
            echo '<p>Qualification: ' . $row['qualification'] . '</p>';
            echo '<p>Experience: ' . $row['experience'] . ' years</p>';
            echo '<p>Status: ' . $row['status'] . '</p>';
            // echo '<button class="book-btn" onclick="showAppointmentDetails()" data-doctor-id="' . $row['doctor_id'] . '">Book Appointment</button>'; // Add data attribute for doctor_id
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "No doctors found.";
    }
    $names_str = implode(",",$names)
    ?>

</div>
     <!-- Add a div to display the appointment form -->
     <div class="appointment-form" style="display: none;">
     <button class="close-btn" onclick="hideForm()">×</button>
            <form action="book_appointment.php" method="post">
            <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
                <h2>Book Appointment</h2>
                <div class="form-group">
                    <label for="fullname">Full Name:</label>
                    <input type="text" id="fullname" name="fullname" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="age">Doctor Fullname:</label>
                    <input type="text" id="doctor_fullname" name="doctor_fullname" required>
                    <span id="doctor-error" style="color: red;"></span>
                </div>
            
                <div class="form-group">
                    <label for="disease">Disease:</label>
                    <input type="text" id="disease" name="disease" required>
                </div>
                <div class="form-group">
                    <label for="appointment_date">Appointment Date:</label>
                    <input type="date" id="appointment_date" name="appointment_date" required>
                </div>
                <div class="form-group">
                    <label for="appointment_time">Appointment Time:</label>
                    <input type="time" id="appointment_time" name="appointment_time" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" required>
                </div>
                <div class="form-group">
                    <label for="remark">Remark:</label>
                    <textarea id="remark" name="remark"></textarea>
                </div>
                <button type="submit" class="book-appointment-btn">Book Appointment</button>
            </form>
        </div>
    </div>
    
    <script src="main.js"></script>
    <script>
        // Search functionality
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
    var searchInput = document.querySelector('input[name="search"]').value;
    var doctorCards = document.querySelectorAll('.doctor-card');

    doctorCards.forEach(function(card) {
        var doctorName = card.querySelector('h2').textContent;
        var doctorSpecialization = card.querySelector('p:nth-child(2)').textContent;
        var doctorExperience = card.querySelector('p:nth-child(3)').textContent;

        if (doctorName.toLowerCase().includes(searchInput.toLowerCase()) || doctorSpecialization.toLowerCase().includes(searchInput.toLowerCase()) || doctorExperience.toLowerCase().includes(searchInput.toLowerCase())) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});
    </script>
    <script>
        // Get all doctor cards
var doctorCards = document.querySelectorAll('.doctor-card');

// Loop through each doctor card
doctorCards.forEach(function(card) {
    // Get the Book Appointment button
    var bookAppointmentButton = card.querySelector('.book-btn');

    // Add an event listener to the Book Appointment button
    bookAppointmentButton.addEventListener('click', function() {
        // Show the appointment form
        var appointmentForm = document.querySelector('.appointment-form');
        appointmentForm.style.display = 'block';

        // Hide the doctor card and search bar
        var doctorCard = document.querySelector('.doctor-card');
        var searchBar = document.querySelector('.search-bar-right');
        doctorCard.style.display = 'none';
        searchBar.style.display = 'none';
    });
});
    </script>
    <script>
        const doctorFullnameInput = document.getElementById('doctor_fullname');
        const doctorErrorSpan = document.getElementById('doctor-error');

doctorFullnameInput.addEventListener('input', function() {
    const doctorFullname = this.value.trim();
    if (doctorFullname !== '') {
        checkDoctorFullname(doctorFullname);
    } else {
        doctorErrorSpan.textContent = '';
    }
});

function checkDoctorFullname(doctorFullname) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'check_doctor_fullname.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = xhr.responseText;
            if (response === 'true') {
                doctorErrorSpan.textContent = '';
            } else {
                doctorErrorSpan.textContent = 'Doctor not found in the given List Please enter valid Name';
            }
        }
    };
    xhr.send('doctor_fullname=' + doctorFullname);
}
    </script>
</body>
</html>