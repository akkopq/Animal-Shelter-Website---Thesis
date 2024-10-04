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

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

</head>

<style>
    .chart-container {
        width: 70%;
        margin: auto;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.0);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(0px);
        text-align: center;
    }

    .chart-container canvas {
        background-color: transparent;
    }

    .chart-text {
        color: white;
        font-size: 25px;
        margin-top: 10px;
    }

    .bg-chart {
        background: linear-gradient(rgba(33, 30, 28, 0.7), rgba(33, 40, 28, 0.7)), url(./img/chart.jpg), no-repeat center center;
        background-size: cover;
    }

    .bg-map {
        background: linear-gradient(rgba(33, 30, 28, 0.7), rgba(33, 40, 28, 0.7)), url(./img/map.jpg), no-repeat center center;
        background-size: cover;
    }

    #map {
        width: 100%;
        height: 500px;
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

<body>

    <!-- Topbar -->
    <div class="container-fluid bg-light d-none d-lg-block">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="btn btn-primary px-3 mr-2" href="adoption.php" role="button">Adoptă un animal</a>
                    <a class="btn btn-secondary px-3" href="rehome.html" role="button">Relochează un animal</a>
                    <a href="dbmanager.php" class="nav-item nav-link px-4">Admin</a>
                </div>
            </div>
            <div class="col-lg-6 text-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-primary px-2 py-2" id="clock"></a>
                    <a class="text-primary px-2 py-2" href="https://www.facebook.com/profile.php?id=100009294300385">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-primary px-2 py-2" href="https://twitter.com/akko_qq">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-primary px-2 py-2" href="https://www.linkedin.com/in/mihai-gabriel-serban-857ab6286/">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-primary px-2 py-2" href="https://www.instagram.com/akko.qq/">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-primary pl-2 py-2" href="https://www.youtube.com/channel/UCADNnF_prTj2btA4bmovTgg">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>




    <!-- Navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.php" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-primary"><span class="text-dark">Adăpost</span> <span class="text-green"> de</span> Animale</h1>
            </a>
            <img src="img/cute doggie ghost.png" width="60" height="60">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav m-auto py-0">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle px-4" data-toggle="dropdown">Adoptă un animal</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="adoption.php?filter=dogs" class="dropdown-item">Adoptă un câine</a>
                            <a href="adoption.php?filter=cats" class="dropdown-item">Adoptă o pisică</a>
                            <a href="adoption.php?filter=small_animals" class="dropdown-item">Adoptă un animal mic</a>
                        </div>
                    </div>
                    <a id="shopButton" href="javascript:void(0);" class="nav-item nav-link px-4 disabled" onclick="redirectToQuiz()">Quiz</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle px-4" data-toggle="dropdown">Ghiduri</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="dog_adoption_guide.html" class="dropdown-item">Cum să adopți un câine?</a>
                            <a href="cat_adoption_guide.html" class="dropdown-item">Cum să adopți o pisică?</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle px-4" data-toggle="dropdown">Sfaturi</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="advice.html" class="dropdown-item">Sfaturi înainte de adopție</a>
                            <a href="behaviour.html" class="dropdown-item">Comportamentul Animalelor</a>
                            <a href="insurance.html" class="dropdown-item">Asigurare pentru animale</a>
                            <a href="happy_past.html" class="dropdown-item">Animale Relocate</a>
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0);" class="btn btn-primary d-none d-lg-block" onclick="openLoginForm()">Logare</a>
                <a class="nav-link"> </a>
                <a href="javascript:void(0);" class="btn btn-primary d-none d-lg-block" onclick="openAccountForm()">Creează Cont</a>
            </div>
        </nav>
    </div>

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


    <!-- Carousel -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#header-carousel" data-slide-to="1"></li>
                <li data-target="#header-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item position-relative active" style="min-height: 100vh;">
                    <img class="position-absolute w-100 h-100" src="img/carousel-1.jpg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown" style="letter-spacing: 3px;">Adoptă un Prieten</h6>
                            <h3 class="display-3 text-white mb-3">Găsește-ți Prietenul de Nădejde</h3>
                            <p class="mx-md-5 px-5">Vizitează adăpostul nostru pentru a adopta un animal iubitor și a-i oferi o casă permanentă.</p>
                            <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp" href="adoption.php">Adoptă acum!</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item position-relative" style="min-height: 100vh;">
                    <img class="position-absolute w-100 h-100" src="img/carousel-2.jpg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown" style="letter-spacing: 3px;">Salvăm Vieți</h6>
                            <h3 class="display-3 text-white mb-3">Alătură-te Misiunii Noastre</h3>
                            <p class="mx-md-5 px-5">Sprijină adăpostul nostru și contribuie la salvarea și reabilitarea animalelor abandonate.</p>
                            <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp" href="adoption.php">Adoptă acum!</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item position-relative" style="min-height: 100vh;">
                    <img class="position-absolute w-100 h-100" src="img/carousel-3.jpg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown" style="letter-spacing: 3px;">Evenimente de Adopție</h6>
                            <h3 class="display-3 text-white mb-3">Participă la Evenimentele Noastre</h3>
                            <p class="mx-md-5 px-5">Vino la evenimentele noastre de adopție și descoperăți noul tău prieten.</p>
                            <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp" href="adoption.php">Adoptă acum!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Colored Strip -->
    <div class="container-fluid" style="background-color: #f7ede3; height: 60px;"></div>


    <!-- About -->
    <div class="container-fluid py-5" style="background-image: url('img/bones.jpg'); background-size: cover; background-position: center;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 pb-5 pb-lg-0">
                    <img class="img-fluid w-100" src="img/about.jpg" alt="">
                </div>
                <div class="col-lg-6">
                    <h6 class="d-inline-block text-primary text-uppercase bg-light py-1 px-2">Misiunea Noastra</h6>
                    <h1 class="mb-4">Adoptarea unui animăluț de companie este cel mai bun lucru pe care îl poți face!</h1>
                    <p class="pl-4 border-left border-primary text-white">Așa că vrem să facem lucrurile mai ușoare, cu instrumentele și sfaturile de care ai nevoie.Facem orice este necesar pentru a ajuta milioane de oameni și animale să se întâlnească. Ești gata să îți găsești propriul animal de companie? Nu ezita.</p>
                    <div class="row pt-3">
                        <div class="col-6">
                            <div class="bg-light text-center p-4">
                                <h3 class="display-4 text-primary" data-toggle="counter-up">48</h3>
                                <h6 class="text-uppercase">Animăluțe salvate doar luna aceasta</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-light text-center p-4">
                                <h3 class="display-4 text-primary" data-toggle="counter-up">846</h3>
                                <h6 class="text-uppercase">Animale adoptate și fericite</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Recent + Graph -->
    <div class="container-fluid px-0 py-5 my-5">
        <div class="row mx-0 justify-content-center text-center">
            <div class="col-lg-6">
                <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">Istoric Adopție</h6>
                <h1>Ultimele Animăluțe Relocate cu Succes</h1>
            </div>
        </div>
        <div class="owl-carousel service-carousel">
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/s-1.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Teddy</h4>
                    <p class="text-white px-3 mb-3">Cățel Pomeranian</p>
                    <div class="w-100 bg-white text-center p-4">
                        <a class="btn btn-primary" href="happy_past.html">Află mai multe</a>
                    </div>
                </div>
            </div>
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/s-2.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Lele</h4>
                    <p class="text-white px-3 mb-3">Pisică Persiană</p>
                    <div class="w-100 bg-white text-center p-4">
                        <a class="btn btn-primary" href="happy_past.html">Află mai multe</a>
                    </div>
                </div>
            </div>
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/s-3.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Buddy</h4>
                    <p class="text-white px-3 mb-3">Labrador Retriever</p>
                    <div class="w-100 bg-white text-center p-4">
                        <a class="btn btn-primary" href="happy_past.html">Află mai multe</a>
                    </div>
                </div>
            </div>
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/s-4.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Mango</h4>
                    <p class="text-white px-3 mb-3">Papagal African Grey</p>
                    <div class="w-100 bg-white text-center p-4">
                        <a class="btn btn-primary" href="happy_past.html">Află mai multe</a>
                    </div>
                </div>
            </div>
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/s-5.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Karma</h4>
                    <p class="text-white px-3 mb-3">Cameleon</p>
                    <div class="w-100 bg-white text-center p-4">
                        <a class="btn btn-primary" href="happy_past.html">Află mai multe</a>
                    </div>
                </div>
            </div>
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/s-6.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Basil</h4>
                    <p class="text-white px-3 mb-3">Piton de Covor</p>
                    <div class="w-100 bg-white text-center p-4">
                        <a class="btn btn-primary" href="happy_past.html">Află mai multe</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center bg-chart mx-0">
            <div class="col-lg-6 py-5">
                <div class="chart-container">
                    <br> <br> <br> <br>
                    <canvas id="animalChart"></canvas>
                    <div id="totalAnimals" class="chart-text">Animale Totale: 0</div> <br> <br> <br> <br> <br> <br>
                </div>
            </div>
        </div>
    </div>


    <!-- Program -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/program.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="hours-text bg-light p-4 p-lg-5 my-lg-5">
                        <h6 class="d-inline-block text-white text-uppercase bg-primary py-1 px-2">Program</h6>
                        <h1 class="mb-4">Cel mai uman adăpost pentru animale.</h1>
                        <p>Serviciile noastre de calitate superioară au satisfăcut clienți și animale nenumărate</p>
                        <ul class="list-inline">
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Luni – Vineri : 9:00 AM - 10:00 PM</li>
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Sâmbătă : 10:00 AM - 8:00 PM</li>
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Duminică : Închis</li>
                        </ul>
                        <a href="https://www.google.com/maps/place/Strada+1+Mai,+%C8%9Aepu+807305/@45.9629442,27.3930108,18.17z/data=!4m6!3m5!1s0x40b42d398a0f0ae3:0x1cd0ffc271cb465d!8m2!3d45.9631918!4d27.3933197!16s%2Fg%2F11c635g1xk?entry=ttu" class="btn btn-primary mt-2">Vizitează-ne acum!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Map -->
    <div class="container-fluid bg-map" style="margin: 90px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <br> <br> <br>
                    <h6 class="d-inline-block text-white text-uppercase bg-primary py-1 px-2">Ne găsești la adresa</h6>
                    <p class="text-white px-3 mb-3">Strada 1 Mai, Țepu, Galați, România</p>
                    <div id="map" style="width: 100%; height: 500px; margin: 20px 0;"></div>
                    <br> <br> <br>
                    <br> <br> <br>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 pb-5 pb-lg-0">
                    <img class="img-fluid w-100" src="img/testimonial.jpg" alt="">
                </div>
                <div class="col-lg-6">
                    <h6 class="d-inline-block text-primary text-uppercase bg-light py-1 px-2">Review-uri</h6>
                    <h1 class="mb-4">Ce Spun Clientii</h1>
                    <div class="owl-carousel testimonial-carousel">
                        <?php
                        include 'fetch_reviews.php';
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="position-relative">';
                                echo '<i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>';
                                echo '<div class="d-flex align-items-center mb-3">';
                                echo '<img class="img-fluid rounded-circle" src="' . $row["profile_pic"] . '" style="width: 60px; height: 60px;" alt="">';
                                echo '<div class="ml-3">';
                                echo '<h6 class="text-uppercase">' . $row["name"] . '</h6>';
                                echo '<span>' . $row["occupation"] . '</span>';
                                echo '</div>';
                                echo '</div>';
                                echo '<p class="m-0">' . $row["review"] . '</p>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Review Button -->
    <div class="text-center mt-4">
        <button class="btn btn-primary" onclick="openReviewForm()">Adaugă o recenzie</button>
    </div>

    <!-- Review Popup Form -->
    <div id="reviewForm" class="popup-form">
        <form action="add_review.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nume:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="occupation">Ocupație:</label>
                <input type="text" class="form-control" id="occupation" name="occupation" required>
            </div>
            <div class="form-group">
                <label for="review">Recenzie:</label>
                <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="profile_pic">Poza de Profil:</label>
                <input type="file" class="form-control" id="profile_pic" name="profile_pic" required>
            </div>
            <button type="submit" class="btn btn-primary">Adaugă</button>
            <button type="button" class="btn btn-secondary" onclick="closeReviewForm()">Închide</button>
        </form>
    </div>


    <!-- Footer -->
    <div class="footer container-fluid position-relative bg-dark py-5" style="margin-top: 90px;">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6 pr-lg-5 mb-5">
                    <a href="index.php" class="navbar-brand">
                        <h1 class="m-0 text-primary"><span class="text-white">Adăpost</span> <span class="text-green"> de</span> Animale</h1>
                    </a>
                </div>
                <div class="col-lg-6 pl-lg-5">
                    <div class="row">
                        <div class="col-sm-12 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Buletin</h5>
                            <form id="newsletterForm" action="newsletter_signup.php" method="POST" onsubmit="return handleNewsletterSignup(event);">
                                <div class="w-100">
                                    <div class="input-group">
                                        <input type="email" class="form-control border-light" style="padding: 30px;" placeholder="Email-ul dvs." id="mail" name="mail" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary px-4">Înregistrare</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top py-4" style="border-color: rgba(256, 256, 256, .15) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="m-0 text-white">&copy; <a href="index.php">Adăpost de animale</a>. Toate drepturile rezervate.</p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <p class="m-0 text-white">Proiectat de <a href="https://www.instagram.com/akko.qq/">Șerban Mihai</a></p>
                </div>
            </div>
        </div>
    </div>


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

    <script src="js/main.js"></script>
    <!-- clock -->
    <script src="js/time.js"></script>

    <script>
        function openResetPasswordForm() {
            document.getElementById('resetPasswordForm').style.display = 'block';
        }

        function closeResetPasswordForm() {
            document.getElementById('resetPasswordForm').style.display = 'none';
        }

        function handlePasswordReset(event) {
            event.preventDefault();

            const form = document.getElementById('resetForm');
            const formData = new FormData(form);

            fetch('send_reset_email_public.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert(data.message, 'success');
                        closeResetPasswordForm();
                    } else {
                        showAlert(data.message, 'error');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function showAlert(message, type) {
            const alertBox = document.createElement('div');
            alertBox.className = `alert alert-${type}`;
            alertBox.textContent = message;

            document.body.appendChild(alertBox);

            setTimeout(() => {
                alertBox.remove();
            }, 3000);
        }

        function openLoginForm() {
            document.getElementById('loginForm').style.display = 'block';
        }

        function closeLoginForm() {
            document.getElementById('loginForm').style.display = 'none';
        }

        function handleLogin(event) {
            event.preventDefault();

            const form = document.getElementById('loginFormElement');
            const formData = new FormData(form);

            fetch('login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showAlert(data.message, 'success');
                    closeLoginForm();
                    document.getElementById('shopButton').classList.remove('disabled');
                    document.getElementById('shopButton').href = 'quiz.php';
                } else {
                    showAlert(data.message, 'error');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function showAlert(message, type) {
            const alertBox = document.createElement('div');
            alertBox.className = `alert alert-${type}`;
            alertBox.textContent = message;

            document.body.appendChild(alertBox);

            setTimeout(() => {
                alertBox.remove();
            }, 3000);
        }

        function openAccountForm() {
            document.getElementById('createAccountForm').style.display = 'block';
        }

        function closeAccountForm() {
            document.getElementById('createAccountForm').style.display = 'none';
        }

        function handleAccountCreation(event) {
            event.preventDefault();

            const password = document.getElementById('account_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                alert('Parolele nu se potrivesc!');
                return false;
            }

            const form = document.getElementById('accountForm');
            const formData = new FormData(form);

            fetch('create_account.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert(data.message, 'success');
                        closeAccountForm();
                    } else {
                        showAlert(data.message, 'error');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function handleNewsletterSignup(event) {
            event.preventDefault(); 

            const form = document.getElementById('newsletterForm');
            const formData = new FormData(form);

            fetch('newsletter_signup.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert(data.message, 'success');
                    } else {
                        showAlert(data.message, 'error');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function showAlert(message, type) {
            const alertBox = document.createElement('div');
            alertBox.className = `alert alert-${type}`;
            alertBox.textContent = message;

            document.body.appendChild(alertBox);

            setTimeout(() => {
                alertBox.remove();
            }, 3000);
        }

        function openReviewForm() {
            document.getElementById('reviewForm').style.display = 'block';
        }

        function closeReviewForm() {
            document.getElementById('reviewForm').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('addReviewModal')) {
                document.getElementById('addReviewModal').style.display = "none";
            }
        }

        function fetchReviews() {
            fetch('fetch_reviews.php')
                .then(response => response.json())
                .then(reviews => {
                    const carousel = document.getElementById('testimonial-carousel');
                    reviews.forEach(review => {
                        const reviewItem = `
                            <div class="position-relative">
                                <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                                <div class="d-flex align-items-center mb-3">
                                    <img class="img-fluid rounded-circle" src="${review.profile_pic}" style="width: 60px; height: 60px;" alt="">
                                    <div class="ml-3">
                                        <h6 class="text-uppercase">${review.name}</h6>
                                        <span>${review.occupation}</span>
                                    </div>
                                </div>
                                <p class="m-0">${review.review}</p>
                            </div>`;
                        carousel.innerHTML += reviewItem;
                    });

                    $('.testimonial-carousel').owlCarousel({
                        autoplay: true,
                        smartSpeed: 1500,
                        dots: true,
                        loop: true,
                        items: 1
                    });
                })
                .catch(error => console.error('Error fetching reviews:', error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchReviews();
        });

        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([45.963194, 27.393333], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([45.963194, 27.393333]).addTo(map)
                .bindPopup('Adăpost de Animale')
                .openPopup();
        });

        function fetchAnimalData() {
            fetch('fetch_animal_data.php')
                .then(response => response.json())
                .then(response => {
                    const data = response.data;
                    const totalAnimals = response.total;

                    const labels = data.map(item => item.type);
                    const counts = data.map(item => item.count);

                    const ctx = document.getElementById('animalChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Număr de Animale',
                                data: counts,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        color: 'white'
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Distribuția Animalelor în Adăpost',
                                    color: 'white'
                                }
                            }
                        }
                    });


                    document.getElementById('totalAnimals').innerText = `Animale Totale: ${totalAnimals}`;
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchAnimalData();
        });

        function redirectToQuiz() {
            window.location.href = 'quiz.php';
        }
    </script>

</body>

</html>
