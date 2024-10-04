<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Resetare Parolă</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        .popup-form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: #fff;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="popup-form">
        <h2>Resetare Parolă</h2>
        <form id="resetPasswordForm" method="POST" onsubmit="return handleResetPassword(event);">
            <input type="hidden" id="token" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>" required>
            <div class="form-group">
                <label for="new_password">Parolă Nouă:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmă Parola Nouă:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Resetare Parolă</button>
        </form>
    </div>

    <script>
        function handleResetPassword(event) {
            event.preventDefault();

            const form = document.getElementById('resetPasswordForm');
            const formData = new FormData(form);

            fetch('reset_password_public.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    window.location.href = 'index.php';
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>

</html>
