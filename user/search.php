<?php
// Get the search input from the form
$conn = new mysqli("localhost","root","","healthcare");
$search_input = $_GET['search'];

// Fetch doctor data from the database
$query = "SELECT * FROM doctor WHERE fullname LIKE '%$search_input%' OR specialization LIKE '%$search_input%' OR experience LIKE '%$search_input%'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    ?>
    <div class="doctor-cards">
        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="doctor-card">
                <h2><?php echo $row['fullname']; ?></h2>
                <p><?php echo $row['specialization']; ?></p>
                <p><?php echo $row['experience']; ?></p>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
} else {
    echo "No doctors found.";
}
?>