<?php
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo json_encode(["status" => "error", "message" => "Parolele nu se potrivesc."]);
        exit();
    }

    $sql = "SELECT * FROM users WHERE reset_token = ? AND reset_expiry > ?";
    $stmt = $conn->prepare($sql);
    $current_time = time();
    $stmt->bind_param("si", $token, $current_time);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ?, reset_token = NULL, reset_expiry = NULL WHERE reset_token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashed_password, $token);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Parola a fost resetată cu succes."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Eroare la resetarea parolei."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Token expirat sau invalid."]);
    }

    $stmt->close();
}

$conn->close();
?>
