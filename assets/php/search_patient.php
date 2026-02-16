<?php
include('../connection/connection.php');
header('Content-Type: application/json');

if (!isset($_POST['search'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No search term provided'
    ]);
    exit;
}

$search = trim($_POST['search']);

try {

    $sql = "SELECT 
                hpatkey,
                hpatcode,
                patlast,
                patfirst,
                patmiddle,
                patbdate,
                patsex
            FROM hperson
            WHERE 
                patlast LIKE :search
                OR patfirst LIKE :search
                OR hpatcode LIKE :search
            ORDER BY patlast ASC
            LIMIT 20";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':search' => "%$search%"
    ]);

    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => $patients
    ]);

} catch (PDOException $e) {

    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
