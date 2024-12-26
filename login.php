<?php
include "connection.php"; // Include database connection parameters

// Start session to store session variables
session_start();

if (isset($_POST['submit1'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to retrieve user from database
    $query = "SELECT * FROM users WHERE email='$username'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $num_row = mysqli_num_rows($result);

    if ($num_row > 0) {
        // Fetch user data
        $row = mysqli_fetch_array($result);
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Store user ID and role in session
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['role'] = $row['role']; // Store the user's role
            
            // Redirect based on user role
            if ($_SESSION['role'] == 'admin') {
                header("Location: admin/index.php"); // Redirect to admin dashboard
            } else {
                header("Location: index.php"); // Redirect to regular user's homepage
            }
            exit(); // Make sure to exit after redirect
        } else {
            // Display error message for invalid password
            echo '<div class="alert alert-danger"><strong>Login Error!</strong>&nbsp;Invalid Username or Password</div>';
        }
    } else {
        // Display error message for non-existent user
        echo '<div class="alert alert-danger"><strong>Login Error!</strong>&nbsp;Invalid Username or Password</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Transparent Login</title>
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Place behind other content */
        }

        .loginBox {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.6); /* Semi-transparent background */
            padding: 20px;
            border-radius: 10px;
            color: #fff;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .loginBox h2 {
            margin-bottom: 20px;
        }

        .loginBox input[type="text"], 
        .loginBox input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            outline: none;
        }

        .loginBox input[type="submit"] {
            background: transparent; /* Transparent background */
            color: #e8e8a6; /* Light yellow text color */
            padding: 10px 20px;
            border: 2px solid #e8e8a6; /* Light yellow border */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Adjust font size */
            cursor: pointer;
            width: auto; /* Make width fit content */
            margin-top: 10px;
            text-align: center;
            font-family: 'Arial', sans-serif; /* Ensure clean font styling */
        }

        .loginBox input[type="submit"]:hover {
            background: #e8e8a6; /* Light yellow background on hover */
            color: #000; /* Black text on hover */
            border-color: #e8e8a6; /* Keep border consistent */
        }

        .loginBox p a {
            color: #007bff;
            text-decoration: none;
        }

        .loginBox p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Video Background -->
    <video class="video-background" src="./pinterest-720p-3.mp4" autoplay muted loop></video>

    <div class="loginBox">
        <h2>Log In Here</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Enter email" required>
            <input type="password" name="password" placeholder="password" required>
            <input type="submit" name="submit1" value="Sign In">
            <p>Don't have an account? <a href="signup_form.php">Sign UP</a></p>
        </form>
    </div>
</body>
</html>
