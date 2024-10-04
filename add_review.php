<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $occupation = $_POST['occupation'];
    $review = $_POST['review'];

    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $target_dir = "reviewers/";
        $imageFileType = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
        $target_file = $target_dir . time() . '.' . $imageFileType;

        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file)) {
            $profile_pic = $target_file;

            $sql = "INSERT INTO reviews (name, occupation, profile_pic, review) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $occupation, $profile_pic, $review);

            if ($stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                echo "Eroare: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Eroare la încărcarea fișierului.";
        }
    } else {
        echo "Nicio imagine încărcată sau eroare la încărcare.";
    }
}

$conn->close();
?>
