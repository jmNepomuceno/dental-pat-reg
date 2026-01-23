<?php
include('../connection/connection.php');
header('Content-Type: application/json');

$region_code = $_GET['region_code'] ?? null;

if (!$region_code) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT province_code, province_description
        FROM provinces
        WHERE region_code = :region_code
        ORDER BY province_description";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':region_code', $region_code, PDO::PARAM_INT);
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
