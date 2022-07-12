<?php 
session_start();
try{
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec('SET NAMES "utf8"');

    //Connection to MongoDB
    require '../../../vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $conn->CONFVIRTUAL_log->log;

    $linkRisorsaAggiuntiva = $_POST['link_risorsa_aggiuntiva'];
    $descrizioneRisorsaAggiuntiva = $_POST['descrizione_risorsa_aggiuntiva'];
    $titoloTutorial = $_POST['titolo_tutorial'];
    
    $query = "CALL inserimentoRisorsa(:lab1, :lab2, :lab3, :lab4)";
    
    $result = $con->prepare($query);       
    $result->bindValue(":lab1", $linkRisorsaAggiuntiva);
    $result->bindValue(":lab2", $descrizioneRisorsaAggiuntiva);
    $result->bindValue(":lab3", $_SESSION['username']);
    $result->bindValue(":lab4", $titoloTutorial);
    $result->execute(); 
      
    //MongoDB
    $DATA = array("LinkRisorsa" => $linkRisorsaAggiuntiva, "DescrizioneRisorsa" => $descrizioneRisorsaAggiuntiva, "UsernameUtente" => $_SESSION['username'], "TitoloTutorial" => $titoloTutorial);
    $insertOneResult = $collection->insertOne([
        'TimeStamp'         => time(),
        'User'                => $_SESSION['username'],
        'OperationType'        => 'INSERT',
        'InvolvedTable'        => 'RISORSA',
        'Input'                => $DATA
    ]);

    $con = null;
    header('Location: ../speaker_operations/Speaker.php');
} catch(PDOException $e) {
    echo "Error: " , $e -> getMessage();
}
