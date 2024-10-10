<?php
require '../conn.php';

$method = $_POST['method'];

if ($method == 'load_income') {
    $sql = "SELECT id, user_id, amount, date_from, date_to, category, notes FROM income_entries ORDER BY id DESC";
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
            $badge_class = 'badge bg-success';
            $badges .= '<span class="' . $badge_class . '">' . htmlspecialchars($category) . '</span> ';
        }

        echo '<td>' . $badges . '</td>';
        echo '<td>' . date('M/d', strtotime($i['date_from'])) . ' - ' . date('d/Y', strtotime($i['date_to'])) . '</td>';
        echo '<td>' . $i['notes'] . '</td>';
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
        echo '<h6 class="mt-2">Current Balance</h6>';

        $amount = $balance['amount'];
        echo '<a href="#" onclick="addToSavings(\'' . htmlspecialchars($user_id) . '~!~' . htmlspecialchars($amount) . '\');" class="text-md" id="add_to_savings" data-target="#savings" data-toggle="modal">add to savings</a>';
    } else {
        echo '₱ 0.00';
    }
}

if ($method == 'savings') {
    $user_id = $_POST['user_id'];

    $sql = "SELECT amount from savings WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($count)) {
        foreach ($count as $c) {
            echo '₱ ' . number_format($c['amount'], 2);
            echo '<h6 class="mt-2">Savings</h6>';

            $amount = $c['amount'];
            echo '<a href="#" onclick="depositAddToBalance(\'' . htmlspecialchars($user_id) . '~!~' . htmlspecialchars($amount) . '\');" class="text-md" id="deposit_to_balance" data-target="#deposit" data-toggle="modal">deposit</a>';
        }
    } else {
        echo '<h2>₱ 0.00</h2>';
    }
}

if ($method == 'deposit') {
    $user_id = $_POST['user_id'];
    $deposit = $_POST['deposit'];

    try {
        // Begin transaction
        $conn->beginTransaction();

        // Retrieve current savings amount
        $sql_get_savings = "SELECT amount FROM savings WHERE user_id = :user_id";
        $stmt_get_savings = $conn->prepare($sql_get_savings);
        $stmt_get_savings->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_get_savings->execute();
        $savings_data = $stmt_get_savings->fetch(PDO::FETCH_ASSOC);

        if ($savings_data) {
            $current_savings = $savings_data['amount'];

            // Check if the deposit is not greater than the available savings
            if ($deposit > $current_savings) {
                echo 'not enough savings';
                $conn->rollBack(); // Rollback if deposit exceeds savings
                exit;
            }

            // Update balance by adding the deposit amount
            $sql_update_balance = "UPDATE balance SET amount = amount + :deposit WHERE user_id = :user_id";
            $stmt_balance = $conn->prepare($sql_update_balance);
            $stmt_balance->bindParam(':deposit', $deposit, PDO::PARAM_STR);
            $stmt_balance->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt_balance->execute();

            // Update savings by subtracting the deposit amount
            $sql_update_savings = "UPDATE savings SET amount = amount - :deposit WHERE user_id = :user_id";
            $stmt_savings = $conn->prepare($sql_update_savings);
            $stmt_savings->bindParam(':deposit', $deposit, PDO::PARAM_STR);
            $stmt_savings->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt_savings->execute();

            // Commit the transaction
            $conn->commit();

            if ($stmt_balance && $stmt_savings) {
                echo 'success';
            } else {
                echo 'failed';
            }
        } else {
            echo 'no savings found';
            $conn->rollBack(); // Rollback if no savings record found
        }
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollBack();
        echo 'failed: ' . $e->getMessage();
    }
}

if ($method == 'amount_saved') {
    $user_id = $_POST['user_id'];
    $savings = $_POST['savings'];

    $conn->beginTransaction();

    try {
        // Check if there is an existing savings record for the user
        $checkSql = "SELECT amount FROM savings WHERE user_id = :user_id";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $checkStmt->execute();
        $existingSavings = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($existingSavings) {
            // If savings record exists, update it by adding the new savings amount
            $sql = "UPDATE savings SET amount = amount + :savings WHERE user_id = :user_id";
        } else {
            // If not, create a new savings record
            $sql = "INSERT INTO savings (user_id, amount) VALUES (:user_id, :savings)";
        }

        // Prepare and execute the appropriate statement
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':savings', $savings, PDO::PARAM_STR);
        $stmt->execute();

        // Insert into savings_logs table to record this transaction
        $sql_logs = "INSERT INTO savings_logs (user_id, amount) VALUES (:user_id, :savings)";
        $stmt_logs = $conn->prepare($sql_logs);
        $stmt_logs->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_logs->bindParam(':savings', $savings, PDO::PARAM_STR);
        $stmt_logs->execute();

        // Update the balance by subtracting the savings
        $sql_update_balance = "UPDATE balance SET amount = amount - :savings WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql_update_balance);
        $stmt->bindParam(':savings', $savings, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $conn->commit();

        echo 'success';
    } catch (Exception $e) {
        $conn->rollBack();
        echo 'failed: ' . $e->getMessage();
    }
}



if ($method == 'income_entries') {
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];
    $notes = $_POST['notes'];

    // Insert into income_entries table
    $sql_income = "INSERT INTO income_entries (user_id, amount, date_from, date_to, category, notes) 
                   VALUES (:user_id, :amount, :date_from, :date_to, :category, :notes)";
    $stmt = $conn->prepare($sql_income);
    $stmt->execute([
        ':user_id' => $user_id,
        ':amount' => $amount,
        ':date_from' => $date_from,
        ':date_to' => $date_to,
        ':category' => $category,
        ':notes' => $notes
    ]);

    // Check if user_id already exists in balance table
    $sql_check_balance = "SELECT * FROM balance WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql_check_balance);
    $stmt->execute([':user_id' => $user_id]);
    $existing_balance = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_balance) {
        // If user_id exists, update the balance
        $sql_update_balance = "UPDATE balance SET amount = amount + :amount WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql_update_balance);
        $stmt->execute([
            ':amount' => $amount,
            ':user_id' => $user_id
        ]);
    } else {
        // If user_id doesn't exist, insert a new balance record
        $sql_insert_balance = "INSERT INTO balance (user_id, amount) VALUES (:user_id, :amount)";
        $stmt = $conn->prepare($sql_insert_balance);
        $stmt->execute([
            ':user_id' => $user_id,
            ':amount' => $amount
        ]);
    }

    if ($stmt) {
        echo 'success';
    } else {
        echo 'failed';
    }
}
