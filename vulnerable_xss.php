<?php
// Simulate XSS by echoing user input directly without sanitization
$user_input = $_GET['user_input']; // Get user input from the URL
echo $user_input; // Directly outputting user input, vulnerable to XSS
?>
