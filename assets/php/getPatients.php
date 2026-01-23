<?php
include('../connection/connection.php');
header('Content-Type: application/json');

$sql = "
    SELECT
        hpatkey,
        hpatcode,
        patlast,
        patfirst,
        patmiddle,
        patbdate,
        TIMESTAMPDIFF(YEAR, patbdate, CURDATE()) AS age
    FROM hperson
    ORDER BY patlast ASC, patfirst ASC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
