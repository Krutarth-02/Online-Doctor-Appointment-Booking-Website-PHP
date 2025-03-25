<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
    <link rel="stylesheet" href="main.css">
    <style>
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
        .doctor-info label {
            font-weight: bold; /* Bold labels */
            width: 150px; /* Fixed width for labels */
        }
        .profile-pic {
            width: 50px; /* Set width for profile picture */
            height: 50px; /* Set height for profile picture */
            border-radius: 50%; /* Make it circular */
            object-fit: cover; /* Cover the area without distortion */
            margin-bottom:15px;
        } 
        .doctor-info {
             display: flex;
             flex-direction: column;
             gap: 10px;
        }

        .doctor-info label {
            font-weight: bold;
            color: #333;
        }

        .doctor-info p {
            margin: 0;
            color: #555;
        }
    </style>
</head>
<body>
<div class="header">Admin Dashboard</div>
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
                    <img src="img/geriatrics.png" alt="Icon 3">
                    <a href="">Patients</a>
                </li>
                <li>
                    <img src="img/calendar.png" alt="Appointment Icon">
                    <a href="">Appointments</a>
                </li>
                <li>
                    <img src="img/calendar.png" alt="Schedule Icon">
                    <a href="">Doctor Schedule</a>
                </li>
                <li>
                    <img src="img/human.png" alt="Department Icon">
                    <a href="">Departments</a>
                </li>
                <li>
                    <img src="img/setting.png" alt="Icon 4">
                    <a href="setting.php">Settings</a>
                </li>
                <li>
                    <img src="img/logout.png" alt="Icon 3">
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
   

<div class="doctor-cards-container">
    <?php
    // Fetch doctor details from the database
    $conn = new mysqli('localhost','root','','healthcare');
    $search_input = $_GET['search'];
    $sql = "SELECT * FROM doctor WHERE fullname LIKE '%$search_input%' OR specialization LIKE '%$search_input%' OR experience LIKE '%$search_input%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class='doctor-card'>";
            if (!empty($row['profile'])) {
                echo "<img src='" . $row['profile'] . "' class='profile-pic' alt='Profile Picture'>";
            } else {
                echo "<img src='uploads/login.jpg' class='profile-pic' alt='Default Profile Picture'>";
            }
            echo "<div class='doctor-info'>";
            echo "<p>" . $row['fullname'] . "</p>";
            echo "<p>" . $row['email'] . "</p>";
            echo "<p>" . $row['qualification'] . "</p>";
            echo "<p>" . $row['specialization'] . "</p>";
            echo "</div>";
            // Add Edit Button
            echo "<div class='doctor-actions'>";
            echo "<a href='edit_doctor.php?id=" . $row['doctor_id'] . "' class='edit-btn'>Edit</a>";
            echo "</div>";
            echo "</div>"; // Close doctor-card
        }
        echo "</div>"; // Close the flex container
    } else {
        echo "<p>No doctors found.</p>";
    }
    
    ?>

    </div>
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
</body>
</html>
