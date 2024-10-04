<?php
include 'config.php';

$result = $conn->query("SELECT name, score FROM quiz_scores ORDER BY score DESC");

$leaderboard = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $leaderboard[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasamentul Quiz-ului</title>
    <link href="css/style.css" rel="stylesheet">
    <style>
        .leaderboard-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            text-align: center;
        }
        .leaderboard-item {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .leaderboard-item:first-child .name::after {
            content: " 👑";
        }
    </style>
</head>
<body>
    <div class="leaderboard-container">
        <h1>Clasamentul Quiz-ului</h1>
        <?php if (!empty($leaderboard)): ?>
            <?php foreach ($leaderboard as $index => $item): ?>
                <div class="leaderboard-item">
                    <span class="name"><?= htmlspecialchars($item['name']) ?></span>
                    <span class="score"><?= $item['score'] ?></span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nu există rezultate în clasament.</p>
        <?php endif; ?>
        <a href="index.php" class="btn btn-primary mt-4">Înapoi la pagina principală</a>
    </div>
</body>
</html>
