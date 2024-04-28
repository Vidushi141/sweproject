
<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
// Include the database connection configuration
include './backends/config.php';

// Database connection parameters
$host = "localhost"; // Your MySQL host
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "mishtidb"; // Your MySQL database name

// Create MySQLi connection
$connection = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// <?php
// Include the database connection configuration
include './backends/config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['user_id'], $_POST['date'], $_POST['time'], $_POST['Table'])) {
        // Get form data
        $user_id = $_POST['user_id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $table = $_POST['Table']; // Avoid using reserved keywords like 'Table'

        // Prepare SQL statement with placeholders
        $sql = "INSERT INTO book_table (user_id, date, time, `Table`) VALUES (?, ?, ?, ?)";

        // Prepare the SQL statement
        $stmt = $connection->prepare($sql);

        // Bind parameters to the statement
        $stmt->bind_param("ssss", $user_id, $date, $time, $table);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the previous page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}
?>
