<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Mesajul a fost trimis cu succes!'); window.location.href='adoption.php';</script>";
    } else {
        echo "<script>alert('Eroare la trimiterea mesajului: " . $stmt->error . "'); window.location.href='adoption.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
