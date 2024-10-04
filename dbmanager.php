<?php
session_start();
include 'config.php';

$bypassLogin = isset($_GET['bypass_login']) && $_GET['bypass_login'] == 'true';

$isAdminLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'];

if (!$isAdminLoggedIn && !$bypassLogin) {
    echo '<script>document.getElementById("popupContainer").style.display = "flex";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Adăpost de animale</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Favicon -->
    <link href="img/cute doggie.jpg" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Custom CSS for Popup and Forms -->
    <style>
        body {
            background-image: url('img/dbmanager_bg.jpg'); /* Example path */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }

        .popup-container {
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

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .reset-password {
            color: blue;
            cursor: pointer;
            text-decoration: underline;
        }

        .pet-form {
            display: none;
        }

        .form-table {
            width: 60%;
            border-collapse: collapse;
        }

        .form-table th, .form-table td {
            padding: 5px;
            text-align: left;
        }

        .form-table th {
            background-color: #f2f2f2;
        }

        .form-table td input, .form-table td select {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }

        .grid-view {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .grid-item {
            text-align: center;
            position: relative;
        }

        .grid-item img {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        .custom-dropdown {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .custom-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #fff;
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .custom-dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .custom-dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .custom-dropdown:hover .custom-dropdown-content {
            display: block;
        }

        .three-dots {
            font-size: 24px;
            font-weight: bold;
            color: #000;
        }

        .custom-dropdown-content.show {
            display: block;
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
            text-align: center;
            position: relative;
        }

        .center-btn {
        display: flex;
        justify-content: center;
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
        <?php if (!$isAdminLoggedIn && !$bypassLogin): ?>

        <!-- Pop-up HTML -->
        <div class="popup-container" id="popupContainer">
            <div class="popup-content">
                <span class="popup-close" onclick="closePopup()">&times;</span>
                <h2>Autentificare Admin</h2><br>
                <form id="adminForm">
                    <input type="text" id="adminUsername" placeholder="Nume Admin" required><br><br>
                    <input type="password" id="adminPassword" placeholder="Parolă" required><br><br>
                    <div class="center-btn">
                        <button type="submit" class="btn btn-primary d-none d-lg-block">Logare</button>
                    </div>
                </form> <br>
                <p class="reset-password"  onclick="resetPassword()">Resetare Parolă</p>
            </div>
        </div>
        <?php endif; ?>

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

    <div class="container mt-5">
        <h2>Adaugă un animal</h2>

        <label for="table">Selectează tabel:</label>
        <select id="table" name="table" onchange="showForm()">
            <option value="dogs">Câini</option>
            <option value="cats">Pisici</option>
            <option value="rabbits">Iepuri</option>
            <option value="birds">Păsări</option>
            <option value="others">Altele</option>
        </select><br><br>

        <!-- Dogs Form -->
        <form action="insert_dog.php" method="post" class="pet-form" id="dogsForm" enctype="multipart/form-data">
            <table class="form-table">
                <tr>
                    <th><label for="pet_name">Nume:</label></th>
                    <td><input type="text" id="pet_name" name="pet_name" required></td>
                </tr>
                <tr>
                    <th><label for="age">Vârstă:</label></th>
                    <td>
                        <select id="age" name="age">
                            <option value="puppy">Puppy</option>
                            <option value="young">Young</option>
                            <option value="adult">Adult</option>
                            <option value="senior">Senior</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="sex">Sex:</label></th>
                    <td>
                        <select id="sex" name="sex">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="breed">Rasă:</label></th>
                    <td><input type="text" id="breed" name="breed"></td>
                </tr>
                <tr>
                    <th><label for="size">Mărime:</label></th>
                    <td>
                        <select id="size" name="size">
                            <option value="small">Small</option>
                            <option value="med">Medium</option>
                            <option value="large">Large</option>
                            <option value="x-large">X-Large</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="color">Culoare:</label></th>
                    <td><input type="text" id="color" name="color"></td>
                </tr>
                <tr>
                    <th><label for="spayed">Sterilizat:</label></th>
                    <td><input type="checkbox" id="spayed" name="spayed" value="1"></td>
                </tr>
                <tr>
                    <th><label for="vaccinated">Vaccinat:</label></th>
                    <td><input type="checkbox" id="vaccinated" name="vaccinated" value="1"></td>
                </tr>
                <tr>
                    <th><label for="special_needs">Special Needs:</label></th>
                    <td><input type="checkbox" id="special_needs" name="special_needs" value="1"></td>
                </tr>
                <tr>
                    <th><label for="image_path">Imagine:</label></th>
                    <td><input type="file" id="image_path" name="image_path" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" class="btn btn-primary d-none d-lg-block" value="Adaugă câine"></td>
                </tr>
            </table>
        </form>

        <!-- Cats Form -->
        <form action="insert_cat.php" method="post" class="pet-form" id="catsForm" enctype="multipart/form-data">
            <table class="form-table">
                <tr>
                    <th><label for="cat_name">Nume:</label></th>
                    <td><input type="text" id="cat_name" name="pet_name" required></td>
                </tr>
                <tr>
                    <th><label for="cat_age">Vârstă:</label></th>
                    <td>
                        <select id="cat_age" name="age">
                            <option value="kitten">Kitten</option>
                            <option value="young">Young</option>
                            <option value="adult">Adult</option>
                            <option value="senior">Senior</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="cat_sex">Sex:</label></th>
                    <td>
                        <select id="cat_sex" name="sex">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="cat_color">Culoare:</label></th>
                    <td><input type="text" id="cat_color" name="color"></td>
                </tr>
                <tr>
                    <th><label for="cat_breed">Rasă:</label></th>
                    <td><input type="text" id="cat_breed" name="breed"></td>
                </tr>
                <tr>
                    <th><label for="cat_size">Mărime:</label></th>
                    <td>
                        <select id="cat_size" name="size">
                            <option value="small">Small</option>
                            <option value="med">Medium</option>
                            <option value="large">Large</option>
                            <option value="x-large">X-Large</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="cat_hair_length">Lungime Păr:</label></th>
                    <td>
                        <select id="cat_hair_length" name="hair_length">
                            <option value="Short">Short</option>
                            <option value="Medium">Medium</option>
                            <option value="Long">Long</option>
                            <option value="Hairless">Hairless</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="cat_spayed">Sterilizat:</label></th>
                    <td><input type="checkbox" id="cat_spayed" name="spayed" value="1"></td>
                </tr>
                <tr>
                    <th><label for="cat_vaccinated">Vaccinat:</label></th>
                    <td><input type="checkbox" id="cat_vaccinated" name="vaccinated" value="1"></td>
                </tr>
                <tr>
                    <th><label for="cat_special_needs">Special Needs:</label></th>
                    <td><input type="checkbox" id="cat_special_needs" name="special_needs" value="1"></td>
                </tr>
                <tr>
                    <th><label for="cat_declawed">Declawed:</label></th>
                    <td><input type="checkbox" id="cat_declawed" name="declawed" value="1"></td>
                </tr>
                <tr>
                    <th><label for="image_path">Imagine:</label></th>
                    <td><input type="file" id="image_path" name="image_path" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" class="btn btn-primary d-none d-lg-block" value="Adaugă pisică"></td>
                </tr>
            </table>
        </form>

        <!-- Rabbits Form -->
        <form action="insert_rabbit.php" method="post" class="pet-form" id="rabbitsForm" enctype="multipart/form-data">
            <table class="form-table">
                <tr>
                    <th><label for="rabbit_name">Nume:</label></th>
                    <td><input type="text" id="rabbit_name" name="pet_name" required></td>
                </tr>
                <tr>
                    <th><label for="rabbit_age">Vârstă:</label></th>
                    <td>
                        <select id="rabbit_age" name="age">
                            <option value="baby">Baby</option>
                            <option value="young">Young</option>
                            <option value="adult">Adult</option>
                            <option value="senior">Senior</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="rabbit_sex">Sex:</label></th>
                    <td>
                        <select id="rabbit_sex" name="sex">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="rabbit_breed">Rasă:</label></th>
                    <td><input type="text" id="rabbit_breed" name="breed"></td>
                </tr>
                <tr>
                    <th><label for="rabbit_size">Mărime:</label></th>
                    <td>
                        <select id="rabbit_size" name="size">
                            <option value="dwarf">Dwarf</option>
                            <option value="standard">Standard</option>
                            <option value="giant">Giant</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="rabbit_hair_length">Lungime Păr:</label></th>
                    <td>
                        <select id="rabbit_hair_length" name="hair_length">
                            <option value="Short">Short</option>
                            <option value="Medium">Medium</option>
                            <option value="Long">Long</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="image_path">Imagine:</label></th>
                    <td><input type="file" id="image_path" name="image_path" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" class="btn btn-primary d-none d-lg-block" value="Adaugă iepure"></td>
                </tr>
            </table>
        </form>

        <!-- Birds Form -->
        <form action="insert_bird.php" method="post" class="pet-form" id="birdsForm" enctype="multipart/form-data">
            <table class="form-table">
                <tr>
                    <th><label for="bird_name">Nume:</label></th>
                    <td><input type="text" id="bird_name" name="pet_name" required></td>
                </tr>
                <tr>
                    <th><label for="bird_species">Specie:</label></th>
                    <td><input type="text" id="bird_species" name="species" required></td>
                </tr>
                <tr>
                    <th><label for="bird_sex">Sex:</label></th>
                    <td>
                        <select id="bird_sex" name="sex">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="bird_size">Mărime:</label></th>
                    <td>
                        <select id="bird_size" name="size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="image_path">Imagine:</label></th>
                    <td><input type="file" id="image_path" name="image_path" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" class="btn btn-primary d-none d-lg-block" value="Adaugă pasăre"></td>
                </tr>
            </table>
        </form>

        <!-- Others Form -->
        <form action="insert_other.php" method="post" class="pet-form" id="othersForm" enctype="multipart/form-data">
            <table class="form-table">
                <tr>
                    <th><label for="other_name">Nume:</label></th>
                    <td><input type="text" id="other_name" name="pet_name" required></td>
                </tr>
                <tr>
                    <th><label for="other_species">Specie:</label></th>
                    <td><input type="text" id="other_species" name="species" required></td>
                </tr>
                <tr>
                    <th><label for="other_size">Mprime:</label></th>
                    <td>
                        <select id="other_size" name="size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="image_path">Imagine:</label></th>
                    <td><input type="file" id="image_path" name="image_path" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" class="btn btn-primary d-none d-lg-block" value="Adaugă animăluț"></td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Edit Field Selection Popup -->
        <div class="edit-popup" id="editPopupContainer">
            <div class="edit-popup-content">
                <span class="popup-close" onclick="closeEditPopups()">&times;</span>
                <h2>Selectează câmp editat</h2>
                <form id="editFieldForm">
                    <label for="editField">Alegere:</label>
                    <select id="editField" name="editField" required>
                        <option value="pet_name">Nume</option>
                        <option value="age">Vârstă</option>
                        <option value="sex">Sex</option>
                        <option value="breed">Rasă</option>
                        <option value="size">Mărime</option>
                        <option value="color">Culoare</option>
                        <option value="spayed">Sterilizat</option>
                        <option value="vaccinated">Vaccinat</option>
                        <option value="special_needs">Special Needs</option>
                        <option value="declawed">Declawed</option>
                    </select>
                    <br><br>
                    <button type="submit">Următor</button>
                </form>
            </div>
        </div>

    <!-- Edit Field Value Popup -->
        <div class="edit-popup" id="editFieldPopupContainer">
            <div class="edit-popup-content">
                <span class="popup-close" onclick="closeEditPopups()">&times;</span>
                <h2>Editează valoare câmp</h2>
                <div id="editFieldFormContainer">
                    <label for="newValue">Valoare Nouă:</label>
                    <input type="text" id="newValue" name="newValue" required>
                    <br><br>
                    <button id="cancelEdit" onclick="closeEditPopups()">Anulare</button>
                    <button id="saveEdit">Salvare</button>
                </div>
            </div>
        </div>



    <div class="container mt-5">
        <h2>Listă Animale</h2>
        <button onclick="loadAnimals('dogs')">Câini</button>
        <button onclick="loadAnimals('cats')">Pisici</button>
        <button onclick="loadAnimals('rabbits')">Iepuri</button>
        <button onclick="loadAnimals('birds')">Păsări</button>
        <button onclick="loadAnimals('others')">Altele</button>

        <div class="grid-view" id="animalsGrid">
        </div>
    </div>

    <script>
        function showForm() {
            var table = document.getElementById("table").value;
            var forms = document.getElementsByClassName("pet-form");
            for (var i = 0; i < forms.length; i++) {
                forms[i].style.display = "none";
            }
            document.getElementById(table + "Form").style.display = "block";
        }
        showForm();

        function loadAnimals(table) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'load_animals.php?table=' + table, true);
            xhr.onload = function () {
                if (this.status == 200) {
                    document.getElementById('animalsGrid').innerHTML = this.responseText;
                }
            };
            xhr.send();
        }
    </script>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

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

    <!-- Pop-up JavaScript -->
    <script>

        const fieldsByType = {
            dogs: ['pet_name', 'age', 'sex', 'breed', 'size', 'color', 'spayed', 'vaccinated', 'special_needs'],
            cats: ['pet_name', 'age', 'sex', 'color', 'breed', 'size', 'hair_length', 'spayed', 'vaccinated', 'special_needs', 'declawed'],
            rabbits: ['pet_name', 'age', 'sex', 'breed', 'size', 'hair_length'],
            birds: ['pet_name', 'species', 'sex', 'size'],
            others: ['pet_name', 'species', 'size']
        };

        function showPopup() {
            document.getElementById("popupContainer").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("popupContainer").style.display = "none";
        }

        function resetPassword() {
            var email = prompt("Please enter your email address:");
            if (email) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "send_reset_email.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        alert("If an account with that email exists, a reset link has been sent.");
                    }
                };
                xhr.send("email=" + encodeURIComponent(email));
            }
        }

        document.getElementById("adminForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission

            var username = document.getElementById("adminUsername").value;
            var password = document.getElementById("adminPassword").value;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "authenticate.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        closePopup(); 
                        window.location.href = 'dbmanager.php?bypass_login=true';
                    } else {
                        alert("Invalid credentials! Please try again.");
                    }
                }
            };
            xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
        });

        window.onload = function() {
            if (!<?php echo json_encode($isAdminLoggedIn); ?> && !<?php echo json_encode($bypassLogin); ?>) {
                showPopup();
            }
        };

        function toggleDropdown(event, id) {
            event.stopPropagation();
            var dropdown = document.getElementById('dropdown-' + id);
            dropdown.classList.toggle('show');
        }

        function deletePet(table, id) {
            if (confirm("Ești sigur că vrei să ștergi acest animal??")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_pet.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText);
                        loadAnimals(table); 
                    }
                };
                xhr.send("table=" + table + "&id=" + id);
            }
        }

        function editPet(table, id, type) {
            document.getElementById('editPopupContainer').style.display = 'flex';
            const fieldSelect = document.getElementById('editField');
            fieldSelect.innerHTML = ''; 

            fieldsByType[type].forEach(field => {
                const option = document.createElement('option');
                option.value = field;
                option.text = field.charAt(0).toUpperCase() + field.slice(1).replace('_', ' ');
                fieldSelect.appendChild(option);
            });

            document.getElementById('editFieldForm').onsubmit = function(event) {
                event.preventDefault();
                const field = document.getElementById('editField').value;
                showEditFieldPopup(table, id, field, type);
            };
        }

        function showEditFieldPopup(table, id, field, type) {
            var editFieldFormContainer = document.getElementById('editFieldFormContainer');
            editFieldFormContainer.innerHTML = ''; 

            var label = document.createElement('label');
            label.setAttribute('for', 'newValue');
            label.innerText = 'New Value:';
            editFieldFormContainer.appendChild(label);

            var input;

            if (field === 'age') {
                input = document.createElement('select');
                input.setAttribute('id', 'newValue');
                input.setAttribute('name', 'newValue');
                var options = ['puppy', 'kitten', 'young', 'adult', 'senior', 'baby'];
                for (var i = 0; i < options.length; i++) {
                    var option = document.createElement('option');
                    option.setAttribute('value', options[i]);
                    option.innerText = options[i].charAt(0).toUpperCase() + options[i].slice(1);
                    input.appendChild(option);
                }
            } else if (field === 'sex') {
                input = document.createElement('select');
                input.setAttribute('id', 'newValue');
                input.setAttribute('name', 'newValue');
                var options = ['male', 'female'];
                for (var i = 0; i < options.length; i++) {
                    var option = document.createElement('option');
                    option.setAttribute('value', options[i]);
                    option.innerText = options[i].charAt(0).toUpperCase() + options[i].slice(1);
                    input.appendChild(option);
                }
            } else if (field === 'size') {
                input = document.createElement('select');
                input.setAttribute('id', 'newValue');
                input.setAttribute('name', 'newValue');
                var options = ['small', 'med', 'large', 'x-large'];
                for (var i = 0; i < options.length; i++) {
                    var option = document.createElement('option');
                    option.setAttribute('value', options[i]);
                    option.innerText = options[i].charAt(0).toUpperCase() + options[i].slice(1);
                    input.appendChild(option);
                }
            } else if (['spayed', 'vaccinated', 'special_needs', 'declawed'].includes(field)) {
                input = document.createElement('input');
                input.setAttribute('type', 'checkbox');
                input.setAttribute('id', 'newValue');
                input.setAttribute('name', 'newValue');
            } else {
                input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('id', 'newValue');
                input.setAttribute('name', 'newValue');
                input.setAttribute('required', true);
            }

            editFieldFormContainer.appendChild(input);

            var br = document.createElement('br');
            editFieldFormContainer.appendChild(br);
            
            var cancelBtn = document.createElement('button');
            cancelBtn.setAttribute('id', 'cancelEdit');
            cancelBtn.setAttribute('type', 'button');
            cancelBtn.innerText = 'Cancel';
            cancelBtn.onclick = closeEditPopups;
            editFieldFormContainer.appendChild(cancelBtn);

            var saveBtn = document.createElement('button');
            saveBtn.setAttribute('id', 'saveEdit');
            saveBtn.setAttribute('type', 'button');
            saveBtn.innerText = 'Save';
            saveBtn.onclick = function() {
                var newValue = document.getElementById('newValue').type === 'checkbox' ? (document.getElementById('newValue').checked ? 1 : 0) : document.getElementById('newValue').value;
                saveEdit(table, id, field, newValue);
            };
            editFieldFormContainer.appendChild(saveBtn);

            document.getElementById('editFieldPopupContainer').style.display = 'flex';
        }

        function saveEdit(table, id, field, value) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "edit_pet.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    loadAnimals(table); 
                    closeEditPopups();
                }
            };
            xhr.send("table=" + table + "&id=" + id + "&field=" + field + "&value=" + value);
        }

        function closeEditPopups() {
            document.getElementById('editPopupContainer').style.display = 'none';
            document.getElementById('editFieldPopupContainer').style.display = 'none';
        }

        window.onclick = function(event) {
            if (!event.target.matches('.three-dots')) {
                var dropdowns = document.getElementsByClassName("custom-dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>

</html>
