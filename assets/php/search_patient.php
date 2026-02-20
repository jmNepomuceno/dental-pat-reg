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

    // Fetch main patient info
    $sql = "SELECT 
                h.hpatkey,
                h.hpatcode,
                h.patlast,
                h.patfirst,
                h.patmiddle,
                h.patsuffix,
                h.patalias,
                h.patbdate,
                h.patsex,
                h.patcstat AS status,
                h.patbplace,
                h.patempstat AS occupation
            FROM hperson h
            WHERE 
                h.patlast LIKE :search
                OR h.patfirst LIKE :search
                OR h.hpatcode LIKE :search
            ORDER BY h.patlast ASC
            LIMIT 20";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':search' => "%$search%"]);
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch related data for each patient
    foreach ($patients as &$p) {

        // Address
        $stmtAddr = $pdo->prepare("
            SELECT a.*, 
                   r.region_description AS region_name,
                   pr.province_description AS province_name,
                   c.municipality_description AS city_name,
                   b.barangay_description AS barangay_name
            FROM patient_addresses a
            LEFT JOIN regions r ON a.region = r.region_code
            LEFT JOIN provinces pr ON a.province = pr.province_code
            LEFT JOIN city c ON a.city = c.municipality_code
            LEFT JOIN barangay b ON a.barangay = b.barangay_code
            WHERE a.hpatkey = :hpatkey AND a.addr_type = 'PRESENT'
            LIMIT 1
        ");
        $stmtAddr->execute([':hpatkey' => $p['hpatkey']]);
        $p['address'] = $stmtAddr->fetch(PDO::FETCH_ASSOC);

        // Family
        $stmtFam = $pdo->prepare("SELECT * FROM patient_family WHERE hpatkey = :hpatkey");
        $stmtFam->execute([':hpatkey' => $p['hpatkey']]);
        $family = $stmtFam->fetchAll(PDO::FETCH_ASSOC);
        $p['family'] = [];
        foreach ($family as $f) {
            $rel = strtolower($f['relation']); // father, mother, guardian
            $p['family'][$rel] = $f;
        }

        // Emergency Contact
        $stmtEmc = $pdo->prepare("SELECT * FROM patient_emergency_contacts WHERE hpatkey = :hpatkey LIMIT 1");
        $stmtEmc->execute([':hpatkey' => $p['hpatkey']]);
        $p['emergency_contact'] = $stmtEmc->fetch(PDO::FETCH_ASSOC);

        // Employment
        $stmtEmp = $pdo->prepare("SELECT * FROM patient_employment WHERE hpatkey = :hpatkey LIMIT 1");
        $stmtEmp->execute([':hpatkey' => $p['hpatkey']]);
        $p['employment'] = $stmtEmp->fetch(PDO::FETCH_ASSOC);

        // Dental: fetch dental patient and latest visit
        $stmtDental = $pdo->prepare("
            SELECT dp.*, dv.visit_id, dv.visit_date, dv.bp, dv.pulse, dv.temp, dv.weight,
                   dv.oral_check, dv.oral_numbers
            FROM dental_patients dp
            LEFT JOIN dental_visits dv ON dp.hpatcode = dv.hpatcode
            WHERE dp.hpatcode = :hpatcode
            ORDER BY dv.visit_date DESC
            LIMIT 1
        ");
        $stmtDental->execute([':hpatcode' => $p['hpatcode']]);
        $dental = $stmtDental->fetch(PDO::FETCH_ASSOC);

        if ($dental) {
            // Decode JSON columns
            $dental['oral_check']   = json_decode($dental['oral_check'] ?? '[]', true);
            $dental['oral_numbers'] = json_decode($dental['oral_numbers'] ?? '[]', true);
            $dental['med_history']  = json_decode($dental['med_history'] ?? '[]', true);
            $dental['dietary']      = json_decode($dental['dietary'] ?? '[]', true);
            $p['dental'] = $dental;
        } else {
            $p['dental'] = null;
        }
    }

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
