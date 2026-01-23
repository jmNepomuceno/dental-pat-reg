<?php
include('../connection/connection.php');
header('Content-Type: application/json');

if (!isset($_POST['patient'])) {
    echo json_encode(['success' => false, 'message' => 'No patient data received']);
    exit;
}

$patient = $_POST['patient'];


$hpatcode = $patient['identifiers']['healthRecNo'] ?? null;

if (empty($hpatcode)) {
    $stmt = $pdo->query("SELECT MAX(hpatkey) AS last_id FROM hperson");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nextId = ($row['last_id'] ?? 0) + 1;

    $hpatcode = 'H-' . date('Y') . '-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
}


try {
    $pdo->beginTransaction();

    // ===================== INSERT HPERSON =====================
    $sql = "INSERT INTO hperson (
        hpatcode, upicode, Client_DOHID, dohid, srcitizen, mssno,
        patlast, patfirst, patmiddle, patsuffix, patalias,
        patbdate, patbplace, patsex, patcstat, patempstat,
        natcode, relcode, hipgroup, bldcode, pat_email,
        patstat, entryby, created_at, confdl
    ) VALUES (
        :hpatcode, :upicode, :Client_DOHID, :dohid, :srcitizen, :mssno,
        :patlast, :patfirst, :patmiddle, :patsuffix, :patalias,
        :patbdate, :patbplace, :patsex, :patcstat, :patempstat,
        :natcode, :relcode, :hipgroup, :bldcode, :pat_email,
        :patstat, :entryby, NOW(), :confdl
    )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        // ================= IDENTIFIERS =================
        ':hpatcode'      => $patient['identifiers']['healthRecNo'] ?? null,
        ':upicode'       => $patient['identifiers']['philDigitalID'] ?? null,
        ':Client_DOHID'  => $patient['identifiers']['philID'] ?? null,
        ':dohid'         => null,
        ':srcitizen'     => $patient['identifiers']['seniorNo'] ?? null,
        ':mssno'         => $patient['identifiers']['mssNo'] ?? null,

        // ================= BASIC INFO =================
        ':patlast'       => $patient['basicInfo']['lastName'] ?? null,
        ':patfirst'      => $patient['basicInfo']['firstName'] ?? null,
        ':patmiddle'     => $patient['basicInfo']['middleName'] ?? null,
        ':patsuffix'     => $patient['basicInfo']['suffix'] ?? null,
        ':patalias'      => $patient['basicInfo']['alias'] ?? null,

        ':patbdate'      => $patient['basicInfo']['dob'] ?? null,
        ':patbplace'     => $patient['basicInfo']['birthPlace'] ?? null,
        ':patsex'        => $patient['basicInfo']['sex'] ?? null,
        ':patcstat'      => $patient['basicInfo']['civilStatus'] ?? null,
        ':patempstat'    => $patient['basicInfo']['employment'] ?? null,

        ':natcode'       => $patient['basicInfo']['nationality'] ?? null,
        ':relcode'       => $patient['basicInfo']['religion'] ?? null,
        ':hipgroup'      => $patient['basicInfo']['indigenousGroup'] ?? null,
        ':bldcode'       => $patient['basicInfo']['bloodType'] ?? null,
        ':pat_email'     => $patient['basicInfo']['email'] ?? null,

        // ================= SYSTEM =================
        ':patstat'       => 'A',
        ':entryby'       => 'SYSTEM',
        ':confdl'        => 0
    ]);

    // get the inserted hperson ID
    $hpatkey = $pdo->lastInsertId();

    // ===================== INSERT FAMILY =====================
    $familyMembers = ['father', 'mother', 'spouse'];
    foreach ($familyMembers as $relation) {
        $fam = $patient['family'][$relation] ?? null;
        if ($fam) {
            $sqlFam = "INSERT INTO hperson_family (
                hpatkey, relation, lastname, firstname, middlename, suffix, address, telno, phicnum, birthdate, sex, deceased
            ) VALUES (
                :hpatkey, :relation, :lastname, :firstname, :middlename, :suffix, :address, :telno, :phicnum, :birthdate, :sex, :deceased
            )";
            $stmt = $pdo->prepare($sqlFam);
            $stmt->execute([
                ':hpatkey'   => $hpatkey,
                ':relation'  => strtoupper($relation),
                ':lastname'  => $fam['lastName'] ?? null,
                ':firstname' => $fam['firstName'] ?? null,
                ':middlename'=> $fam['middleName'] ?? null,
                ':suffix'    => $fam['suffix'] ?? null,
                ':address'   => $fam['address'] ?? null,
                ':telno'     => $fam['mobile'] ?? null,
                ':phicnum'   => null,
                ':birthdate' => null,
                ':sex'       => $fam['sex'] ?? null,
                ':deceased'  => $fam['deceased'] ?? 0
            ]);
        }
    }

    // ===================== INSERT ADDRESSES =====================
    foreach (['present','permanent'] as $addrType) {
        $addr = $patient['address'][$addrType] ?? null;
        if ($addr) {
            $sqlAddr = "INSERT INTO hperson_address (
                hpatkey, addr_type, unit, bldg, lot, subd, barangay, city, province, region, district, zipcode, country
            ) VALUES (
                :hpatkey, :addr_type, :unit, :bldg, :lot, :subd, :barangay, :city, :province, :region, :district, :zipcode, :country
            )";
            $stmt = $pdo->prepare($sqlAddr);
            $stmt->execute([
                ':hpatkey'   => $hpatkey,
                ':addr_type' => strtoupper($addrType),
                ':unit'      => $addr['unit'] ?? null,
                ':bldg'      => $addr['bldg'] ?? null,
                ':lot'       => $addr['lot'] ?? null,
                ':subd'      => $addr['subd'] ?? null,
                ':barangay'  => $addr['barangay'] ?? null,
                ':city'      => $addr['city'] ?? null,
                ':province'  => $addr['province'] ?? null,
                ':region'    => $addr['region'] ?? null,
                ':district'  => $addr['district'] ?? null,
                ':zipcode'   => $addr['zip'] ?? null,
                ':country'   => $addr['country'] ?? null
            ]);
        }
    }

    // ===================== INSERT EMERGENCY CONTACT =====================
    $emc = $patient['family']['contactPerson'] ?? null;
    if ($emc) {
        $sqlEmc = "INSERT INTO hperson_emergency (
            hpatkey, patemernme, patemaddr, pattelno, relemacode
        ) VALUES (
            :hpatkey, :patemernme, :patemaddr, :pattelno, :relemacode
        )";
        $stmt = $pdo->prepare($sqlEmc);
        $stmt->execute([
            ':hpatkey'     => $hpatkey,
            ':patemernme'  => $emc['name'] ?? null,
            ':patemaddr'   => $emc['address'] ?? null,
            ':pattelno'    => $emc['mobile'] ?? null,
            ':relemacode'  => $emc['relation'] ?? null
        ]);
    }

    $pdo->commit();

    echo json_encode(['success'=>true,'message'=>'Patient saved successfully']);

} catch (PDOException $e) {
    $pdo->rollBack();
    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}


catch (PDOException $e) {
    $pdo->rollBack();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
