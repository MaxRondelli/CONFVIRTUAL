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

    $codicePresentazione = $_POST['codice_presentazioni'];

    $query = ('INSERT INTO FAVORITE(UsernameUtente, CodicePresentazione) VALUES(:lab1, :lab2)');

    $result = $pdo->prepare($query);
    $result->bindValue(":lab1", $_SESSION['username']);
    $result->bindValue(":lab2", $codicePresentazione);
    $result->execute();

    //MongoDB
    $DATA = array("UsernameUtente" => $_SESSION['username'], "CodicePresentazione" => $codicePresentazione);
    $insertOneResult = $collection->insertOne([
        'TimeStamp'         => time(),
        'User'                => $_SESSION['username'],
        'OperationType'        => 'INSERT',
        'InvolvedTable'        => 'FAVORITE',
        'Input'                => $DATA
    ]);

    $con = null;
    header('Location: ../presenter_operations/Presenter.php');
} catch (PDOException $e) {
    echo "Error: ", $e->getMessage();
}
