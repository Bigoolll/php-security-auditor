<?php
class SecurityScanner {

    // Function to detect SQL Injection vulnerabilities
    public function checkSQLInjection($fileContent) {
        // Check if the file contains common SQL keywords and unsanitized user input,
        // which signifies a potential SQL Injection vulnerability.
        if (preg_match('/(SELECT\s+.*FROM|INSERT\s+INTO|UPDATE|DELETE\s+FROM)/i', $fileContent) &&
            preg_match('/\$_(GET|POST|REQUEST)/i', $fileContent)) {
            return "SQL Injection vulnerability detected";
        }
        return "No SQL Injection detected";
    }     

   public function checkXSS($fileContent) {
        // Check if the file uses superglobals (user input)
        if (preg_match('/\$_(GET|POST|REQUEST|COOKIE)/i', $fileContent)) {
            // Check for echo/print/printf of variables (e.g., $var)
            if (preg_match('/(echo|print|printf)\s*\(?\s*(\$[a-zA-Z_]+)/i', $fileContent)) {
                // Check if sanitization functions are missing
                if (!preg_match('/htmlspecialchars|htmlentities/i', $fileContent)) {
                    return "Potential XSS vulnerability detected";
                }
            }
        }
        return "No XSS detected";
    }

    // Function to detect weak cryptographic practices
    public function checkCryptographicFailures($fileContent) {
        if (preg_match('/(md5|sha1)\s*\(/i', $fileContent)) {
            return "Weak cryptographic function (md5/sha1) detected";
        }
        return "No cryptographic failure detected";
    }

    // Function to scan the entire PHP file
    public function scanFile($filePath) {
        if (!file_exists($filePath)) {
            return "File does not exist";
        }

        $fileContent = file_get_contents($filePath);

        $sqlInjectionReport = $this->checkSQLInjection($fileContent);
        $xssReport = $this->checkXSS($fileContent);
        $cryptoReport = $this->checkCryptographicFailures($fileContent);

        return [
            "SQL Injection" => $sqlInjectionReport,
            "XSS" => $xssReport,
            "Cryptographic Failures" => $cryptoReport
        ];
    }
}
?>
