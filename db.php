<?php
$host = 'localhost';
$user = 'root';
$password = ''; // Update with your database password
$dbname = 'photo_gallery';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>