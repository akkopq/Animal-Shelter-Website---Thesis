<?php
include 'config.php'; 

$token = isset($_GET['token']) ? $_GET['token'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    $sql = "SELECT * FROM admin WHERE reset_token = '$token' AND reset_expiry > " . time();
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $sql = "UPDATE admin SET password = '$hashed_password', reset_token = NULL, reset_expiry = NULL WHERE reset_token = '$token'";
        if (mysqli_query($conn, $sql)) {
            echo "Parolă modificată cu succes.";
        } else {
            echo "Modificare Eșuată.";
        }
    } else {
        echo "Token expirat sau invalid.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resetare Parolă</title>
</head>
<body>
    <h2>Resetare Parolă</h2>
    <?php if ($token): ?>
        <form method="post" action="reset_password.php">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>" required>
            <label for="new_password">Parolă Nouă:</label>
            <input type="password" id="new_password" name="new_password" required><br><br>
            <button type="submit">Resetează Parolă</button>
        </form>
    <?php else: ?>
        <p>Token expirat sau invalid.</p>
    <?php endif; ?>
</body>
</html>
