<?php
session_start();

// Unset all session variables
$_SESSION = array();

// If session cookie exists, remove it
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
}

// Destroy the session
session_destroy();

// Redirect to login page with flag so JS can reset forms
header("Location: loginn.php?loggedout=true");
exit();
?>
