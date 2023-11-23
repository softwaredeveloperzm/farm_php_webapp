<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../app/database/auth_session.php');
$servername = "localhost";
$username = "admin";
$password = "password";
$database = "farmers";

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the user is logged in (username session exists)
    if (isset($_SESSION['username'])) {
        // Get the post content from the form
        $content = $_POST['post_content'];

        // Check if content is not empty
        if (!empty($content)) {
            // Get the username from the session
            $username = $_SESSION['username'];

            // Prepare and execute the SQL query to insert the post data
            $query = "INSERT INTO posts (content, username) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $content, $username);

            if ($stmt->execute()) {
                // Post was successfully added
                // Redirect to dashboard.php
                header("Location: ../dashboard.php");
                exit;
            } else {
                // Handle any errors if the query fails
                echo "Error: " . $stmt->error;
            }

            // Close the database connection
            $stmt->close();
        } else {
            echo "Post content cannot be empty.";
        }
    } else {
        echo "User is not logged in. Please log in to post.";
    }
}
