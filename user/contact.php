<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="header">
        <h1><img src="uploads/healthcare.png" alt="">Healthcare</h1>
            <div class="header-links">
                <h3><a href="doctors.php"> All Doctor</a></h3>
                <h3><a href="about.php"> About Us</a></h3>
                <h3><a href="contact.php"> Contact Us</a></h3>
            </div>
            <div class="profile-section">
                <div class="profile-logo" onclick="toggleDropdown()">
                    <img src="uploads/profile-logo.jpg" alt="Profile Logo">
                    <span class="username">Kurtarth211</span>
                </div>
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="#">My Profile</a>
                    <a href="#">My Appointments</a>
                    <a href="../login.php">Logout</a>
                </div>
            </div>
    </div>

    <div class="contant">
        <!--  body of the code -->
    </div>

    <div class="footer">
            <!-- footer of the page -->
    </div>
    <script src="main.js"></script>
</body>
</html>