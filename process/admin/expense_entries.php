<?php
require '../conn.php';

$method = $_POST['method'];

if ($method == 'load_expense') {
    $sql = "SELECT * FROM expense_entries ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $c = 0;

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $i) {
        $c++;
        echo '<tr>';
        echo '<td>' . $c . '</td>';
        echo '<td>' . '₱ ' . number_format($i['amount'], 2) . '</td>';
       
        $categories = explode(',', $i['category']);
        $badges = '';

        foreach ($categories as $category) {
            $category = trim($category);
            $badge_class = 'badge bg-danger';
            $badges .= '<span class="' . $badge_class . '">' . htmlspecialchars($category) . '</span> ';
        }

        echo '<td>' . $badges . '</td>';
        if(!empty($i['custom_date'])){
            echo '<td>' . date('Y/M/d', strtotime($i['custom_date'])) . '</td>';
        }else{
            echo '<td>' . date('Y/M/d', strtotime($i['created_at'])) . '</td>';
        }
        echo '</tr>';
    }
}

if ($method == 'balances') {
    $user_id = $_POST['user_id'];

    $sql = "SELECT amount from balance WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $balance = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($balance) {
        echo '₱ ' . number_format($balance['amount'], 2);
        
    } else {
        echo '₱ 0.00';
    }
}

if ($method == 'expense_entries') {
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $custom_date = $_POST['custom_date'];

    // Insert into expense_entries table
    $sql_expense = "INSERT INTO expense_entries (user_id, amount, category, custom_date)  
                   VALUES (:user_id, :amount, :category, :custom_date)";
    $stmt = $conn->prepare($sql_expense);
    $stmt->execute([
        ':user_id' => $user_id,
        ':amount' => $amount,
        ':category' => $category,
        ':custom_date' => $custom_date,
    ]);

    // Check if user_id already exists in balance table
    $sql_check_balance = "SELECT * FROM balance WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql_check_balance);
    $stmt->execute([':user_id' => $user_id]);
    $existing_balance = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_balance) {
        // If user_id exists, update the balance
        $sql_update_balance = "UPDATE balance SET amount = amount - :amount WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql_update_balance);
        $stmt->execute([
            ':amount' => $amount,
            ':user_id' => $user_id
        ]);
    }

    if ($stmt) {
        echo 'success';
    } else {
        echo 'failed';
    }
}
