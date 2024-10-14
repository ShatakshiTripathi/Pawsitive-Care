<?php
session_start(); // Start the session

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, store a message and redirect to the login page
    $_SESSION['message'] = "Please log in to access the dashboard.";
    header("Location: http://localhost/pet/pet/");
    exit();
}

// Check if there's a message to display
if (isset($_SESSION['message'])) {
    // Display the message
    echo "<div class='alert'>" . $_SESSION['message'] . "</div>";
    // Clear the message after displaying it
    unset($_SESSION['message']);
}

// Rest of the dashboard page content
echo "Welcome " . $_SESSION['username'] . " to Pawsitive Care!";
?>
