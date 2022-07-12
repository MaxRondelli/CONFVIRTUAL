<?php
session_start();

try {
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec('SET NAMES "utf8"');

    //Connection to MongoDB
    require '../../../vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $conn->CONFVIRTUAL_log->log;

    $acronimoConferenza = $_POST['acronimo_conferenza'];
    $annoEdizioneConferenza = $_POST['anno_edizione_conferenza'];

    $query = "CALL registrazioneConferenza(:lab1, :lab2, :lab3)";

    $result = $con->prepare($query);
    $result->bindValue(":lab1", $acronimoConferenza);
    $result->bindValue(":lab2", $annoEdizioneConferenza);
    $result->bindValue(":lab3", $_SESSION['username']);
    $result->execute();

    //MongoDB
    $DATA = array("UsernameUtente" => $_SESSION['username'], "AnnoEdizione" => $annoEdizioneConferenza, "AcronimoConferenza" => $acronimoConferenza);
    $insertOneResult = $collection->insertOne([
        'TimeStamp'         => time(),
        'User'                => $_SESSION['username'],
        'OperationType'        => 'INSERT',
        'InvolvedTable'        => 'REGISTRA',
        'Input'                => $DATA
    ]);

    $con = null;
    header('Location: ../speaker_operations/Speaker.php');
} catch (PDOException $e) {
    echo "Error: ", $e->getMessage();
}
