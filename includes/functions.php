<?php
/**
 * Sanitize user input safely.
 * - Trims whitespace and strips backslashes
 * - Does NOT apply htmlspecialchars here (use htmlspecialchars() only at output time)
 * - Uses prepared statements for DB safety, so real_escape_string is not needed either
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}
?>
