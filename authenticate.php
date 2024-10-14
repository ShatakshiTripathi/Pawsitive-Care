<?php
session_start(); // Start session to handle logged-in users

// Database connection (replace with your actual details)
$servername = "localhost"; // Your server name
$dbusername = "root"; // Your MySQL username
$dbpassword = ""; // Your MySQL password (for development, might be empty)
$dbname = "petcare"; // The name of your database

// Create connection to the database
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL query to avoid SQL injection
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); // Bind the username parameter
    $stmt->execute();
    $stmt->bind_result($stored_password); // Fetch the password from the result
    $stmt->fetch();

    // Check if a password was returned
    if ($stored_password) {
        // Verify the entered password with the hashed password in the database
        if (password_verify($password, $stored_password)) {
            // If the password matches, set a session and redirect
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Redirect to the user's dashboard
            exit(); // Make sure to exit after redirect
        } else {
            // If password doesn't match
            echo "Incorrect password!";
        }
    } else {
        // If username doesn't exist
        echo "Username not found!";
    }

    $stmt->close(); // Close the prepared statement
}

$conn->close(); // Close the connection
?>