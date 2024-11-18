<?php
// Establishing the database connection
$link = mysqli_connect("localhost", "root", "", "webmanga");

// Check if the connection was successful
if (!$link) {
    // If the connection fails, output the error and stop the script
    die("Connection failed: " . mysqli_connect_error());
}
?>