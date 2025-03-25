<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
    exit();
}
$us = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="main.css">
    <style>
        .content img {
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
        .logout-btn {
            background-color: #2e87b7;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="header">Doctor Dashboard
        <button class="logout-btn"><?php echo htmlspecialchars($us); ?></button>
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
                    <img src="img/account.png" alt="Icon 3">
                    <a href="account.php">Account</a>
                </li>
                <li>
                    <img src="img/logout.png" alt="Icon 3">
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
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

                // Fetch data from the doctor table
                $sql = "SELECT username, password FROM doctor WHERE username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $us);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $username = $row['username'];
                    $password = $row['password'];
                } else {
                    $username = $password = "";
                }

                // Handle form submission
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    // Update the doctor table
                    $update_sql = "UPDATE doctor SET username = ?, password = ? WHERE username = ?";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bind_param("sss", $username, $password, $us);
                    if ($update_stmt->execute()) {
                        echo "<script>alert('Information updated successfully!');</script>";
                        header("Location: main.php");
                        exit();
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
</body>
</html>