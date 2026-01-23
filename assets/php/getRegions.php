<?php
include('../connection/connection.php');
header('Content-Type: application/json');

$sql = "
    SELECT region_code, region_description
    FROM regions
    ORDER BY region_code ASC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
