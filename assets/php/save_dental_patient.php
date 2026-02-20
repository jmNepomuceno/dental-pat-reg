<?php
include('../connection/connection.php'); // adjust path if needed
header('Content-Type: application/json');

try {
    // ==========================
    // Collect & sanitize inputs
    // ==========================
    $hpatcode       = $_POST['hpatcode'] ?? '';
    $surname        = $_POST['surname'] ?? '';
    $firstName      = $_POST['firstName'] ?? '';
    $middleInitial  = $_POST['middleInitial'] ?? '';
    $dob            = $_POST['dob'] ?? null;
    $age            = !empty($_POST['age']) ? (int)$_POST['age'] : null;
    $sex            = $_POST['sex'] ?? '';
    $status         = $_POST['status'] ?? '';
    $placeOfBirth   = $_POST['placeOfBirth'] ?? '';
    $address        = $_POST['address'] ?? '';
    $occupation     = $_POST['occupation'] ?? '';
    $parentGuardian = $_POST['parentGuardian'] ?? '';

    $nhts = !empty($_POST['nhts']) ? 1 : 0;
    $p4ps = !empty($_POST['p4ps']) ? 1 : 0;
    $ip   = !empty($_POST['ip']) ? 1 : 0;
    $pwd  = !empty($_POST['pwd']) ? 1 : 0;

    $philhealth = $_POST['philhealth'] ?? '';
    $sss        = $_POST['sss'] ?? '';
    $gsis       = $_POST['gsis'] ?? '';

    // Visit-specific data
    $bp     = $_POST['bp'] ?? '';
    $pulse  = $_POST['pulse'] ?? '';
    $temp   = $_POST['temp'] ?? '';
    $weight = $_POST['weight'] ?? '';

    // Convert arrays to JSON safely
    $medHistory  = isset($_POST['medHistory'])  ? json_encode($_POST['medHistory'], JSON_UNESCAPED_UNICODE)  : json_encode([]);
    $dietary     = isset($_POST['dietary'])     ? json_encode($_POST['dietary'], JSON_UNESCAPED_UNICODE)     : json_encode([]);
    $oralCheck   = isset($_POST['oralCheck'])   ? json_encode($_POST['oralCheck'], JSON_UNESCAPED_UNICODE)   : json_encode([]);
    $oralNumbers = isset($_POST['oralNumbers']) ? json_encode($_POST['oralNumbers'], JSON_UNESCAPED_UNICODE) : json_encode([]);

    // ==========================
    // Insert or update patient
    // ==========================
    $stmt = $pdo->prepare("
        INSERT INTO dental_patients (
            hpatcode, surname, first_name, middle_initial, dob, age, sex, status,
            place_of_birth, address, occupation, parent_guardian,
            nhts, p4ps, ip, pwd,
            philhealth, sss, gsis,
            med_history, dietary
        ) VALUES (
            :hpatcode, :surname, :first_name, :middle_initial, :dob, :age, :sex, :status,
            :place_of_birth, :address, :occupation, :parent_guardian,
            :nhts, :p4ps, :ip, :pwd,
            :philhealth, :sss, :gsis,
            :med_history, :dietary
        )
        ON DUPLICATE KEY UPDATE
            surname = VALUES(surname),
            first_name = VALUES(first_name),
            middle_initial = VALUES(middle_initial),
            dob = VALUES(dob),
            age = VALUES(age),
            sex = VALUES(sex),
            status = VALUES(status),
            place_of_birth = VALUES(place_of_birth),
            address = VALUES(address),
            occupation = VALUES(occupation),
            parent_guardian = VALUES(parent_guardian),
            nhts = VALUES(nhts),
            p4ps = VALUES(p4ps),
            ip = VALUES(ip),
            pwd = VALUES(pwd),
            philhealth = VALUES(philhealth),
            sss = VALUES(sss),
            gsis = VALUES(gsis),
            med_history = VALUES(med_history),
            dietary = VALUES(dietary)
    ");

    $stmt->execute([
        ':hpatcode'       => $hpatcode,
        ':surname'        => $surname,
        ':first_name'     => $firstName,
        ':middle_initial' => $middleInitial,
        ':dob'            => $dob,
        ':age'            => $age,
        ':sex'            => $sex,
        ':status'         => $status,
        ':place_of_birth' => $placeOfBirth,
        ':address'        => $address,
        ':occupation'     => $occupation,
        ':parent_guardian'=> $parentGuardian,
        ':nhts'           => $nhts,
        ':p4ps'           => $p4ps,
        ':ip'             => $ip,
        ':pwd'            => $pwd,
        ':philhealth'     => $philhealth,
        ':sss'            => $sss,
        ':gsis'           => $gsis,
        ':med_history'    => $medHistory,
        ':dietary'        => $dietary
    ]);

    // Get patient_id from dental_patients
    $stmt = $pdo->prepare("SELECT patient_id FROM dental_patients WHERE hpatcode = :hpatcode");
    $stmt->execute([':hpatcode' => $hpatcode]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $patientId = $row['patient_id'] ?? null;

    // ==========================
    // Insert dental visit if data exists
    // ==========================
    $visitId = null;
    if (!empty($_POST['oralCheck']) || !empty($_POST['oralNumbers']) || !empty($bp)) {
        $stmt = $pdo->prepare("
            INSERT INTO dental_visits (
                hpatcode, visit_date,
                bp, pulse, temp, weight,
                oral_check, oral_numbers
            ) VALUES (
                :hpatcode, NOW(),
                :bp, :pulse, :temp, :weight,
                :oral_check, :oral_numbers
            )
        ");
        $stmt->execute([
            ':hpatcode'     => $hpatcode,
            ':bp'           => $bp,
            ':pulse'        => $pulse,
            ':temp'         => $temp,
            ':weight'       => $weight,
            ':oral_check'   => $oralCheck,
            ':oral_numbers' => $oralNumbers
        ]);

        $visitId = $pdo->lastInsertId();
    }

    echo json_encode([
        'success'    => true,
        'patient_id' => $patientId,
        'hpatcode'   => $hpatcode,
        'visit_id'   => $visitId,
        'message'    => 'Patient and visit data saved successfully.'
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
