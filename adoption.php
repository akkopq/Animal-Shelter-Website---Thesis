<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Adăpost de animale</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="img/cute doggie.jpg" rel="icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="css/style.css" rel="stylesheet">

    <style>
        body {
            background-image: url('img/dbmanager_bg.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }

        .filter-container {
            width: 20%;
            float: left;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
            height: 100vh;
        }

        .grid-view {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
            width: 75%;
            float: left;
        }

        .grid-item {
            text-align: center;
            position: relative;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
            cursor: pointer;
        }

        .grid-item img {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        .edit-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .edit-popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: left;
            position: relative;
            display: flex;
        }

        .edit-popup-content img {
            max-width: 500px;
            max-height: 500px;
            margin-right: 20px;
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 24px;
            font-weight: bold;
            color: #000;
        }

        .filter-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .filter-container label {
            display: block;
            margin-bottom: 10px;
        }

        .filter-container input[type="checkbox"] {
            margin-right: 10px;
        }

        .filter-container .contact-text {
            font-size: 18px;
            margin-top: 20px;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .filter-container .button-container {
            display: flex;
            justify-content: space-between;
        }

        .filter-container .button-container img {
            width: 80px;
            height: 80px;
            cursor: pointer;
        }

        .contact-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .contact-popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: left;
            position: relative;
            width: 50%;
        }

        .contact-popup-content h2 {
            margin-bottom: 20px;
        }

        .contact-popup-content label {
            display: block;
            margin-bottom: 10px;
        }

        .contact-popup-content input[type="text"],
        .contact-popup-content input[type="email"],
        .contact-popup-content input[type="tel"],
        .contact-popup-content textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .contact-popup-content textarea {
            height: 100px;
            resize: none;
        }

        .contact-popup-content .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 24px;
            font-weight: bold;
            color: #000;
        }

        .contact-popup-content .submit-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .popup-form {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .popup-form .form-group {
        margin-bottom: 15px;
    }

    .popup-form .btn {
        margin-right: 10px;
    }
    </style>
</head>

<body>
    <?php include 'navbar_topbar.html'; ?>

    <!-- Login Popup Form -->
        <div id="loginForm" class="popup-form">
            <form id="loginFormElement" action="login.php" method="POST" onsubmit="return handleLogin(event);">
                <div class="form-group">
                    <label for="login_email">Email:</label>
                    <input type="email" class="form-control" id="login_email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="login_password">Parolă:</label>
                    <input type="password" class="form-control" id="login_password" name="password" required>
                    <a href="javascript:void(0);" onclick="openResetPasswordForm()" class="text-primary" style="display: block; margin-top: 10px;">Resetare Parolă</a>
                </div>
                <button type="submit" class="btn btn-primary">Logare</button>
                <button type="button" class="btn btn-secondary" onclick="closeLoginForm()">Închide</button>
            </form>
        </div>

        <!-- Create Account Popup Form -->
        <div id="createAccountForm" class="popup-form">
            <form id="accountForm" action="create_account.php" method="POST" onsubmit="return handleAccountCreation(event);">
                <div class="form-group">
                    <label for="account_name">Nume:</label>
                    <input type="text" class="form-control" id="account_name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="account_email">Email:</label>
                    <input type="email" class="form-control" id="account_email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="account_password">Parolă:</label>
                    <input type="password" class="form-control" id="account_password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmă Parola:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Creează Cont</button>
                <button type="button" class="btn btn-secondary" onclick="closeAccountForm()">Închide</button>
            </form>
        </div>

        <!-- Password Reset Popup Form -->
        <div id="resetPasswordForm" class="popup-form">
            <form id="resetForm" action="send_reset_email_public.php" method="POST" onsubmit="return handlePasswordReset(event);">
                <div class="form-group">
                    <label for="reset_email">Email:</label>
                    <input type="email" class="form-control" id="reset_email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Trimite Link-ul de Resetare</button>
                <button type="button" class="btn btn-secondary" onclick="closeResetPasswordForm()">Închide</button>
            </form>
        </div>

    <div class="filter-container">
        <h2>Filtrează Animale</h2>
        <label><input type="checkbox" id="checkAll" onchange="toggleAll(this)"> Selectează/Deselectează Tot</label>
        <label><input type="checkbox" class="table-filter" value="dogs"> Câini</label>
        <label><input type="checkbox" class="table-filter" value="cats"> Pisici</label>
        <label><input type="checkbox" class="table-filter" value="rabbits"> Iepuri</label>
        <label><input type="checkbox" class="table-filter" value="birds"> Păsări</label>
        <label><input type="checkbox" class="table-filter" value="others"> Altele</label>

        <div class="contact-text">Interesat de un animal? Contactează-ne telefonic sau lasă-ne un mesaj!</div>
        <div class="button-container">
            <a href="tel:0771417179"><img src="img/call1.jpg" alt="Call Button"></a>
            <img src="img/mail.png" alt="Mail Button" onclick="showContactPopup()">
        </div>
    </div>

    <div class="grid-view" id="animalsGrid">
    </div>

    <!-- Edit Popup -->
    <div class="edit-popup" id="editPopupContainer">
        <div class="edit-popup-content">
            <span class="popup-close" onclick="closePopup()">&times;</span>
            <img id="animalImage" src="" alt="Animal Image">
            <div id="animalInfo"></div>
        </div>
    </div>

    <!-- Contact Popup -->
    <div class="contact-popup" id="contactPopupContainer">
        <div class="contact-popup-content">
            <span class="popup-close" onclick="closeContactPopup()">&times;</span>
            <h2>Contact</h2>
            <form id="contactForm" method="post" action="save_contact.php">
                <label for="name">Nume:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Număr de Telefon:</label>
                <input type="tel" id="phone" name="phone">

                <label for="message">Mesaj:</label>
                <textarea id="message" name="message" maxlength="500" required></textarea>

                <button type="submit" class="submit-button">Trimite Mesaj</button>
            </form>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!-- clock -->
    <script src="js/time.js"></script>

    <script>
        function toggleAll(source) {
            checkboxes = document.getElementsByClassName('table-filter');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
            updateGrid();
        }

        function updateGrid() {
            var checkboxes = document.getElementsByClassName('table-filter');
            var selectedTables = [];
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    selectedTables.push(checkboxes[i].value);
                }
            }
            loadAnimals(selectedTables.join(','));
        }

        function loadAnimals(tables) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'load_animals_public.php?tables=' + tables, true);
            xhr.onload = function () {
                if (this.status == 200) {
                    document.getElementById('animalsGrid').innerHTML = this.responseText;
                }
            };
            xhr.send();
        }

        function showPopup(imagePath, infoHtml) {
            document.getElementById('animalImage').src = imagePath;
            document.getElementById('animalInfo').innerHTML = infoHtml;
            document.getElementById('editPopupContainer').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('editPopupContainer').style.display = 'none';
        }

        function showContactPopup() {
            document.getElementById('contactPopupContainer').style.display = 'flex';
        }

        function closeContactPopup() {
            document.getElementById('contactPopupContainer').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const filter = urlParams.get('filter');
            if (filter) {
                const filterCheckbox = document.querySelector(`input[value=${filter}]`);
                if (filterCheckbox) {
                    filterCheckbox.checked = true;
                }
            }

            updateGrid();

            var filters = document.getElementsByClassName('table-filter');
            for (var i = 0; i < filters.length; i++) {
                filters[i].addEventListener('change', updateGrid);
            }
        });
    </script>
</body>

</html>
