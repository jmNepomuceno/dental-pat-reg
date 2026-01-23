<?php
include('../connection/connection.php');
header('Content-Type: application/json');

$hpatkey = $_GET['hpatkey'] ?? null;

if (!$hpatkey) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT *
        FROM hperson
        WHERE hpatkey = :hpatkey
        LIMIT 1";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':hpatkey', $hpatkey, PDO::PARAM_INT);
$stmt->execute();

echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
