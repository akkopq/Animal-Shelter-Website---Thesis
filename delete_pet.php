<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'];
    $id = $_POST['id'];

    $sql = "DELETE FROM $table WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Animăluț șters cu succes.";
    } else {
        echo "Ștergere Eșuată: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
