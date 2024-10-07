<?php
session_name("income_tracker");
session_start();

include 'conn.php';

$title = "Income Tracker";

if (isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password_hash = '$password'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach ($stmt->fetchALL() as $x) {
            $id = $x['id'];
            $name = $x['fullname'];
            $username = $x['username'];

            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;

            if ($_SESSION['username'] == $username) {
                header('location: page/admin/index.php'); // admin/index.php
                exit;
            }
        }
    } else {
        // echo '<script>alert("Sign In Failed. Maybe an incorrect credential or account not found")</script>';
        $_SESSION['status'] = 'error';
        $_SESSION['msg'] = 'Sign In Failed. Please try again.';
    }
}

if (isset($_POST['Logout'])) {
    session_unset();
    session_destroy();
    header('Location: /income/index.php');
    exit;
}
