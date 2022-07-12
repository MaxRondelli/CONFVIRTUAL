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
    
    $usernamePresenter = $_POST['username_presenter'];
    $codicePresentazione = $_POST['codice_presentazione_articolo'];

    $query = "CALL associazionePresenter(:lab1, :lab2)";

    $result = $con->prepare($query); 
    $result->bindValue(":lab1", $usernamePresenter);
    $result->bindValue(":lab2", $codicePresentazione);
    $result->execute();

    // MongoDB
    $DATA = array("UsernamePresenter" => $usernamePresenter);
    $insertOneResult = $collection -> insertOne([
        'TimeStamp' => time(),
        'User' => $_SESSION['username'],
        'OperationType' => 'UPDATE',
        'InvolvedTable' => 'ARTICOLO',
        'Input' => $DATA
    ]);

    $con = null;
    header('Location: ../admin_operations/Admin.php');
} catch(PDOException $e) {
    echo "Error: " , $e -> getMessage();
}
?>