<?php
// Start the session
session_start();

// Include database connection file with error checking
if (!file_exists('db_php.php')) {
    die("<div class='card error'>Database configuration file not found.</div>");
}
include 'db_php.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $gender = trim($_POST['gender']);
    $date = trim($_POST['date']);
    $location = trim($_POST['location']);
    $subject = trim($_POST['subject']);
    
    // Basic validation
    if (empty($name) || empty($email) || empty($password) || empty($gender) || empty($date) || empty($location)) {
        echo "<div class='card error'>All fields except subject are required!</div>";
        exit;
    }
    
    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email already exists
        echo "<div class='card error'>The email address is already registered. Please use a different email.</div>";
        $stmt->close();
        $conn->close();
        exit;
    }
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Prepare SQL statement to prevent SQL injection
    if ($conn) { // Check if $conn is set
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, gender, date, location, subject) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $hashed_password, $gender, $date, $location, $subject);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "<div class='card success'>Registration successful! Welcome, $name.</div>";
        } else {
            echo "<div class='card error'>Error: " . $stmt->error . "</div>";
        }
        
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "<div class='card error'>Database connection error.</div>";
    }
} else {
    echo "<div class='card error'>Invalid request method.</div>";
}
?>
