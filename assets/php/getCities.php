<?php
include('../connection/connection.php');
header('Content-Type: application/json');

$province_code = $_GET['province_code'] ?? null;

if (!$province_code) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT municipality_code, municipality_description, ctyzipcode
        FROM city
        WHERE province_code = :province_code
        ORDER BY municipality_description";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':province_code', $province_code, PDO::PARAM_INT);
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
