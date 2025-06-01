<?php
// Set headers first
header("Content-Type: text/plain");

// Define log file path
$logFile = __DIR__ . '/whatsapp_clicks.log';

// Prepare data
$data = [
    'link' => $_GET['link'] ?? 'unknown',
    'page' => $_GET['page'] ?? $_SERVER['HTTP_REFERER'] ?? 'direct',
    'ip' => $_SERVER['REMOTE_ADDR'],
    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
    'timestamp' => date('Y-m-d H:i:s')
];

// Validate redirect URL
$redirectUrl = filter_var($_GET['redirect'] ?? '', FILTER_VALIDATE_URL);
if (!$redirectUrl) {
    die("Invalid redirect URL");
}

// Safely write to log
try {
    $logEntry = json_encode($data) . PHP_EOL;
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
} catch (Exception $e) {
    error_log("Failed to log click: " . $e->getMessage());
}

// Redirect (with no-cache headers)
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Location: " . $redirectUrl);
exit();
?>
