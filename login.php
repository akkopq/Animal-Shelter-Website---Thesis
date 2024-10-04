<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['userEmail'] = $user['email'];
        $_SESSION['userName'] = $user['name'];
        
        // Set a cookie for 30 days
        setcookie("user", json_encode(["email" => $user['email'], "name" => $user['name']]), time() + (86400 * 30), "/");
        
        echo json_encode(["status" => "success", "name" => $user['name'], "email" => $user['email']]);
    } else {
        echo json_encode(["status" => "error", "message" => "Email sau parolă incorectă!"]);
    }

    $stmt->close();
    $conn->close();
}
?>
