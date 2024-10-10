<?php
require '../conn.php';

// Get the POSTed sorting order and category
$sortOrder = $_POST['sortOrder'];
$category = $_POST['category'];

// Initial SQL query
$sql = "SELECT * FROM income_entries";

// Add WHERE clause if category is provided
if (!empty($category)) {
    $sql .= " WHERE category LIKE :category";
}

// Add ORDER BY clause for sorting
if (!empty($sortOrder)) {
    $sql .= " ORDER BY id " . strtoupper($sortOrder);
}

$stmt = $conn->prepare($sql);

// Bind category if applicable
if (!empty($category)) {
    $stmt->bindValue(':category', $category . '%');
}

$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the result
$c = 0;
foreach ($rows as $i) {
    $c++;
    echo '<tr>';
    echo '<td>' . $c . '</td>';
    echo '<td>' . '₱ ' . number_format($i['amount'], 2) . '</td>';

    $categories = explode(',', $i['category']);
    $badges = '';

    foreach ($categories as $category) {
        $category = trim($category);
        $badge_class = 'badge bg-success';
        $badges .= '<span class="' . $badge_class . '">' . htmlspecialchars($category) . '</span> ';
    }

    echo '<td>' . $badges . '</td>';
    echo '<td>' . date('M/d', strtotime($i['date_from'])) . ' - ' . date('d/Y', strtotime($i['date_to'])) . '</td>';
    echo '<td>' . $i['notes'] . '</td>';
    echo '</tr>';
}

// If no rows are found
if (empty($rows)) {
    echo '<tr><td colspan="5">No records found.</td></tr>';
}
?>
