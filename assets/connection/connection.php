<?php
  $dbHost = "localhost";
  $dbUser = "root";
  $dbPassword = "password";
  $dbName = "dental_pat_reg";

  try {
    $pdo = new PDO(
        "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4",
        $dbUser,
        $dbPassword,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        ]
    );
} catch (PDOException $e) {
    die("DB Connection Failed: " . $e->getMessage());
}
?>