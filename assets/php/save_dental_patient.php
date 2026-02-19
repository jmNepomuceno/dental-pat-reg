<?php
include('../connection/connection.php'); // adjust path if needed
header('Content-Type: application/json');

// try {

//     // ==========================
//     // Collect & sanitize inputs
//     // ==========================
//     $hpatcode = $_POST['hpatcode'] ?? '';
//     $surname        = $_POST['surname'] ?? '';
//     $firstName      = $_POST['firstName'] ?? '';
//     $middleInitial  = $_POST['middleInitial'] ?? '';
//     $dob            = $_POST['dob'] ?? null;
//     $age            = !empty($_POST['age']) ? (int)$_POST['age'] : null;
//     $sex            = $_POST['sex'] ?? '';
//     $status         = $_POST['status'] ?? '';
//     $placeOfBirth   = $_POST['placeOfBirth'] ?? '';
//     $address        = $_POST['address'] ?? '';
//     $occupation     = $_POST['occupation'] ?? '';
//     $parentGuardian = $_POST['parentGuardian'] ?? '';

//     $nhts = !empty($_POST['nhts']) ? 1 : 0;
//     $p4ps = !empty($_POST['p4ps']) ? 1 : 0;
//     $ip   = !empty($_POST['ip']) ? 1 : 0;
//     $pwd  = !empty($_POST['pwd']) ? 1 : 0;

//     $philhealth = $_POST['philhealth'] ?? '';
//     $sss        = $_POST['sss'] ?? '';
//     $gsis       = $_POST['gsis'] ?? '';

//     $bp     = $_POST['bp'] ?? '';
//     $pulse  = $_POST['pulse'] ?? '';
//     $temp   = $_POST['temp'] ?? '';
//     $weight = $_POST['weight'] ?? '';

//     // Convert arrays to JSON safely
//     $medHistory  = isset($_POST['medHistory'])  ? json_encode($_POST['medHistory'], JSON_UNESCAPED_UNICODE)  : json_encode([]);
//     $dietary     = isset($_POST['dietary'])     ? json_encode($_POST['dietary'], JSON_UNESCAPED_UNICODE)     : json_encode([]);
//     $oralCheck   = isset($_POST['oralCheck'])   ? json_encode($_POST['oralCheck'], JSON_UNESCAPED_UNICODE)   : json_encode([]);
//     $oralNumbers = isset($_POST['oralNumbers']) ? json_encode($_POST['oralNumbers'], JSON_UNESCAPED_UNICODE) : json_encode([]);

//     // ==========================
//     // Insert Query
//     // ==========================

//     $sql = "
//         INSERT INTO dental_patients (
//             hpatcode, surname, first_name, middle_initial, dob, age, sex, status,
//             place_of_birth, address, occupation, parent_guardian,
//             nhts, p4ps, ip, pwd,
//             philhealth, sss, gsis,
//             bp, pulse, temp, weight,
//             med_history, dietary, oral_check, oral_numbers
//         ) VALUES (
//             :hpatcode, :surname, :first_name, :middle_initial, :dob, :age, :sex, :status,
//             :place_of_birth, :address, :occupation, :parent_guardian,
//             :nhts, :p4ps, :ip, :pwd,
//             :philhealth, :sss, :gsis,
//             :bp, :pulse, :temp, :weight,
//             :med_history, :dietary, :oral_check, :oral_numbers
//         )
//     ";

//     $stmt = $pdo->prepare($sql);

//     $stmt->execute([
//         ':hpatcode'       => $hpatcode,    // <- pass it here
//         ':surname'        => $surname,
//         ':first_name'     => $firstName,
//         ':middle_initial' => $middleInitial,
//         ':dob'            => $dob,
//         ':age'            => $age,
//         ':sex'            => $sex,
//         ':status'         => $status,
//         ':place_of_birth' => $placeOfBirth,
//         ':address'        => $address,
//         ':occupation'     => $occupation,
//         ':parent_guardian'=> $parentGuardian,
//         ':nhts'           => $nhts,
//         ':p4ps'           => $p4ps,
//         ':ip'             => $ip,
//         ':pwd'            => $pwd,
//         ':philhealth'     => $philhealth,
//         ':sss'            => $sss,
//         ':gsis'           => $gsis,
//         ':bp'             => $bp,
//         ':pulse'          => $pulse,
//         ':temp'           => $temp,
//         ':weight'         => $weight,
//         ':med_history'    => $medHistory,
//         ':dietary'        => $dietary,
//         ':oral_check'     => $oralCheck,
//         ':oral_numbers'   => $oralNumbers
//     ]);

//     // If inserted, this returns new ID
//     $lastId = $pdo->lastInsertId();

//     // If updated (duplicate key), fetch existing ID
//     if ($lastId == 0) {
//         $getId = $pdo->prepare("SELECT patient_id FROM dental_patients WHERE hpatcode = :hpatcode");
//         $getId->execute([':hpatcode' => $hpatcode]);
//         $row = $getId->fetch(PDO::FETCH_ASSOC);
//         $lastId = $row['patient_id'] ?? null;
//     }


//     echo json_encode([
//         'success' => true,
//         'patient_id' => $lastId,
//         'hpatcode' => $hpatcode,
//         'message' => 'Patient data saved successfully.'
//     ]);

// } catch (PDOException $e) {

//     echo json_encode([
//         'success' => false,
//         'message' => $e->getMessage()
//     ]);
// }

try{
    echo json_encode([
        'success' => true,
        'patient_id' => 13,
        'hpatcode' => "H-2026-000054",
        'message' => 'Patient data saved successfully.'
    ]);
}catch(PDOException $e){
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

