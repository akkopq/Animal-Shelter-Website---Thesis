<?php
require 'vendor/autoload.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(50));
        $expiry = time() + 3600; // 1 hour expiry

        $sql = "UPDATE users SET reset_token = ?, reset_expiry = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $token, $expiry, $email);
        if ($stmt->execute()) {
            $reset_link = "http://127.0.0.1/animal%20shelter/reset_password_form.php?token=$token";

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->SMTPDebug = 0; 
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'byRazZeeR0@gmail.com'; 
                $mail->Password   = 'edanafqcvprbrkkf'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                //Recipients
                $mail->setFrom('byRazZeeR0@gmail.com', 'Animal Shelter');
                $mail->addAddress($email); 

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Cerere Resetare Parola';
                $mail->Body    = "Apasă următorul link pentru a reseta parola: <br><a href='$reset_link'>$reset_link</a>";

                $mail->send();
                echo json_encode(["status" => "success", "message" => "Cerere trimisă cu succes."]);
            } catch (Exception $e) {
                error_log("Mesajul nu a putut fi trimis. Mailer Error: {$mail->ErrorInfo}"); 
                echo json_encode(["status" => "error", "message" => "Mesajul nu a putut fi trimis. Please check the logs for more details."]);
            }
        } else {
            error_log("Failed to store reset token in the database.");
            echo json_encode(["status" => "error", "message" => "Failed to store reset token. Please check the logs for more details."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Adresa mail nu a fost găsită."]);
    }

    $stmt->close();
}

$conn->close();
?>
