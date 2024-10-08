<?php
require '../conn.php';

if (isset($_POST['tableData'])) {
    $tableData = $_POST['tableData'];
    $user_id = $_POST['user_id'];
    $entry_category = $_POST['entry_category'];

    if (!empty($tableData)) {
        try {
            $conn->beginTransaction();

            if ($entry_category == 'income_entries') {
                $sql = "INSERT INTO income_entries (user_id, amount, category, date_from, date_to, notes) 
                    VALUES (:user_id, :amount, :category, :date_from, :date_to, :notes)";
            } else if ($entry_category == 'expense_entries') {
                $sql = "INSERT INTO expense_entries (user_id, amount, category)  
                   VALUES (:user_id, :amount, :category)";
            }

            $stmt = $conn->prepare($sql);

            foreach ($tableData as $row) {
                $amount = $row[0];
                $category = $row[1];

                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
                $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
                $stmt->bindParam(':category', $category, PDO::PARAM_STR);

                if ($entry_category == 'income_entries') {
                    $date_from = $row[2];
                    $date_to = $row[3];
                    $notes = $row[4];

                    $stmt->bindParam(':date_from', $date_from, PDO::PARAM_STR);
                    $stmt->bindParam(':date_to', $date_to, PDO::PARAM_STR);
                    $stmt->bindParam(':notes', $notes, PDO::PARAM_STR);
                }

                $stmt->execute();
            }

            $conn->commit();
            echo 'success';
        } catch (Exception $e) {
            $conn->rollBack();
            echo 'failed: ' . $e->getMessage();
        }
    } else {
        echo 'No data to import.';
    }
} else {
    echo 'Invalid request.';
}
