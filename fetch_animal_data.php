<?php
include 'config.php';

$sql = "
    SELECT 'Câini' as type, COUNT(*) as count FROM dogs
    UNION ALL
    SELECT 'Pisici', COUNT(*) FROM cats
    UNION ALL
    SELECT 'Iepuri', COUNT(*) FROM rabbits
    UNION ALL
    SELECT 'Păsări', COUNT(*) FROM birds
    UNION ALL
    SELECT 'Altele', COUNT(*) FROM others
";

$result = $conn->query($sql);

$data = [];
$total_count = 0;
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    $total_count += $row['count'];
}

$response = [
    'data' => $data,
    'total' => $total_count
];

echo json_encode($response);
?>
