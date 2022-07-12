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

    $codiceSessione = $_POST["codice_sessione"];
    $linkSessione = $_POST["link_sessione"];
    $titoloSessione = $_POST["titolo_sessione"];
    $orarioInizioSessione = $_POST["orario_inizio_sessione"];
    $orarioFineSessione = $_POST["orario_fine_sessione"];
    $idProgramma = $_POST["id_programma"];

    $query = "INSERT INTO SESSIONE(Codice, Link, Titolo, IdProgramma, OraInizio, OraFine) VALUES(:lab1, :lab2, :lab3, :lab4, :lab5, :lab6)";

    $result = $con->prepare($query);

    $result->bindValue(":lab1", $codiceSessione);
    $result->bindValue(":lab2", $linkSessione);
    $result->bindValue(":lab3", $titoloSessione);
    $result->bindValue(":lab4", $idProgramma);
    $result->bindValue(":lab5", $orarioInizioSessione);
    $result->bindValue(":lab6", $orarioFineSessione);
    $result->execute();

    // MongoDB
    $DATA = array("CodiceSessione" => $codiceSessione, "LinkSessione" => $linkSessione, "TitoloSessione" => $titoloSessione, 
    "IdProgramma" => $idProgramma, "OrarioInizioSessione" => $orarioInizioSessione, "OrarioFineSessione" => $orarioFineSessione);
    $insertOneResult = $collection -> insertOne([
        'TimeStamp' => time(),
        'User' => $_SESSION['username'],
        'OperationType' => 'INSERT',
        'InvolvedTable' => 'SESSIONE',
        'Input' => $DATA
    ]);

    $con = null;
    header('Location: ../admin_operations/Admin.php');
} catch (PDOException $e) {
    echo "Error: ", $e->getMessage();
}
