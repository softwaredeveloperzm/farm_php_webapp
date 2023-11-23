<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/lo.css">

</head>

<body>


<?php include("app/features/header.php"); ?>
<?php
    require('app/database/db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username']) && isset($_REQUEST['email']) && isset($_REQUEST['password'])) {
        // Remove backslashes and escape special characters
        $username = mysqli_real_escape_string($con, stripslashes($_REQUEST['username']));
        $email = mysqli_real_escape_string($con, stripslashes($_REQUEST['email']));
        $password = mysqli_real_escape_string($con, stripslashes($_REQUEST['password']));
    
        // Validate the email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check if the username and email already exist in the database
            $check_query = "SELECT * FROM `users` WHERE username='$username' OR email='$email'";
            $check_result = mysqli_query($con, $check_query);
    
            if (mysqli_num_rows($check_result) > 0) {
                // Username or email is already in use, show an error message
                echo "<div class='form'>
                      <h3>Username or email is already in use.</h3><br/>
                      <p class='link'>Click here to <a href='registration.php'>try registration</a> again.</p>
                      </div>";
            } else {
                // Username and email are unique, proceed with registration
                $create_datetime = date("Y-m-d H:i:s");
                $query = "INSERT INTO `users` (username, password, email, create_datetime)
                         VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
                $result = mysqli_query($con, $query);
    
                if ($result) {
                    echo "<div class='form'>
                      <h3>You are registered successfully.</h3><br/>
                      <p class='link'>Click here to <a href='login.php'>Login</a></p>
                      </div>";
                } else {
                    echo "<div class 'form'>
                      <h3>Required fields are missing.</h3><br/>
                      <p class='link'>Click here to <a href='registration.php'>try registration</a> again.</p>
                      </div>";
                }
            }
        } else {
            // Invalid email format
            echo "<div class='form'>
                  <h3>Invalid email format.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>try registration</a> again.</p>
                  </div>";
        }
    
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
<script src="assets/js/script.js"></script>
</body>
</html>