<?php
require '../conn.php';

// Get the posted month and year
$month = $_POST['month'];
$year = $_POST['year'];

$data_income = '';
$data_expense = '';

// Correct SQL query to filter based on month and year
$sql = "SELECT * FROM income_entries WHERE DATE_FORMAT(date_from, '%M') = :month AND YEAR(date_from) = :year";
$stmt = $conn->prepare($sql);

// Bind parameters to the SQL query
$stmt->bindParam(':month', $month, PDO::PARAM_STR);
$stmt->bindParam(':year', $year, PDO::PARAM_INT);
$stmt->execute();

// Fetch all rows
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$c = 0;

// Build the table rows
foreach ($rows as $k) {
    $c++;
    $data_income .= '<tr>';
    $data_income .= '<td>' . $c . '</td>';
    $data_income .= '<td>' . '₱ ' . number_format($k['amount'], 2) . '</td>';
    $data_income .= '<td>' . htmlspecialchars($k['category']) . '</td>';
    $data_income .= '<td>' . date('M/d', strtotime($k['date_from'])) . ' - ' . date('d/Y', strtotime($k['date_to'])) . '</td>';
    $data_income .= '<td>' . htmlspecialchars($k['notes']) . '</td>';
    $data_income .= '</tr>';
}

// Correct SQL query to filter based on month and year
$sql = "SELECT * FROM expense_entries WHERE DATE_FORMAT(created_at, '%M') = :month AND YEAR(created_at) = :year";
$stmt = $conn->prepare($sql);

// Bind parameters to the SQL query
$stmt->bindParam(':month', $month, PDO::PARAM_STR);
$stmt->bindParam(':year', $year, PDO::PARAM_INT);
$stmt->execute();

$rows_exp = $stmt->fetchAll(PDO::FETCH_ASSOC);

$c = 0;

// Build the table rows
foreach ($rows_exp as $j) {
    $c++;
    $data_expense .= '<tr>';
    $data_expense .= '<td>' . $c . '</td>';
    $data_expense .= '<td>' . '₱ ' . number_format($j['amount'], 2) . '</td>';
    $data_expense .= '<td>' . htmlspecialchars($j['category']) . '</td>';
    $data_expense .= '<td>' . date('M/d/Y', strtotime($j['created_at'])) . '</td>';
    $data_expense .= '</tr>';
}

// Return the HTML data_income as a JSON response
echo json_encode(['data_income' => $data_income, 'data_expense' => $data_expense]);
