<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Cont creat cu succes!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Eroare la crearea contului. Încercați din nou."]);
    }

    $stmt->close();
    $conn->close();
}
?>
