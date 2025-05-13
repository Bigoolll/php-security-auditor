<?php
// Simulate SQL Injection by directly inserting user input in the query
$id = $_GET['id']; // User input from the query string
$query = "SELECT * FROM users WHERE id = " . $id; // Unsafe query concatenation
$result = mysql_query($query); // Vulnerable to SQL Injection
?>