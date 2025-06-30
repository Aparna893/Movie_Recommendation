<?php
$host = 'localhost';
$username = 'root';
$password = 'Aparna@123'; // Your MySQL password
$database = 'moviedb';
$port = 3306; // Your custom MySQL port

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
