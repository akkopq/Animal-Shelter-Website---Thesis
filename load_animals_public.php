<?php
include 'config.php';

$tables = isset($_GET['tables']) ? explode(',', $_GET['tables']) : [];

if (empty($tables)) {
    echo 'No tables selected.';
    exit;
}

$allAnimals = [];

foreach ($tables as $table) {
    if (!empty($table)) {
        $query = "SELECT * FROM $table";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['table'] = $table;
                $allAnimals[] = $row;
            }
        }
    }
}

if (empty($allAnimals)) {
    echo 'No animals found.';
} else {
    foreach ($allAnimals as $animal) {
        echo '<div class="grid-item" onclick="showPopup(\'' . $animal['image_path'] . '\', \'' . generateInfoHtml($animal) . '\')">';
        echo '<img src="' . $animal['image_path'] . '" alt="Animal Image">';
        echo '<p>' . $animal['pet_name'] . '</p>';
        echo '</div>';
    }
}

function generateInfoHtml($animal) {
    $infoHtml = '';
    foreach ($animal as $key => $value) {
        if ($key != 'id' && $key != 'image_path' && $key != 'table') {
            $formattedKey = formatFieldName($key);
            $formattedValue = formatInfo($key, $value);
            $infoHtml .= "<p><strong>$formattedKey:</strong> $formattedValue</p>";
        }
    }
    return $infoHtml;
}

function formatInfo($field, $value) {
    if ($field === 'spayed' || $field === 'vaccinated' || $field === 'special_needs' || $field === 'declawed') {
        return $value == '1' ? 'Da' : 'Nu';
    }
    return $value;
}

function formatFieldName($field) {
    switch ($field) {
        case 'special_needs':
            return 'Nevoi Speciale';
        case 'pet_name':
            return 'Nume';
        case 'age':
            return 'Vârstă';
        case 'sex':
            return 'Sex';
        case 'breed':
            return 'Rasă';
        case 'size':
            return 'Mărime';
        case 'color':
            return 'Culoare';
        case 'spayed':
            return 'Sterilizat';
        case 'vaccinated':
            return 'Vaccinat';
        case 'declawed':
            return 'Fără gheare';
        default:
            return ucfirst(str_replace('_', ' ', $field));
    }
}
?>
