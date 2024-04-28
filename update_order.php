
<?php
session_start();

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
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'id' parameter is set in the POST data
    if (isset($_POST['id'])) {
        // Get the ID from the POST data
        $id = $_POST['id'];

        // Check if the 'comment' parameter is set in the POST data
        if (isset($_POST['comment'])) {
            // Get the comment from the POST data
            $comment = $_POST['comment1'];

            // Prepare SQL statement to update the comment in the orders table
            $sql = "UPDATE orders SET comment = '$comment' WHERE id = '$id'";
            
            // Execute the SQL statement
            $result = mysqli_query($connection, $sql);

            if ($result) {
                 $_SESSION['msg'] = 'Comment updated successfully!';
            } else {
                 $_SESSION['error'] = 'Failed to update comment.';
            }

            // Redirect back to the previous page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // Check if the 'review' parameter is set in the POST data
        if (isset($_POST['review'])) {
            // Get the review from the POST data
            $review = $_POST['review1'];

            // Prepare SQL statement to update the review in the orders table
            $sql = "UPDATE orders SET review = '$review' WHERE id = '$id'";

            // Execute the SQL statement
            $result = mysqli_query($connection, $sql);

            if ($result) {
                 $_SESSION['msg'] = 'Review added successfully!';
            } else {
                 $_SESSION['error'] = 'Failed to add review.';
            }

            // Redirect back to the previous page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}
// If the form is submitted incorrectly or without proper parameters, redirect back to the previous page
exit;
?>
