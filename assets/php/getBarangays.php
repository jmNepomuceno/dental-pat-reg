<?php
include('../connection/connection.php');
header('Content-Type: application/json');

$city_code = $_GET['city_code'] ?? null;

if (!$city_code) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT 
            b.barangay_code, 
            b.barangay_description,
            c.ctyzipcode
        FROM barangay b
        JOIN city c on c.municipality_code = b.bgymuncod
        WHERE b.bgymuncod = :municipality_code
        ORDER BY b.barangay_description";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':municipality_code', $city_code, PDO::PARAM_INT);
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
