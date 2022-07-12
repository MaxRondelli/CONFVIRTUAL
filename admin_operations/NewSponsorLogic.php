<?php
session_start();

try{
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');             
    $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    $con -> exec('SET NAMES "utf8"');

    // MongoDB
    require '../../../vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $conn->CONFVIRTUAL->log;
    
    $nomeSponsor = $_POST['nome_sponsor'];
    $importoSponsor = $_POST['importo_sponsor'];
    $logoSponsor = $_POST['logo_sponsor'];

    $query = 'INSERT INTO SPONSOR(Nome, Logo, Importo) VALUES(:lab1, :lab2, :lab3)';
    $result = $con -> prepare($query);

    $result -> bindValue(":lab1", $nomeSponsor);
    $result -> bindValue(":lab2", $logoSponsor, PDO::PARAM_LOB);
    $result -> bindValue(":lab3", $importoSponsor);
    $result -> execute();
    
    // MongoDB
    $DATA = array("NomeSponsor" => $nomeSponsor, "LogoSponsor" => $logoSponsor, "ImportoSponsor" => $importoSponsor);
    $insertOneResult = $collection -> insertOne([
        'TimeStamp' => time(),
        'User' => $_SESSION['username'],
        'OperationType' => 'INSERT',
        'InvolvedTable' => 'SPONSOR',
        'Input' => $DATA
    ]);

    $con = null;
    header('Location: ../admin_operations/Admin.php');
} catch(PDOException $e) {
    echo "Error: " , $e -> getMessage();
}
?>