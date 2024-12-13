<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location: sign_in_frontend.html"); // Redirect to the sign-in page
exit();
?>
