<?php
// insert.php

// Database connection parameters
$servername = "localhost";
$username = "root"; // Default username
$password = ""; // Default password, usually empty
$dbname = "petcare"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $email = $conn->real_escape_string($_POST['email']);

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data into the table
    $sql = "INSERT INTO users (username, password, email, created_at) VALUES ('$username', '$hashedPassword', '$email', NOW())";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        header("Location: http://localhost/pet/pet/"); // Change this to your actual home page URL
        exit(); // Ensure no further script execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
