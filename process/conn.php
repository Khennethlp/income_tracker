<?php
$server_month = date('Y');
date_default_timezone_set('Asia/Manila');
$servername = 'localhost'; $username = 'root'; $password = '';
// $servername = 'localhost'; $username = 'root'; $password = 'trspassword2022';

try {
    $conn = new PDO ("mysql:host=$servername;dbname=income_tracker",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'NO CONNECTION'.$e->getMessage();
}

?>