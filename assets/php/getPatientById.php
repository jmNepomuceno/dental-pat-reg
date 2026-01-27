<?php
include('../connection/connection.php');
header('Content-Type: application/json');

$hpatkey = $_GET['hpatkey'] ?? null;

if (!$hpatkey) {
    echo json_encode([]);
    exit;
}

/* ===================== GET HPERSON ===================== */
$sql = "SELECT *
        FROM hperson
        WHERE hpatkey = :hpatkey
        LIMIT 1";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':hpatkey', $hpatkey, PDO::PARAM_INT);
$stmt->execute();
$person = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$person) {
    echo json_encode([]);
    exit;
}

/* ===================== GET FAMILY ===================== */
$sqlFam = "SELECT *
           FROM patient_family
           WHERE hpatkey = :hpatkey";

$stmt = $pdo->prepare($sqlFam);
$stmt->execute([':hpatkey' => $hpatkey]);
$familyRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* Predefine expected structure */
$family = [
    'father' => null,
    'mother' => null,
    'spouse' => null
];

foreach ($familyRows as $row) {

    // Normalize relation value (trim + uppercase)
    $relation = strtoupper(trim($row['relation']));

    switch ($relation) {

        case 'FATHER':
            $family['father'] = [
                'lastName'   => $row['lastname'] ?: null,
                'firstName'  => $row['firstname'] ?: null,
                'middleName' => $row['middlename'] ?: null,
                'suffix'     => $row['suffix'] ?: null,
                'address'    => $row['address'] ?: null,
                'mobile'     => $row['telno'] ?: null,
                'sex'        => $row['sex'] ?: null,
                'deceased'   => (bool)$row['deceased']
            ];
            break;

        case 'MOTHER':
            $family['mother'] = [
                'lastName'   => $row['lastname'] ?: null,
                'firstName'  => $row['firstname'] ?: null,
                'middleName' => $row['middlename'] ?: null,
                'suffix'     => $row['suffix'] ?: null,
                'address'    => $row['address'] ?: null,
                'mobile'     => $row['telno'] ?: null,
                'sex'        => $row['sex'] ?: null,
                'deceased'   => (bool)$row['deceased']
            ];
            break;

        case 'SPOUSE':
            // Ignore empty spouse rows (common in forms)
            if (
                !empty($row['lastname']) ||
                !empty($row['firstname']) ||
                !empty($row['middlename']) ||
                !empty($row['telno'])
            ) {
                $family['spouse'] = [
                    'lastName'   => $row['lastname'] ?: null,
                    'firstName'  => $row['firstname'] ?: null,
                    'middleName' => $row['middlename'] ?: null,
                    'suffix'     => $row['suffix'] ?: null,
                    'address'    => $row['address'] ?: null,
                    'mobile'     => $row['telno'] ?: null,
                    'sex'        => $row['sex'] ?: null,
                    'deceased'   => (bool)$row['deceased']
                ];
            }
            break;

        default:
            // silently ignore unknown relations
            break;
    }
}


/* ===================== GET ADDRESSES ===================== */
$sqlAddr = "SELECT *
            FROM patient_addresses
            WHERE hpatkey = :hpatkey";

$stmt = $pdo->prepare($sqlAddr);
$stmt->execute([':hpatkey' => $hpatkey]);
$addrRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$address = [
    'present'   => null,
    'permanent' => null
];

foreach ($addrRows as $row) {
    $key = strtolower($row['addr_type']); // PRESENT / PERMANENT
    $address[$key] = [
        'unit'      => $row['unit'],
        'bldg'      => $row['bldg'],
        'lot'       => $row['lot'],
        'subd'      => $row['subd'],
        'barangay'  => $row['barangay'],
        'city'      => $row['city'],
        'province'  => $row['province'],
        'region'    => $row['region'],
        'district'  => $row['district'],
        'zip'       => $row['zipcode'],
        'country'   => $row['country']
    ];
}

/* ===================== GET EMERGENCY CONTACT ===================== */
$sqlEmc = "SELECT *
           FROM patient_emergency_contacts
           WHERE hpatkey = :hpatkey
           LIMIT 1";

$stmt = $pdo->prepare($sqlEmc);
$stmt->execute([':hpatkey' => $hpatkey]);
$emc = $stmt->fetch(PDO::FETCH_ASSOC);

/* ===================== FINAL RESPONSE ===================== */
$response = [
    'hpatkey' => $person['hpatkey'],

    'identifiers' => [
        'healthRecNo'   => $person['hpatcode'],
        'philDigitalID'=> $person['upicode'],
        'philID'        => $person['Client_DOHID'],
        'seniorNo'      => $person['srcitizen'],
        'mssNo'         => $person['mssno']
    ],

    'basicInfo' => [
        'lastName'        => $person['patlast'],
        'firstName'       => $person['patfirst'],
        'middleName'      => $person['patmiddle'],
        'suffix'          => $person['patsuffix'],
        'alias'           => $person['patalias'],
        'dob'             => $person['patbdate'],
        'birthPlace'      => $person['patbplace'],
        'sex'             => $person['patsex'],
        'civilStatus'     => $person['patcstat'],
        'employment'      => $person['patempstat'],
        'nationality'     => $person['natcode'],
        'religion'        => $person['relcode'],
        'indigenousGroup' => $person['hipgroup'],
        'bloodType'       => $person['bldcode'],
        'email'           => $person['pat_email']
    ],

    'family' => array_merge($family, [
        'contactPerson' => $emc ? [
            'name'     => $emc['patemernme'],
            'address'  => $emc['patemaddr'],
            'mobile'   => $emc['pattelno'],
            'relation' => $emc['relemacode']
        ] : null
    ]),

    'address' => $address
];

echo json_encode($response);
