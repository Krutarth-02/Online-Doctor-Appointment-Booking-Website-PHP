<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
   
    <div class="form-container">
        <h2>Login</h2>
        
        <?php
        // Initialize message variable
        session_start();

        if(isset($_POST['login'])){
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
    
        }else{
            $_SESSION['username'] = '';
            $_SESSION['password'] = '';
    
        }
        $msg = '';

        // Check if there is a message passed from login_action.php
        if (isset($_GET['error'])) {
            $msg = $_GET['error'];
        }
        ?>
        
        <form action="login_action.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            
            <span style="color:red;"><?php if(!empty($msg)){ echo $msg; } ?></span>
            
            <button type="submit" name="login">Login</button>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>

    <!-- Forgot Password Form -->

</body>
</html>
