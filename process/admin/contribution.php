<?php
require '../conn.php';

$method = $_POST['method'];

if ($method == 'load_contribution') {
    $user_id = $_POST['user_id'];

    $sql = "SELECT *, (sss + philhealth + pagibig) as total FROM contributions WHERE user_id = '$user_id' ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $c = 0;

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $i) {
        
        $c++;
        echo '<tr>';
        echo '<td>' . $c . '</td>';
        echo '<td>' . '₱ ' . number_format($i['sss'], 2) . '</td>';
        echo '<td>' . '₱ ' . number_format($i['philhealth'], 2) . '</td>';
        echo '<td>' . '₱ ' . number_format($i['pagibig'], 2) . '</td>';
        echo '<td>' . $i['month'] . '</td>';
        echo '<td>' . $i['year'] . '</td>';
        echo '<td>' . $i['total'] . '</td>';
        echo '</tr>';
    }
}

if ($method == 'contribution_entry') {
    $user_id = $_POST['user_id'];
    $sss = $_POST['sss'];
    $philhealth = $_POST['philhealth'];
    $pagibig = $_POST['pagibig'];
    $month = $_POST['month'];
    $year = date('Y');

    $sql = "INSERT INTO contributions (user_id, sss, philhealth, pagibig, month, year) VALUES ('$user_id', '$sss', '$philhealth', '$pagibig', '$month', '$year')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if($stmt){
        echo 'success';
    }else{
        echo 'failed';
    }

}
