<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: library.php"); // Redirecting To Home Page
}
?>