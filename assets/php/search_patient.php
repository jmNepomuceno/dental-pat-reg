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

    // ==============================
    // Fetch main patient info
    // ==============================
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

    // ==============================
    // Fetch related data per patient
    // ==============================
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
            $rel = strtolower($f['relation']);
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

        // ==============================
        // Dental Section
        // ==============================

        // 1️⃣ Fetch dental patient info
        $stmtDentalPatient = $pdo->prepare("
            SELECT * FROM dental_patients
            WHERE hpatcode = :hpatcode
            LIMIT 1
        ");
        $stmtDentalPatient->execute([':hpatcode' => $p['hpatcode']]);
        $dentalPatient = $stmtDentalPatient->fetch(PDO::FETCH_ASSOC);

        if ($dentalPatient) {

            // Decode patient-level JSON fields
            $dentalPatient['med_history'] = json_decode($dentalPatient['med_history'] ?? '[]', true);
            $dentalPatient['dietary']     = json_decode($dentalPatient['dietary'] ?? '[]', true);

            // 2️⃣ Fetch ALL dental visits
            $stmtVisits = $pdo->prepare("
                SELECT visit_id, visit_date, bp, pulse, temp, weight,
                       oral_check, oral_numbers
                FROM dental_visits
                WHERE hpatcode = :hpatcode
                ORDER BY visit_date
            ");
            $stmtVisits->execute([':hpatcode' => $p['hpatcode']]);
            $visits = $stmtVisits->fetchAll(PDO::FETCH_ASSOC);

            // Decode visit JSON fields
            foreach ($visits as &$v) {
                $v['oral_check']   = json_decode($v['oral_check'] ?? '[]', true);
                $v['oral_numbers'] = json_decode($v['oral_numbers'] ?? '[]', true);
            }

            $p['dental'] = [
                'patient_info' => $dentalPatient,
                'visits'       => $visits
            ];

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
