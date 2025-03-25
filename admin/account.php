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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="setting.css">
    <style>
        .content img{
            height: 240px;
            margin-left: 420px;
        } 
        .form-container {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 90%;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 450px;
        }
        .form-container button:hover {
            background-color: #45a049;
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
                            <a href="">Dashboard</a>
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
                            <a href="main.php">Account</a>
                        </li>
                        <li>
                    <img src="img/logout.png" alt="Icon 3">
                    <a href="logout.php">Logout</a>
                </li>
                    </ul>
             </div>
        <!-- Content Area -->
        <div class="content">
              <div class="form-container">
              <?php
                // Database connection
                $servername = "localhost";
                $username = "root"; // Replace with your database username
                $password = ""; // Replace with your database password
                $dbname = "healthcare"; // Replace with your database name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data from the admin table
                $sql = "SELECT  username,  password FROM admin"; // Replace '1' with the admin ID you want to fetch
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // $fullname = $row['fullname'];
                    $username = $row['username'];
                    // $email = $row['email'];
                    $password = $row['password'];
                } else {
                     $username  = $password = "";
                }

                // Handle form submission
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // $fullname = $_POST['fullname'];
                    $username = $_POST['username'];
                    // $email = $_POST['email'];
                    $password = $_POST['password'];

                    // Update the admin table
                    $update_sql = "UPDATE admin SET  username = '$username', password = '$password'";
                    if ($conn->query($update_sql) === TRUE) {
                        echo "<script>
                        alert('Information updated successfully!');</script>";
                        header("Location: main.php");
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }

                $conn->close();
                ?>
                <form id="account-form" method="POST">
                
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required>

                    <button type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        document.getElementById('add-doctor-btn').addEventListener('click', function() {
            const form = document.getElementById('add-doctor-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });
    </script>
    <script src="setting.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>