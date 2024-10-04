<?php
include 'config.php'; 

$username = 'admin';
$password = 'admin'; 

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO admin (username, password) VALUES ('$username', '$hashed_password')";

if (mysqli_query($conn, $sql)) {
    echo "Admin user created successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
