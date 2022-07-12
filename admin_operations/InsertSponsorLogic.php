<?php
session_start();

try {
    // Connection to database
    $pdo = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');

    //Connection to MongoDB
    require '../../../vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $conn->CONFVIRTUAL_log->log;

    $nomeSponsor = $_POST['nome_sponsor'];
    $annoEdizinoe = $_POST['anno_edizione'];
    $acronimo = $_POST['acronimo_conferenza'];

    $query = ('INSERT INTO SOSTIENE(Nome, AnnoEdizione, Acronimo) VALUES(:lab1, :lab2, :lab3)');

    $result = $pdo->prepare($query); // controlla input e prepare la query
    $result->bindValue(":lab1", $nomeSponsor);
    $result->bindValue(":lab2", $annoEdizinoe);
    $result->bindValue(":lab3", $acronimo);
    $result->execute();

    //MongoDB
    $DATA = array("NomeSponsor" => $nomeSponsor, "AnnoEdizione" => $annoEdizione,"AcronimoConferenza" => $acronimo);
    $insertOneResult = $collection->insertOne([
        'TimeStamp'         => time(),
        'User'                => $_SESSION['username'],
        'OperationType'        => 'INSERT',
        'InvolvedTable'        => 'SOSTIENE',
        'Input'                => $DATA
    ]);

    $con = null;
    header('Location: ../admin_operations/Admin.php');
} catch (PDOException $e) {
    echo "Error: ", $e->getMessage();
}
