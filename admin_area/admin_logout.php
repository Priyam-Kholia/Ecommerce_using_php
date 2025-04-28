<?php
session_start();

// Destroy all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to login page (or home page)
echo"<script>window.open('index.php','_self')</script>";
?>