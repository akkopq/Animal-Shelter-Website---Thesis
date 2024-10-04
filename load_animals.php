<?php
include 'config.php';

$table = $_GET['table'];

$sql = "SELECT id, pet_name, image_path, ' . $table . ' as type FROM $table"; 
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo '<div class="grid-item" data-type="' . $table . '">';
        echo '<img src="' . $row['image_path'] . '" alt="' . $row['pet_name'] . '">';
        echo '<div class="custom-dropdown" onclick="toggleDropdown(event, ' . $row['id'] . ')">
                <span class="three-dots">⋮</span>
                <div class="custom-dropdown-content" id="dropdown-' . $row['id'] . '">
                    <a href="#" onclick="deletePet(\'' . $table . '\', ' . $row['id'] . ')">Delete</a>
                    <a href="#" onclick="editPet(\'' . $table . '\', ' . $row['id'] . ', \'' . $table . '\')">Edit</a>
                </div>
              </div>';
        echo '<p>' . $row['pet_name'] . '</p>';
        echo '</div>';
    }
} else {
    echo 'Niciun animal introdus.';
}

mysqli_close($conn);
?>
