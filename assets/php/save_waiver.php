<?php
include('../connection/connection.php');
header('Content-Type: application/json');

// Basic validation
if (!isset($_POST['patient_id']) || !isset($_POST['hpatcode'])) {
    echo json_encode(['success' => false, 'message' => 'Missing patient ID or HPAT code']);
    exit;
}

try {
    // Collect main data
    $patient_id   = $_POST['patient_id'];
    $hpatcode     = $_POST['hpatcode'];
    $signed_by    = $_POST['signed_by'] ?? null;
    $signed_date  = $_POST['signed_date'] ?? date('Y-m-d H:i:s');
    $witness_name  = $_POST['witness_name'] ?? null;

    

    // Yes/No questions
    $q1 = $_POST['q1'] ?? null;
    $q2 = $_POST['q2'] ?? null;
    $q3 = $_POST['q3'] ?? null;
    $q4 = $_POST['q4'] ?? null;
    $q5 = $_POST['q5'] ?? null;
    $q6 = $_POST['q6'] ?? null;
    $q7 = $_POST['q7'] ?? null;
    $q8 = $_POST['q8'] ?? null;
    $q9 = $_POST['q9'] ?? null;

    // Conditions (JSON-encoded)
    $conditions = isset($_POST['conditions']) ? $_POST['conditions'] : null;

    // Optional patient info
    $age     = $_POST['age'] ?? null;
    $address = $_POST['address'] ?? null;

    // Check if waiver already exists for this patient
    $stmt = $pdo->prepare("SELECT waiver_id FROM dental_waivers WHERE patient_id = :patient_id");
    $stmt->execute([':patient_id' => $patient_id]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        // Update existing waiver
        $sql = "UPDATE dental_waivers SET
                    hpatcode   = :hpatcode,
                    signed_by  = :signed_by,
                    signed_date= :signed_date,
                    witness = :witness_name,
                    q1 = :q1, q2 = :q2, q3 = :q3, q4 = :q4, q5 = :q5,
                    q6 = :q6, q7 = :q7, q8 = :q8, q9 = :q9,
                    conditions = :conditions,
                    age = :age,
                    address = :address,
                    updated_at = NOW()
                WHERE waiver_id = :waiver_id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':waiver_id' => $existing['waiver_id'],
            ':hpatcode'  => $hpatcode,
            ':signed_by' => $signed_by,
            ':signed_date'=> $signed_date,
            ':witness_name'=> $witness_name,
            ':q1'=> $q1, ':q2'=> $q2, ':q3'=> $q3, ':q4'=> $q4, ':q5'=> $q5,
            ':q6'=> $q6, ':q7'=> $q7, ':q8'=> $q8, ':q9'=> $q9,
            ':conditions'=> $conditions,
            ':age'=> $age,
            ':address'=> $address
        ]);

    } else {
        // Insert new waiver
        $sql = "INSERT INTO dental_waivers
                    (patient_id, hpatcode, signed_by, signed_date, witness,
                     q1,q2,q3,q4,q5,q6,q7,q8,q9, conditions, age, address, created_at)
                VALUES
                    (:patient_id, :hpatcode, :signed_by, :signed_date, :witness_name,
                     :q1,:q2,:q3,:q4,:q5,:q6,:q7,:q8,:q9, :conditions, :age, :address, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':patient_id'=> $patient_id,
            ':hpatcode' => $hpatcode,
            ':signed_by'=> $signed_by,
            ':signed_date'=> $signed_date,
            ':witness_name'=> $witness_name,
            ':q1'=> $q1, ':q2'=> $q2, ':q3'=> $q3, ':q4'=> $q4, ':q5'=> $q5,
            ':q6'=> $q6, ':q7'=> $q7, ':q8'=> $q8, ':q9'=> $q9,
            ':conditions'=> $conditions,
            ':age'=> $age,
            ':address'=> $address
        ]);
    }

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
