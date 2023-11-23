<?php
//include auth_session.php file on all user panel pages
include("app/database/auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>

    body{
        background-color: white;
    }
         .col-md-5, .col-md-6 {
        margin-top: 90px;
       
    }

</style>

<body>

<?php include("app/features/home.header.php"); ?>


<div class="container mt-6">
    <div class="row">
        <!-- Create a Post Section -->
        <div class="col-md-5 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Create a Post</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="scripts/post.php">
                        <div class="form-group">
                            <textarea class="form-control" name="post_content" rows="3" placeholder="What's on your mind?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
        <?php
$servername = "localhost";
$username = "admin";
$password = "password";
$database = "farmers";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a delete action is requested
if (isset($_POST['post_id'])) {
    if (isset($_SESSION['username'])) {
        $post_id = $_POST['post_id'];
        $current_user = $_SESSION['username'];

        // Prepare a query to retrieve the post's owner
        $checkOwnershipQuery = "SELECT username FROM posts WHERE post_id = ?";
        $stmt = $conn->prepare($checkOwnershipQuery);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $stmt->bind_result($post_owner);
        $stmt->fetch();
        $stmt->close();

        if ($post_owner === $current_user) {
            // The current user owns the post, so it can be deleted
            $deleteQuery = "DELETE FROM posts WHERE post_id = ?";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bind_param("i", $post_id); // "i" indicates an integer
            if ($stmt->execute()) {
                // Redirect back to the same page
                header("Location: dashboard.php");
                exit;
            } else {
                echo 'Error: Failed to delete the post.';
                exit;
            }
        } else {
            echo 'Error: You do not have permission to delete this post.';
            exit;
        }
    } else {
        echo 'Error: You are not logged in.';
        exit;
    }
}

$query = "SELECT * FROM posts ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="card mb-4">
            <div class="card-header">
                <small class="text-muted">
                    <?php echo $row['username']; ?> | Date Posted: <?php echo $row['created_at']; ?>
                </small>
            </div>
            <div class="card-body">
                <p class="card-text"><?php echo $row['content']; ?></p>
            </div>
            <div class="card-footer">
                <?php
                if (isset($_SESSION['username']) && $_SESSION['username'] === $row['username']) {
                    // Display the delete button for the post owner
                    ?>
                    <form method="post">
                        <input type="hidden" name="post_id" value="<?php echo $row['post_id']; ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <?php
                } else {
                    // Hide or disable the delete button for other users
                    ?>
                    <button class="btn btn-danger" disabled>Delete</button>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
} else {
    echo '<div class="alert alert-info">No posts found.</div>';
}

mysqli_close($conn);
?>




<script src="assets/js/script.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
