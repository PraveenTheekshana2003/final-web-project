<?php
session_start();
header('Content-Type: application/json');

// Prevent caching so the browser always gets fresh session state
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');

echo json_encode([
    'logged_in' => isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true,
    'username'  => $_SESSION['username'] ?? null,
    'user_id'   => $_SESSION['user_id'] ?? null
]);
?>
