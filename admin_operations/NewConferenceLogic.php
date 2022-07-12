<?php
session_start();
try {
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec('SET NAMES "utf8"');

    // MongoDB
    require '../../../vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $conn->CONFVIRTUAL->log;

    $acronimo = $_POST['acronimo_conferenza'];
    $nomeConferenza = $_POST['nuova_conferenza'];
    $annoEdizione = $_POST['anno_edizione_conferenza'];
    $svoglimento = $_POST['svolgimento_conferenza'];
    $sponsorizzazioni = $_POST['sponsorizzazioni_conferenza'];
    $idProgramma = $_POST['id_programma'];
    $dataSvolgimento = $_POST['data_programma'];
    $logo = $_POST['logo_conferenza'];

    $query = "CALL creazioneConferenza(:lab1, :lab2, :lab3, :lab4, :lab5, :lab6)";
    $result = $con->prepare($query); // controlla input e prepare la query
    $result->bindValue(":lab1", $acronimo);
    $result->bindValue(":lab2", $svoglimento);
    $result->bindValue(":lab3", $logo, PDO::PARAM_LOB);
    $result->bindValue(":lab4", $nomeConferenza);
    $result->bindValue(":lab5", $annoEdizione);
    $result->bindValue(":lab6", $sponsorizzazioni);
    $result->execute();

    // MongoDB
    $DATA = array("Nome" => $nomeConferenza, "Acronimo" => $acronimo, "AnnoEdizione" => $annoEdizione, "Svolgimento" => "*ENUM*", "Sponsorizzazioni" => $sponsorizzazioni);
    $insertOneResult = $collection->insertOne([
        'TimeStamp' => time(),
        'User' => $_SESSION['username'],
        'OperationType' => 'INSERT',
        'InvolvedTable' => 'CONFERENZA',
        'Input' => $DATA
    ]);


    $creazione = ('INSERT INTO CREAZIONE(UsernameUtente, AnnoEdizione, Acronimo) VALUES(:lab1, :lab2, :lab3)');
    $result = $con->prepare($creazione);
    $result->bindValue(":lab1", $_SESSION['username']);
    $result->bindValue(":lab2", $annoEdizione);
    $result->bindValue(":lab3", $acronimo);
    $result->execute();

    // MongoDB
    $DATA = array("UsernameUtente" => $_SESSION['username'], "AnnoEdizione" => $annoEdizione, "Acronimo" => $acronimo);
    $insertOneResult = $collection->insertOne([
        'TimeStamp' => time(),
        'User' => $_SESSION['username'],
        'OperationType' => 'INSERT',
        'InvolvedTable' => 'CREAZIONE',
        'Input' => $DATA
    ]);

    $registra = "CALL registrazioneConferenza(:lab1, :lab2, :lab3)";
    $result = $con->prepare($registra);
    $result->bindValue(":lab1", $acronimo);
    $result->bindValue(":lab2", $annoEdizione);
    $result->bindValue(":lab3", $_SESSION['username']);
    $result->execute();

    // MongoDB
    $DATA = array("Acronimo" => $acronimo, "AnnoEdizione" => $annoEdizione, "UsernameUtente" => $_SESSION['username']);
    $insertOneResult = $collection->insertOne([
        'TimeStamp' => time(),
        'User' => $_SESSION['username'],
        'OperationType' => 'INSERT',
        'InvolvedTable' => 'REGISTRA',
        'Input' => $DATA
    ]);

    $programma = 'INSERT INTO PROGRAMMA(IdProgramma, Data, AnnoEdizioneProgramma, AcronimoProgramma) VALUES(:lab1, :lab2, :lab3, :lab4)';
    $result = $con->prepare($programma);
    $result->bindValue(":lab1", $idProgramma);
    $result->bindValue(":lab2", $dataSvolgimento);
    $result->bindValue(":lab3", $annoEdizione);
    $result->bindValue(":lab4", $acronimo);
    $result->execute();

    // MongoDB
    $DATA = array("IdProgramma" => $idProgramma, "DataSvolgimento" => $dataSvolgimento, "AnnoEdizione" => $annoEdizione, "Acronimo" => $acronimo);
    $insertOneResult = $collection->insertOne([
        'TimeStamp' => time(),
        'User' => $_SESSION['username'],
        'OperationType' => 'INSERT',
        'InvolvedTable' => 'PROGRAMMA',
        'Input' => $DATA
    ]);

    $con = null;
    header('Location: ../admin_operations/Admin.php');
} catch (PDOException $e) {
    echo "Error: ", $e->getMessage();
}
