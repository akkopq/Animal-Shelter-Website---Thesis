<?php
include 'config.php';

$sql = "SELECT name, occupation, profile_pic, review FROM reviews";
$result = $conn->query($sql);

$conn->close();
?>
