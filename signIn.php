<?php
session_start();

try {
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec('SET NAMES "utf8"');

    //MongoDB
    require '../../vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $conn->CONFVIRTUAL_log->log;

    $username = $_POST["username"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $luogoDiNascita = $_POST["luogo_di_nascita"];
    $dataDiNascita = $_POST["data_di_nascita"];
    $password = $_POST["password"];
    $tipologiaUtente = $_POST["tipologia"];

    $query = "CALL inserisciUtente(:lab1, :lab2, :lab3, :lab4, :lab5, :lab6, :lab7)";
    $result = $con->prepare($query);

    $result->bindValue(":lab1", $username);
    $result->bindValue(":lab2", $nome);
    $result->bindValue(":lab3", $cognome);
    $result->bindValue(":lab4", $luogoDiNascita);
    $result->bindValue(":lab5", $dataDiNascita);
    $result->bindValue(":lab6", $password);
    $result->bindValue(":lab7", $tipologiaUtente);
    $result->execute();

    //MongoDB
    $DATA = array(
        "UsernameUtente" => $_SESSION['username'], "Nome" => $nome, "Cognome" => $cognome,
        "LuogoDiNascita" => $luogoDiNascita, "DataDiNascita" => $dataDiNascita, "Password" => $password, "TipologiaUtente" => "*ENUM*"
    );
    $insertOneResult = $collection->insertOne([
        'TimeStamp'         => time(),
        'User'                => $_SESSION['username'],
        'OperationType'        => 'INSERT',
        'InvolvedTable'        => 'UTENTE',
        'Input'                => $DATA
    ]);
    //   echo $tipologiaUtente;

    $nomeUniversita = $_POST['nome_universita'];
    $nomeDipartimento = $_POST['nome_dipartimento'];
    $curriculum = $_POST['curriculum'];
    $foto = $_POST['foto'];

    if ($tipologiaUtente == 2) {
        $presenter = ('INSERT INTO PRESENTER(UsernameUtente, Curriculum, Foto, NomeUniversita, NomeDipartimento)
            VALUES(:lab1, :lab2, :lab3, :lab4, :lab5)');
        // echo $tipologiaUtente;
        // echo $username;

        $result = $con->prepare($presenter);
        $result->bindValue(":lab1", $username);
        $result->bindValue(":lab2", $curriculum);
        $result->bindValue(":lab3", $foto, PDO::PARAM_LOB);
        $result->bindValue(":lab4", $nomeUniversita);
        $result->bindValue(":lab5", $nomeDipartimento);
        $result->execute();

        //MongoDB
        $DATA = array("UsernameUtente" => $_SESSION['username'], "Curriculum" => $curriculum, "Foto" => $foto,
            "NomeUniversita" => $nomeUniversita, "NomeDipartimento" => $nomeDipartimento);
        $insertOneResult = $collection->insertOne([
            'TimeStamp'         => time(),
            'User'                => $_SESSION['username'],
            'OperationType'        => 'INSERT',
            'InvolvedTable'        => 'PRESENTER',
            'Input'                => $DATA
        ]);
    } else if ($tipologiaUtente == 1) {
        $nomeUniversitaSpeaker = $_POST['nome_universita'];
        $nomeDipartimentoSpeaker = $_POST['nome_dipartimento'];
        $curriculumSpeaker = $_POST['curriculum'];
        $fotoSpeaker = $_POST['foto'];

        $speaker = ('INSERT INTO SPEAKER(UsernameUtente, Foto, NomeUniversita, NomeDipartimento, Curriculum)
            VALUES(:lab1, :lab2, :lab3, :lab4, :lab5)');

        $result = $con->prepare($speaker);
        $result->bindValue(":lab1", $username);
        $result->bindValue(":lab2", $foto, PDO::PARAM_LOB);
        $result->bindValue(":lab3", $nomeUniversita);
        $result->bindValue(":lab4", $nomeDipartimento);
        $result->bindValue(":lab5", $curriculum);
        $result->execute();

        //MongoDB
        $DATA = array("UsernameUtente" => $_SESSION['username'], "Curriculum" => $curriculum, "Foto" => $foto,
            "NomeUniversita" => $nomeUniversita, "NomeDipartimento" => $nomeDipartimento);
        $insertOneResult = $collection->insertOne([
            'TimeStamp'         => time(),
            'User'                => $_SESSION['username'],
            'OperationType'        => 'INSERT',
            'InvolvedTable'        => 'SPEAKER',
            'Input'                => $DATA
        ]);
    }

    $con = null;
    header('Location: login.html');
} catch (PDOException $e) {
    echo ("[ERRORE]" . $e->getMessage());
    exit();
}
