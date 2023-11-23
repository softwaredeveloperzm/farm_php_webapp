<?php
    $servername = "localhost";
    $username = "admin";
    $password = "password";
    $database = "farmers";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    // Check if the post_id is provided via a POST request
if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // Prepare and execute a SQL query to delete the post with the given post_id
    $deleteQuery = "DELETE FROM posts WHERE post_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $post_id); // "i" indicates an integer
    if ($stmt->execute()) {
        echo "success"; // Indicates successful deletion
    } else {
        echo "error"; // Indicates deletion error
    }

}
