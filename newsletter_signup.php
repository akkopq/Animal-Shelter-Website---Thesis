<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['mail'];

    $stmt = $conn->prepare("INSERT INTO newsletter (email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Ati fost abonat cu succes la newsletter-ul nostru! Va multumim!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Eroare la abonare. Incercati din nou."]);
    }

    $stmt->close();
    $conn->close();
}
?>
