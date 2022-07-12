<?php
session_start();

try {
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec('SET NAMES "utf8"');

    $voto = $_POST['voto_valutazione'];
    $note = $_POST['note_valutazione'];
    $codicePresentazione = $_POST['codice_presentazione'];
    $usernameAdmin = $_SESSION['username'];

    $query = 'call inserimentoValutazioni(:lab1, :lab2, :lab3, :lab4)';

    $result = $con->prepare($query); 
    $result->bindValue(":lab1", $voto);
    $result->bindValue(":lab2", $note);
    $result->bindValue(":lab3", $codicePresentazione);
    $result->bindValue(":lab4", $usernameAdmin);
    $result->execute();

    $con = null;
    header('Location: ../admin_operations/Admin.php');
} catch (PDOException $e) {
    echo "Error: ", $e->getMessage();
}