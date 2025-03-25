<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "healthcare");
session_start();
$user_id = $_SESSION['user_id'];
$us = $_SESSION['username'];
// Get the user ID from the database
$query = "SELECT user_id FROM user WHERE username = '$us'";
$result = $conn->query($query);
$user_data = $result->fetch_assoc();
$user_id = $user_data['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link rel="stylesheet" href="main.css">
    <style>
          .notification-menu {
            position: absolute;
            top: 100px;
            right: 250px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            width: 900px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
           
        }
.notification-menu ul li {
    padding: 15px;
    border-bottom: 1px solid #eee;
    margin-bottom: 10px; /* Add spacing between notifications */
}

.notification-menu ul li:last-child {
    border-bottom: none;
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
    </div>

    <!-- Notification Menu -->
    <div class="notification-menu">
      
        <ul>
        <?php
// Database connection
$conn = new mysqli("localhost", "root", "", "healthcare");


// Get the appointments for the user
$query = "SELECT * FROM appointment WHERE user_id = '$user_id' ORDER BY appointment_date DESC";
$result = $conn->query($query);

// Display the appointments
while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>You  Appoint ' . $row['doctor_fullname'] .' at ' . $row['appointment_time'] .' in '.$row['appointment_date']. '</td><br><br>';
    echo '</tr>';
}?>
        </ul>
    </div>
    <script>
        // Get the notification menu
        var notificationMenu = document.querySelector('.notification-menu');

        // Get the notification icon
        var notificationIcon = document.querySelector('.notification-icon');

        // Add an event listener to the notification icon
        notificationIcon.addEventListener('click', function() {
            // Toggle the notification menu
            notificationMenu.style.display = notificationMenu.style.display === 'block' ? 'none' : 'block';
        });
    </script>
</body>
</html>