<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    if (isset($_SESSION['userEmail']) && isset($_SESSION['userName'])) {
        $_SESSION['user'] = [
            'email' => $_SESSION['userEmail'],
            'name' => $_SESSION['userName']
        ];
    } else {
        header("Location: index.php");
        exit();
    }
}

$user = $_SESSION['user'];
$name = $user['name'];
$email = $user['email'];

$correct_answers = [
    'question1' => 'b',
    'question2' => 'b',
    'question3' => 'a',
    'question4' => 'c',
    'question5' => 'b',
    'question6' => 'b',
    'question7' => 'b',
    'question8' => 'b',
    'question9' => 'a',
    'question10' => 'd',
    'question11' => 'a',
    'question12' => 'b',
    'question13' => 'b',
    'question14' => 'a',
    'question15' => 'a',
];

$score = 0;

foreach ($correct_answers as $question => $correct_answer) {
    if (isset($_POST[$question]) && $_POST[$question] == $correct_answer) {
        $score++;
    }
}

$stmt = $conn->prepare("INSERT INTO quiz_scores (name, email, score) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $name, $email, $score);
$stmt->execute();

$stmt->close();
$conn->close();

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Rezultat Quiz</title>
    <link href='css/style.css' rel='stylesheet'>
</head>
<body>
    <div class='container'>
        <h1>Rezultatul Quiz-ului</h1>
        <p>Nume: " . htmlspecialchars($name) . "</p>
        <p>Email: " . htmlspecialchars($email) . "</p>
        <p>Scor: $score / 15</p>
        <a href='index.php' class='btn btn-primary'>Înapoi la pagina principală</a>
        <a href='leaderboard.php' class='btn btn-primary'>Vezi Clasamentul</a>
    </div>
</body>
</html>";
?>
