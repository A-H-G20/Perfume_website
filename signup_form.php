<?php
include "connection.php"; // Include database connection parameters

if (isset($_POST['submit1'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    // Hash the password before saving it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Get the current date and time in the format that MySQL accepts
    $created_at = date('Y-m-d H:i:s'); // Get the current date and time

    // Prepare SQL statement to insert user into the database
    $query = "INSERT INTO users (name, email, phone_number, role, gender, password, created_at) 
              VALUES ('$name', '$email', '$phone_number', 'user', '$gender', '$hashed_password', '$created_at')";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if ($result) {
        // Registration successful
        header("Location: login.php"); // Redirect to the login page
        exit(); // Ensure to exit after the redirect
    } else {
        // Display error message if registration fails
        echo '<div class="alert alert-danger"><strong>Error!</strong>&nbsp;Registration failed. Please try again.</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Transparent Sign Up</title>
   
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
</head>
<body background="image/login.jpg">
<video class="video-background" src="./pinterest-720p-3.mp4" autoplay muted loop></video>
    <div class="loginBox">
        <h2>Sign Up Here</h2>
        <form method="post">
            <p>Name</p>
            <input type="text" name="name" placeholder="Enter Full Name" required>

            <p>Email</p>
            <input type="email" name="email" placeholder="Enter Email" required>

            <p>Phone Number</p>
            <input type="text" name="phone_number" placeholder="Enter Phone Number" required>

            <p>Gender</p>
            <select name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <p>Password</p>
            <input type="password" name="password" placeholder="********" required>

            <input type="submit" name="submit1" value="Sign Up">

            <p>You have an account? <a href="login.html">Sign In</a></p>
        </form>
    </div>
</body>
</html>

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
        .loginBox input[type="password"],
        .loginBox input[type="email"],
        .loginBox select{
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