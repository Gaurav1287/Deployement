<?php
// Start the session
session_start();
include 'db_php.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $subject = trim($_POST['subject']);
    
    // Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($subject)) {
        echo "All fields are required!";
        exit;
    }
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO enquiries (name, email, phone, subject) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $subject);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Output JavaScript alert and redirect to home page
        echo "<script>
                alert('I will check it Enquiry');
                window.location.href = 'index.php'; // Redirect to home page
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
