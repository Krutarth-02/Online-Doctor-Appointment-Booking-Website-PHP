<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>
    alert('Please log in to book an appointment.');
    window.location.href = 'login.php';
    </script>";
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'healthcare');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];  // Get user_id from session
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $doctor_fullname = $_POST['doctor_fullname'];
    $disease = $_POST['disease'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $remark = $_POST['remark'];
    
    // Fetch user details
    $user_query = $conn->prepare("SELECT username, email FROM user WHERE user_id = ?");
    $user_query->bind_param("i", $user_id);
    $user_query->execute();
    $user_result = $user_query->get_result();
    
    if ($user_result->num_rows > 0) {
        $user_data = $user_result->fetch_assoc();
        $username = $user_data['username'];  
        $email = $user_data['email'];       
    } else {
        echo "<script>alert('User not found. Please log in again.'); window.location.href = 'login.php';</script>";
        exit();
    }

    // Check if the doctor is already booked for the selected date and time
    $appointment_check_query = $conn->prepare("SELECT * FROM appointment WHERE doctor_fullname = '$doctor_fullname' AND appointment_date = '$appointment_date' AND appointment_time = '$appointment_time' AND status != 'accepted'");
    $appointment_check_query->execute();
    $appointment_check_result = $appointment_check_query->get_result();

    if ($appointment_check_result->num_rows > 0) {
        echo "<script>alert('This doctor is already booked for the selected date and time. Please choose another time.'); window.location.href = 'main.php';</script>";
        exit();
    }

    // Insert appointment data into the database
    try {
        $sql = "INSERT INTO appointment (user_id, fullname, gender, age, doctor_fullname, disease, appointment_date, appointment_time, address, contact_number, remark, status) 
                VALUES ('$user_id','$fullname', '$gender', '$age', '$doctor_fullname', '$disease', '$appointment_date', '$appointment_time', '$address', '$contact_number', '$remark', 'pending')";

        if ($conn->query($sql) === TRUE) {
            // Update doctor's status to 'inactive' (i.e., they are now booked for other users)
            $update_sql = $conn->prepare("UPDATE doctor SET status = 'inactive' WHERE doctor_fullname = '$doctor_fullname'");
            $update_sql->execute();

            // Commit the transaction
            $conn->commit();

            echo "<script>
            alert('Appointment booked successfully!');
            window.location.href = 'main.php';
            </script>";
        } else {
            // If the appointment failed to insert, rollback the transaction
            $conn->rollback();
            echo "<script>
            alert('Error booking appointment.');
            window.location.href = 'main.php';
            </script>";
        }
    } catch (Exception $e) {
        // In case of any error, rollback the transaction
        $conn->rollback();
        echo "<script>
        alert('Error: " . $e->getMessage() . "');
        window.location.href = 'main.php';
        </script>";
    }
}

$conn->close();
?>
