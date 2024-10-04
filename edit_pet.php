<?php
include 'config.php';

$table = $_POST['table'];
$id = $_POST['id'];
$field = $_POST['field'];
$value = $_POST['value'];

$sql = "UPDATE $table SET $field = '$value' WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    echo "Înregistrarea a fost actualizată cu succes";
} else {
    echo "Actualizare eșuată: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
