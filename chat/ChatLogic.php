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

    $dataInserimento = date("Y-m-d");
    $startTimeNow = date("H:m:s");
    $endTimeNow = date("H:m:s");

    $username = $_SESSION['username'];
    $textChat = $_POST['chat_area'];
    $sessione = $_POST['sessione'];

    $codiceSessione = ('SELECT Codice, OraInizio, OraFine FROM SESSIONE WHERE Titolo = :lab1');
    $result = $con->prepare($codiceSessione);
    $result->bindValue(":lab1", $sessione);
    $result->execute();
    $codiceSessioneFinal = $result->fetch();

    $oraInizio = $codiceSessioneFinal['OraInizio'];
    $oraFine = $codiceSessioneFinal['OraFine'];

    if ($startTimeNow > $oraInizio && $endTimeNow < $oraFine) {
        $query = ('INSERT INTO MESSAGGIO(UsernameUtente, DataInserimento, Testo, CodiceSessione) VALUES(:lab1, :lab2, :lab3, :lab4)');

        $result = $con->prepare($query);
        $result->bindValue(":lab1", $username);
        $result->bindValue(":lab2", $dataInserimento);
        $result->bindValue(":lab3", $textChat);
        $result->bindValue(":lab4", $codiceSessioneFinal['Codice']);
        $result->execute();

        //MongoDB
        $DATA = array("UsernameUtente" => $username, "DataInserimento" => $dataInserimento, "Text" => $textChat, "CodiceSessione" => $codiceSessioneFinal['Codice']);
        $insertOneResult = $collection->insertOne([
            'TimeStamp'         => time(),
            'User'                => $_SESSION['username'],
            'OperationType'        => 'INSERT',
            'InvolvedTable'        => 'MESSAGGIO',
            'Input'                => $DATA
        ]);
    }
    /**
     * VALUTARE ELSE : COSA SUCCEDE QUANDO GLI ORARI NON VANNO BENE CIOè QUANDO LA SESSIONE NON è APERTA 
     */

    $con = null;
    header('Location: ../Chat/Chat.php');
} catch (PDOException $e) {
    echo "Error: ", $e->getMessage();
}
