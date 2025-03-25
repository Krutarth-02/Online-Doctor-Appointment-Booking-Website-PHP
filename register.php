<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Javascript validation function
        function validateForm(event) {
            event.preventDefault(); // Prevent form submission if validation fails

            var name = document.getElementById('Name').value;
            var username = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var nameErr = document.getElementById('nameErr');
            var usernameErr = document.getElementById('usernameErr');
            var emailErr = document.getElementById('emailErr');
            var passwordErr = document.getElementById('passwordErr');

            // Clear previous error messages
            nameErr.innerHTML = "";
            usernameErr.innerHTML = "";
            emailErr.innerHTML = "";
            passwordErr.innerHTML = "";

            // Name validation (only letters and spaces allowed)
            var namePattern = /^[A-Za-z\s]+$/;
            if (!namePattern.test(name)) {
                nameErr.innerHTML = "Name can only contain letters and spaces.";
                return false;
            }

          // Username validation (must be between 3 and 15 characters)
if (username.length < 3 || username.length > 15) {
    usernameErr.innerHTML = "Username must be between 3 and 15 characters.";
    return false;
}
            // Email validation
            var emailPattern = /^[^@]+@[^@]+\.[^@]+$/;
            if (!emailPattern.test(email)) {
                emailErr.innerHTML = "Please enter a valid email address.";
                return false;
            }

            // Password validation (must be at least 6 characters)
            if (password.length < 6) {
                passwordErr.innerHTML = "Password must be at least 6 characters long.";
                return false;
            }

            // If no validation errors, submit the form
            document.getElementById('registerForm').submit();
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>

        <?php
        // Initialize message variable
        $msg = ''; 

        // Check if there is a message passed from login_action.php
        if (isset($_GET['error'])) {
            $msg = $_GET['error'];
        }
        ?>
        <form id="registerForm" action="register_action.php" method="POST" onsubmit="validateForm(event)">
            <label for="Name">Name</label>
            <input type="text" id="Name" name="Name" required>
            <span id="nameErr" style="color:red;"></span>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <span id="usernameErr" style="color:red;"></span>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <span id="emailErr" style="color:red;"></span>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <span id="passwordErr" style="color:red;"></span>
        
            <span style="color:red;"><?php if(!empty($msg)){ echo $msg; } ?></span>

            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>
