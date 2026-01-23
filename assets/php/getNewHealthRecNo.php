<?php
include('../connection/connection.php');
header('Content-Type: application/json');

try {
    // Get last patient key
    $sql = "SELECT MAX(hpatkey) AS last_id FROM hperson";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $nextId = ($row['last_id'] ?? 0) + 1;

    // Format: H-YYYY-000001
    $healthRecNo = 'H-' . date('Y') . '-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);

    echo json_encode([
        'healthRecNo' => $healthRecNo
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Failed to generate Health Record Number'
    ]);
}
