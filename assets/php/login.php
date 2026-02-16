<?php
include('../../session.php');
include('../../assets/connection/connection.php');

$webservice = "http://192.168.42.10:8081/EmpPortal.asmx?wsdl";

if (isset($_POST["username"]) && isset($_POST["password"]) && trim($_POST["username"]) != "" && $_POST["password"] != "") {
    $biousername = $_POST["username"];
    $password = $_POST["password"];
    $param = array("bioUserName" => $biousername, "password" => $password, "accessMode" => 0);
    
    $soap = new SOAPClient($webservice);
    $result = $soap->AuthenticateEmployee($param)->AuthenticateEmployeeResult;

    $code = $result->Code;
    $canAccess = $result->CanAccess;
    $errorMessage = $result->Message;
    $userType = $result->UserType;


    if ($canAccess == 1) {
        if (isset($result->Account)) {
            $account = $result->Account;
            $name = $account->FirstName . " " . substr($account->MiddleName, 0, 1) . ". " . $account->LastName;

            $_SESSION["user"] = $account->BiometricID;          
            $_SESSION["name"] = $account->FullName;
            $_SESSION["section"] = $account->Section;
            $_SESSION["positionName"] = $account->PositionName;
            $_SESSION["sectionName"] = "";
            $_SESSION["divisionName"] = "";
            $_SESSION["division"] = $account->Division; 
            $_SESSION["password"] = $password;     
            $_SESSION["Authorized"] = "Yes";
            $_SESSION["role"] = "";

            // Insert SUCCESS log
            // $stmt = $pdo->prepare("INSERT INTO login_logs (username, login_status, bioID) VALUES (:username, :status, :bioID)");
            // $stmt->execute([
            //     ':username' => $account->FullName,
            //     ':status' => 'SUCCESS',
            //     ':bioID' => $account->BiometricID
            // ]);

            // echo json_encode($_SESSION);
            echo "/public/home.php";
        }
    }
    else {
        // Insert FAILED log
        // $stmt = $pdo->prepare("INSERT INTO login_logs (username, login_status) VALUES (:username, :status)");
        // $stmt->execute([
        //     ':username' => $biousername,
        //     ':status' => 'FAILED'
        // ]);
        echo "invalid";
    }

}
else {
    echo "invalid";
}


?>