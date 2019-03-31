<?php

include('config_db.php');

// Create connection
$conn = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DATABASE_NAME);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

//else echo"Connection is okey";

//$conn->close();

?>