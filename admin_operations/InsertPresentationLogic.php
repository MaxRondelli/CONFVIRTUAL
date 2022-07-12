<?php
session_start();

try {
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec('SET NAMES "utf8"');

    require '../../../vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $conn->CONFVIRTUAL->log;

    // Global variables
    $codicePresentazione = $_POST['codice_presentazione'];
    $titolo = $_POST['titolo'];
    $sessione = $_POST['sessione'];
    $username = $_POST['username_utente'];

    $codiceSessione = ('SELECT Codice, OraInizio, OraFine FROM SESSIONE WHERE Titolo = :lab1');
    $result = $con->prepare($codiceSessione);
    $result->bindValue(":lab1", $sessione);
    $result->execute();
    $codiceSessioneFinal = $result->fetch();

    $oraInizio = $_POST['orario_inizio_presentazione'];
    $oraFine = $_POST['orario_fine_presentazione'];

    // Articolo logic
    if (!empty($_POST['numero_pagine']) && !empty($_POST['stato_svolgimento']) && !empty($_POST['parola_chiave'])) {
        $numeroPagine = $_POST['numero_pagine'];
        $statoSvolgimento = $_POST['stato_svolgimento'];
        $parolaChiave = $_POST['parola_chiave'];

        $query = "CALL inserimentoPresentazioni(:lab1, :lab2, :lab3, :lab4, :lab5)";

        $result = $con->prepare($query);
        $result->bindValue(":lab1", $codiceSessioneFinal[0]);
        $result->bindValue(":lab2", $codicePresentazione);
        $result->bindValue(":lab3", $oraInizio);
        $result->bindValue(":lab4", $oraFine);
        $result->bindValue(":lab5", "");
        $result->execute();

        // MongoDB PRESENTAZIONE
        $DATA = array("Codice" => $codicePresentazione, "OraInizio" => $oraInizio, "OraFine" => $oraFine);
        $insertOneResult = $collection->insertOne([
            'TimeStamp' => time(),
            'User' => $_SESSION['username'],
            'OperationType' => 'INSERT',
            'InvolvedTable' => 'PRESENTAZIONE',
            'Input' => $DATA
        ]);

        // MongoDB ARTICOLATA
        $DATA = array("CodiceSessione" => $codiceSessioneFinal[0], "CodicePresentazione" => $codicePresentazione);
        $insertOneResult = $collection->insertOne([
            'TimeStamp' => time(),
            'User' => $_SESSION['username'],
            'OperationType' => 'INSERT',
            'InvolvedTable' => 'ARTICOLATA',
            'Input' => $DATA
        ]);

        $articolo = ('INSERT INTO ARTICOLO(Titolo, NumeroPagine, StatoSvolgimento, ParolaChiave, CodicePresentazione, UsernameUtente) 
             VALUES(:lab6, :lab7, :lab8, :lab9, :lab10, :lab11)');

        $result = $con->prepare($articolo);
        $result->bindValue(":lab6", $titolo);
        $result->bindValue(":lab7", $numeroPagine);
        $result->bindValue(":lab8", $statoSvolgimento);
        $result->bindValue(":lab9", $parolaChiave);
        $result->bindValue(":lab10", $codicePresentazione);
        $result->bindValue(":lab11", $username);
        $result->execute();

        // MongoDB ARTICOLO
        $DATA = array(
            "Titolo" => $titolo, "NumeroPagine" => $numeroPagine,
            "StatoSvolgimento" => $statoSvolgimento, "ParoleChiave" => $parolaChiave,
            "CodicePresentazione" => $codicePresentazione, "Username" => $username
        );
        $insertOneResult = $collection->insertOne([
            'TimeStamp' => time(),
            'User' => $_SESSION['username'],
            'OperationType' => 'INSERT',
            'InvolvedTable' => 'ARTICOLO',
            'Input' => $DATA
        ]);

        $nome = ('SELECT Nome FROM UTENTE WHERE Username = :lab1');
        $result = $con->prepare($nome);
        $result->bindValue(":lab1", $username);
        $result->execute();
        $nomeFinal = $result->fetch();

        $cognome = ('SELECT Cognome FROM UTENTE WHERE Username = :lab1');
        $result = $con->prepare($cognome);
        $result->bindValue(":lab1", $username);
        $result->execute();
        $cognomeFinal = $result->fetch();

        $autore = ('INSERT INTO AUTORE(CodicePresentazione, Nome, Cognome) VALUES(:lab1, :lab2, :lab3)');
        $result = $con->prepare($autore);
        $result->bindValue(":lab1", $codicePresentazione);
        $result->bindValue(":lab2", $nomeFinal[0]);
        $result->bindValue(":lab3", $cognomeFinal[0]);
        $result->execute();

        // MongoDB AUTORE
        $DATA = array("CodicePresentazione" => $codicePresentazione, "Nome" => $nomeFinal[0], "Cognome" => $cognomeFinal[0]);
        $insertOneResult = $collection->insertOne([
            'TimeStamp' => time(),
            'User' => $_SESSION['username'],
            'OperationType' => 'INSERT',
            'InvolvedTable' => 'AUTORE',
            'Input' => $DATA
        ]);
    }
    // Tutorial logic
    if (!empty($_POST['abstract_tutorial'])) {
        $abstractTutorial = $_POST['abstract_tutorial'];

        $query = "CALL inserimentoPresentazioni(:lab1, :lab2, :lab3, :lab4, :lab5)";

        $result = $con->prepare($query);
        $result->bindValue(":lab1", $codiceSessioneFinal[0]);
        $result->bindValue(":lab2", $codicePresentazione);
        $result->bindValue(":lab3", $oraInizio);
        $result->bindValue(":lab4", $oraFine);
        $result->bindValue(":lab5", "");
        $result->execute();

        // MongoDB PRESENTAZIONE
        $DATA = array("Codice" => $codicePresentazione, "OraInizio" => $oraInizio, "OraFine" => $oraFine);
        $insertOneResult = $collection->insertOne([
            'TimeStamp' => time(),
            'User' => $_SESSION['username'],
            'OperationType' => 'INSERT',
            'InvolvedTable' => 'PRESENTAZIONE',
            'Input' => $DATA
        ]);

        // MongoDB ARTICOLATA
        $DATA = array("CodiceSessione" => $codiceSessioneFinal[0], "CodicePresentazione" => $codicePresentazione);
        $insertOneResult = $collection->insertOne([
            'TimeStamp' => time(),
            'User' => $_SESSION['username'],
            'OperationType' => 'INSERT',
            'InvolvedTable' => 'ARTICOLATA',
            'Input' => $DATA
        ]);

        $tutorial = ('INSERT INTO TUTORIAL(CodicePresentazione, Titolo, Abstract) VALUES(:lab3, :lab4, :lab5)');

        $result = $con->prepare($tutorial);
        $result->bindValue(":lab3", $codicePresentazione);
        $result->bindValue(":lab4", $titolo);
        $result->bindValue(":lab5", $abstractTutorial);
        $result->execute();

        // MongoDB TUTORIAL
        $DATA = array("CodicePresentazione" => $codicePresentazione, "Titolo" => $titolo, "AbstractTutorial" => $abstractTutorial);
        $insertOneResult = $collection->insertOne([
            'TimeStamp' => time(),
            'User' => $_SESSION['username'],
            'OperationType' => 'INSERT',
            'InvolvedTable' => 'TUTORIAL',
            'Input' => $DATA
        ]);

        $presenta = ('INSERT INTO PRESENTA(UsernameUtente, CodicePresentazione) VALUES(:lab1, :lab2)');

        $result = $con->prepare($presenta);
        $result->bindValue(":lab1", $username);
        $result->bindValue(":lab2", $codicePresentazione);
        $result->execute();

        // MongoDB TUTORIAL
        $DATA = array("CodicePresentazione" => $codicePresentazione, "Titolo" => $titolo);
        $insertOneResult = $collection->insertOne([
            'TimeStamp' => time(),
            'User' => $_SESSION['username'],
            'OperationType' => 'INSERT',
            'InvolvedTable' => 'PRESENTA',
            'Input' => $DATA
        ]);
    }

    $con = null;
    header('Location: ../admin_operations/Admin.php');
} catch (PDOException $e) {
    echo "Error: ", $e->getMessage();
}
