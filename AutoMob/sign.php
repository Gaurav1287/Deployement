<?php
// Start the session
session_start();
include 'db_php.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Basic validation
    if (empty($email) || empty($password)) {
        echo "Email and password are required!";
        exit;
    }
    
    // Prepare SQL statement to check user credentials
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $hashed_password);
    
    // Check if a user was found
    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Set the session and redirect to the home page
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            echo "<script>
                    alert('Login successful! Welcome back, $name');
                    window.location.href = 'dashboard.html';
                  </script>";
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email.";
    }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
