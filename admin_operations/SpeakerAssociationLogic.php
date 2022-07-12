<?php 
session_start();

try{
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec('SET NAMES "utf8"');

    // MongoDB
    require '../../../vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $conn->CONFVIRTUAL->log;

    $usernameSpeaker = $_POST['username_speaker'];
    $codicePresentazione = $_POST['codice_presentazione_tutorial'];

    $query = "CALL associazioneSpeaker(:lab1, :lab2)";

    $result = $con->prepare($query); 
    $result->bindValue(":lab1", $usernameSpeaker);
    $result->bindValue(":lab2", $codicePresentazione);
    $result->execute();

    //MongoDB
    $DATA = array("UsernameSpeaker"=>$usernameSpeaker, "CodiceTutorial"=>$codicePresentazione);
    $insertOneResult = $collection->insertOne([
        'TimeStamp' 		=> time(),
        'User'				=> $_SESSION['username'],
        'OperationType'		=> 'INSERT',
        'InvolvedTable'	    => 'PRESENTA',
        'Input'				=> $DATA
    ]);
    
    $con = null;
    header('Location: ../admin_operations/Admin.php');
} catch(PDOException $e) {
    echo "Error: " , $e -> getMessage();
}
