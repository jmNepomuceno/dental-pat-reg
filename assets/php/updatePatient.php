<?php
include('../connection/connection.php');
header('Content-Type: application/json');

if (!isset($_POST['patient']['hpatkey'])) {
    echo json_encode(['success' => false, 'message' => 'Missing patient ID']);
    exit;
}

$p = $_POST['patient'];

try {
    $sql = "
        UPDATE hperson SET
            patlast   = :patlast,
            patfirst  = :patfirst,
            patmiddle = :patmiddle,
            patsuffix = :patsuffix,
            patalias  = :patalias,
            patbdate  = :patbdate,
            patsex    = :patsex,
            patcstat  = :patcstat,
            patempstat= :patempstat,
            natcode   = :natcode,
            relcode   = :relcode,
            hipgroup  = :hipgroup,
            bldcode   = :bldcode,
            pat_email = :pat_email,
            datemod   = NOW()
        WHERE hpatkey = :hpatkey
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':hpatkey'    => $p['hpatkey'],
        ':patlast'    => $p['basicInfo']['lastName'],
        ':patfirst'   => $p['basicInfo']['firstName'],
        ':patmiddle'  => $p['basicInfo']['middleName'],
        ':patsuffix'  => $p['basicInfo']['suffix'],
        ':patalias'   => $p['basicInfo']['alias'],
        ':patbdate'   => $p['basicInfo']['dob'],
        ':patsex'     => $p['basicInfo']['sex'],
        ':patcstat'   => $p['basicInfo']['civilStatus'],
        ':patempstat' => $p['basicInfo']['employment'],
        ':natcode'    => $p['basicInfo']['nationality'],
        ':relcode'    => $p['basicInfo']['religion'],
        ':hipgroup'   => $p['basicInfo']['indigenousGroup'],
        ':bldcode'    => $p['basicInfo']['bloodType'],
        ':pat_email'  => $p['basicInfo']['email'] ?? null
    ]);

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
