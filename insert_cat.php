<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pet_name = $_POST['pet_name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $color = $_POST['color'];
    $breed = $_POST['breed'];
    $size = $_POST['size'];
    $hair_length = $_POST['hair_length'];
    $spayed = isset($_POST['spayed']) ? 1 : 0;
    $vaccinated = isset($_POST['vaccinated']) ? 1 : 0;
    $special_needs = isset($_POST['special_needs']) ? 1 : 0;
    $declawed = isset($_POST['declawed']) ? 1 : 0;

    $target_dir = "uploads/";
    $imageFileType = strtolower(pathinfo($_FILES["image_path"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . time() . '.' . $imageFileType;
    $uploadOk = 1;

    $check = getimagesize($_FILES["image_path"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Fișierul nu este imagine.";
        $uploadOk = 0;
    }

    if (!is_dir($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            die("Failed to create directories...");
        }
    }

    if ($_FILES["image_path"]["size"] > 5000000) {
        echo "Scuze, imaginea este prea mare!";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Scuze, doar fișiere de tip JPG, JPEG, PNG & GIF sunt acceptate.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Scuze, imaginea nu a fost încărcată cu success.";
    } else {
        if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file)) {
            echo "Imaginea ". htmlspecialchars( basename( $_FILES["image_path"]["name"])). " a fost încărcată.";
        } else {
            echo "Scuze, a avut loc o eroare. Încercați din nou, cu o imagine mai mică.";
        }
    }

    $image_path = str_replace("\\", "/", $target_file);

    $sql = "INSERT INTO cats (pet_name, age, sex, color, breed, size, hair_length, spayed, vaccinated, special_needs, declawed, image_path) 
            VALUES ('$pet_name', '$age', '$sex', '$color', '$breed', '$size', '$hair_length', '$spayed', '$vaccinated', '$special_needs', '$declawed', '$image_path')";

    if (mysqli_query($conn, $sql)) {
        echo "<p>New cat added successfully. You will be redirected to the database manager in 5 seconds.</p>";
        echo '<meta http-equiv="refresh" content="5;url=dbmanager.php?bypass_login=true">';
        echo '<script>
                setTimeout(function() {
                    if (typeof closePopup === "function") {
                        closePopup();
                    }
                    window.location.href = "dbmanager.php?bypass_login=true";
                }, 5000);
              </script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
