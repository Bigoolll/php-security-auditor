<?php
include 'SecurityScanner.php';

$scanner = new SecurityScanner();

// Get file path from command line arguments
$filePath = $argv[1];

// Scan the file
$fileReport = $scanner->scanFile($filePath);

echo "Vulnerability Report: \n";
print_r($fileReport);
?>
