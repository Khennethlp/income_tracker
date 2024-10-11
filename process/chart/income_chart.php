<?php
include '../conn.php';

header('Content-Type: application/json');

$sql = "SELECT amount, COUNT(*) as count FROM income_entries";
$stmt = $conn->prepare($sql);

$labels = [];
$values = [];
$colors = []; 

$colorPalette = [
    'rgba(255, 99, 132, 0.2)',
    'rgba(255, 159, 64, 0.2)',
    'rgba(255, 205, 86, 0.2)',
    'rgba(75, 192, 192, 0.2)',
    'rgba(54, 162, 235, 0.2)',
    'rgba(153, 102, 255, 0.2)',
    'rgba(201, 203, 207, 0.2)'
];

$borderColor = [
    'rgb(255, 99, 132)',
    'rgb(255, 159, 64)',
    'rgb(255, 205, 86)',
    'rgb(75, 192, 192)',
    'rgb(54, 162, 235)',
    'rgb(153, 102, 255)',
    'rgb(201, 203, 207)'
];

$i = 0;
if ($stmt->execute()) {
    // Fetch all rows
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Loop through each row to get data
    foreach ($rows as $row) {
        // Use 'role' as labels
        $labels[] = ucfirst($row['role']);
        // Use the count of each role as the value
        $values[] = $row['count'];
        $borderColors[] = $borderColor[$i % count($borderColor)];
        $colors[] = $colorPalette[$i % count($colorPalette)];
        $i++;
    }
}

// Prepare data for chart
$data = [
    'labels' => $labels,  // Roles as labels
    'values' => $values,  // Count of each role as values
    'colors' => $colors,
    'borderColor' => $borderColors
];

// Return the data as JSON
echo json_encode($data);
