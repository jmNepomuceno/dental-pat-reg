<?php 
    include('./session.php');
    include('./assets/connection/connection.php');
    

    // $webservice = "http://192.168.42.10:8081/EmpPortal.asmx?wsdl";
    // $param = array("bioID" => 3658 , "pincode" => "030898");
    // $soap = new SOAPClient($webservice);
    // $result = $soap->GetESignature($param)->GetESignatureResult;
    // echo "<pre>"; print_r($result); echo "</pre>";

    $sql = "DESCRIBE patient_family";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<pre>'; print_r($columns); echo '</pre>';

    // $sql = "DESCRIBE patient_addresses";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute();

    // $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // print_r($columns);
    // echo '</pre>';

    // $sql = "DESCRIBE patient_emergency_contacts";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute();

    // $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // print_r($columns);
    // echo '</pre>';

    // $sql = "DESCRIBE patient_employment";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute();

    // $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // print_r($columns);
    // echo '</pre>';


    // foreach ($columns as $col) {
    //     echo $col['Field'] . "<br>";
    // }


?>


