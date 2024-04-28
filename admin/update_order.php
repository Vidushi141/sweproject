<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
// Include the database connection configuration

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['order_id'], $_POST['Time'], $_POST['Statues'])) {
        // Get form data
        $order_id = $_POST['order_id'];
        $Time = $_POST['Time'];
        $Statues = $_POST['Statues'];

        // Prepare SQL statement with placeholders
        $sql = "UPDATE orders SET Time=?, Statues=? WHERE order_id=?";

        // Prepare the SQL statement
        $stmt = $connection->prepare($sql);

        // Bind parameters to the statement
        $stmt->bind_param("ssi", $Time, $Statues, $order_id);

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
