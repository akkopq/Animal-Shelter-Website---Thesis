<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "db_animal_shelter";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Conexiune Eșuată: " . $conn->connect_error);
}
?>
