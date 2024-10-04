<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'];
    $pet_name = $_POST['pet_name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $species = isset($_POST['species']) ? $_POST['species'] : null;
    $breed = isset($_POST['breed']) ? $_POST['breed'] : null;
    $size = $_POST['size'];
    $color = isset($_POST['color']) ? $_POST['color'] : null;
    $hair_length = isset($_POST['hair_length']) ? $_POST['hair_length'] : null;
    $spayed = isset($_POST['spayed']) ? 1 : 0;
    $vaccinated = isset($_POST['vaccinated']) ? 1 : 0;
    $special_needs = isset($_POST['special_needs']) ? 1 : 0;
    $declawed = isset($_POST['declawed']) ? 1 : 0;

    $target_dir = "uploads/";
    $imageFileType = strtolower(pathinfo($_FILES["image_path"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . time() . '.' . $imageFileType;
    $uploadOk = 1;

    $check = getimagesize($_FILES["image_path"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if (!is_dir($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            die("Failed to create directories...");
        }
    }

    if ($_FILES["image_path"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image_path"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $image_path = str_replace("\\", "/", $target_file);

    $sql = "INSERT INTO $table (pet_name, age, sex, breed, size, color, hair_length, spayed, vaccinated, special_needs, declawed, species, image_path) 
            VALUES ('$pet_name', '$age', '$sex', '$breed', '$size', '$color', '$hair_length', '$spayed', '$vaccinated', '$special_needs', '$declawed', '$species', '$image_path')";

    if (mysqli_query($conn, $sql)) {
        echo "New entry added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
