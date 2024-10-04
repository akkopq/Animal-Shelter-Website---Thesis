<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $token = bin2hex(random_bytes(50));
        $expiry = time() + 3600; // 1 hour expiry

        $sql = "UPDATE admin SET reset_token = '$token', reset_expiry = '$expiry' WHERE email = '$email'";
        if (mysqli_query($conn, $sql)) {
            $reset_link = "http://127.0.0.1/animal%20shelter/reset_password.php?token=$token";

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->SMTPDebug = 2; 
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
                echo 'Cerere trimisă cu succes.';
            } catch (Exception $e) {
                error_log("Mesajul nu a putut fi trimis. Mailer Error: {$mail->ErrorInfo}"); // Log the error
                echo "Mesajul nu a putut fi trimis. Please check the logs for more details.";
            }
        } else {
            error_log("Failed to store reset token in the database.");
            echo "Failed to store reset token. Please check the logs for more details.";
        }
    } else {
        echo "Adresa mail nu a fost găsită.";
    }
}

mysqli_close($conn);
?>
