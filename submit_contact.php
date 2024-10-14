<?php
$host = 'localhost';
$username = 'root'; // Use your actual MySQL username
$password = ''; // Leave empty if you haven't set a password for root
$dbname = 'petcare'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO contact_us (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

if ($stmt->execute()) {
    // Successful insertion, redirect to home page
    header("Location: http://localhost/pet/pet/"); // Change this to your home page URL
    exit(); // Always call exit after header to prevent further script execution
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
