<?php
session_start();

if (!isset($_SESSION['userEmail']) && !isset($_COOKIE['user'])) {
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['userEmail'])) {
    $userEmail = $_SESSION['userEmail'];
    $userName = $_SESSION['userName'];
} else {
    $user = json_decode($_COOKIE['user'], true);
    $userEmail = $user['email'];
    $userName = $user['name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Quiz - Adăpost de animale</title>
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
</head>

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
                            <a href="adopt_dog.html" class="dropdown-item">Adoptă un câine</a>
                            <a href="adopt_cat.html" class="dropdown-item">Adoptă o pisică</a>
                            <a href="adopt_small_animal.html" class="dropdown-item">Adoptă un animal mic</a>
                        </div>
                    </div>
                    <a id="shopButton" href="quiz.php" class="nav-item nav-link px-4">Quiz</a>
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
                            <a href="behavior.html" class="dropdown-item">Comportamentul Animalelor</a>
                            <a href="insurance.html" class="dropdown-item">Asigurare pentru animale</a>
                            <a href="breeds.html" class="dropdown-item">Diferențele între rase</a>
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0);" class="btn btn-primary d-none d-lg-block" onclick="openLoginForm()">Logare</a>
                <a class="nav-link"> </a>
                <a href="javascript:void(0);" class="btn btn-primary d-none d-lg-block" onclick="openAccountForm()">Creează Cont</a>
            </div>
        </nav>
    </div>

    <!-- Quiz Section -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Quiz despre animale</h1>
                    <form id="quizForm" action="submit_quiz.php" method="POST">
                        <!-- Quiz Questions -->
                        <div class="form-group">
                            <label>1. Care este cel mai mare mamifer terestru?</label>
                            <div>
                                <input type="radio" name="question1" value="a" required> A. Balena<br>
                                <input type="radio" name="question1" value="b"> B. Elefantul<br>
                                <input type="radio" name="question1" value="c"> C. Leul<br>
                                <input type="radio" name="question1" value="d"> D. Girafa<br>
                            </div>
                        </div>
                        <!-- Add more questions -->
                        <div class="form-group">
                            <label>2. Ce animal este cunoscut ca fiind "Regele junglei"?</label>
                            <div>
                                <input type="radio" name="question2" value="a" required> A. Tigru<br>
                                <input type="radio" name="question2" value="b"> B. Leu<br>
                                <input type="radio" name="question2" value="c"> C. Urs<br>
                                <input type="radio" name="question2" value="d"> D. Lup<br>
                            </div>
                        </div>
                        <!-- Continue adding questions until you have 15 in total -->
                        <div class="form-group">
                            <label>3. Ce mamifer este cel mai rapid din lume?</label>
                            <div>
                                <input type="radio" name="question3" value="a" required> A. Ghepard<br>
                                <input type="radio" name="question3" value="b"> B. Leu<br>
                                <input type="radio" name="question3" value="c"> C. Tigru<br>
                                <input type="radio" name="question3" value="d"> D. Cal<br>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label>4. Ce animal este cunoscut pentru memoria sa excelentă?</label>
                            <div>
                                <input type="radio" name="question4" value="a" required> A. Pisica<br>
                                <input type="radio" name="question4" value="b"> B. Câine<br>
                                <input type="radio" name="question4" value="c"> C. Elefant<br>
                                <input type="radio" name="question4" value="d"> D. Vultur<br>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label>5. Ce animal este cunoscut pentru abilitatea sa de a schimba culoarea?</label>
                            <div>
                                <input type="radio" name="question5" value="a" required> A. Caracatiță<br>
                                <input type="radio" name="question5" value="b"> B. Cameleon<br>
                                <input type="radio" name="question5" value="c"> C. Peștele balon<br>
                                <input type="radio" name="question5" value="d"> D. Broască<br>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label>6. Care este cea mai mare pasăre din lume?</label>
                            <div>
                                <input type="radio" name="question6" value="a" required> A. Vultur<br>
                                <input type="radio" name="question6" value="b"> B. Struț<br>
                                <input type="radio" name="question6" value="c"> C. Albatros<br>
                                <input type="radio" name="question6" value="d"> D. Pelican<br>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label>7. Ce animal este cunoscut pentru capacitatea sa de a zbura pe loc?</label>
                            <div>
                                <input type="radio" name="question7" value="a" required> A. Vultur<br>
                                <input type="radio" name="question7" value="b"> B. Colibri<br>
                                <input type="radio" name="question7" value="c"> C. Liliac<br>
                                <input type="radio" name="question7" value="d"> D. Păianjen<br>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label>8. Care este cel mai mare animal din lume?</label>
                            <div>
                                <input type="radio" name="question8" value="a" required> A. Elefant<br>
                                <input type="radio" name="question8" value="b"> B. Balena Albastră<br>
                                <input type="radio" name="question8" value="c"> C. Rechinul Balenă<br>
                                <input type="radio" name="question8" value="d"> D. Girafa<br>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label>9. Ce animal este cunoscut pentru capacitatea sa de a regenera părți ale corpului?</label>
                            <div>
                                <input type="radio" name="question9" value="a" required> A. Steaua de mare<br>
                                <input type="radio" name="question9" value="b"> B. Cameleon<br>
                                <input type="radio" name="question9" value="c"> C. Salamandră<br>
                                <input type="radio" name="question9" value="d"> D. Șopârlă<br>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label>10. Care este cel mai rapid animal acvatic?</label>
                            <div>
                                <input type="radio" name="question10" value="a" required> A. Delfin<br>
                                <input type="radio" name="question10" value="b"> B. Rechinul Alb<br>
                                <input type="radio" name="question10" value="c"> C. Peștele Spadă<br>
                                <input type="radio" name="question10" value="d"> D. Peștele Vela<br>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label>11. Ce mamifer este capabil să zboare?</label>
                            <div>
                                <input type="radio" name="question11" value="a" required> A. Liliacul<br>
                                <input type="radio" name="question11" value="b"> B. Veverița<br>
                                <input type="radio" name="question11" value="c"> C. Pisica<br>
                                <input type="radio" name="question11" value="d"> D. Câinele<br>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label>12. Ce animal are cea mai lungă durată de viață?</label>
                            <div>
                                <input type="radio" name="question12" value="a" required> A. Elefant<br>
                                <input type="radio" name="question12" value="b"> B. Țestoasa de Galapagos<br>
                                <input type="radio" name="question12" value="c"> C. Balena Albastră<br>
                                <input type="radio" name="question12" value="d"> D. Omul<br>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label>13. Ce animal poate dormi timp de trei ani?</label>
                            <div>
                                <input type="radio" name="question13" value="a" required> A. Ursul<br>
                                <input type="radio" name="question13" value="b"> B. Melcul<br>
                                <input type="radio" name="question13" value="c"> C. Șarpele<br>
                                <input type="radio" name="question13" value="d"> D. Broasca<br>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label>14. Ce animal este cunoscut pentru abilitatea sa de a folosi unelte?</label>
                            <div>
                                <input type="radio" name="question14" value="a" required> A. Cimpanzeul<br>
                                <input type="radio" name="question14" value="b"> B. Delfinul<br>
                                <input type="radio" name="question14" value="c"> C. Elefantul<br>
                                <input type="radio" name="question14" value="d"> D. Caracatița<br>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label>15. Care este singurul mamifer care nu poate sări?</label>
                            <div>
                                <input type="radio" name="question15" value="a" required> A. Elefant<br>
                                <input type="radio" name="question15" value="b"> B. Giraffa<br>
                                <input type="radio" name="question15" value="c"> C. Rhinocerul<br>
                                <input type="radio" name="question15" value="d"> D. Hipopotamul<br>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Trimite Răspunsuri</button>
                    </form>
                </div>
            </div>
        </div>
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
    <script src="js/time.js"></script>

</body>

</html>
