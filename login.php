<?php
session_start();

try {
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //MongoDB
    require '../../vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $conn -> CONFVIRTUAL_log -> log;	
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $_SESSION['username'] = $username;

    // Tipologia di utente e numero di righe della query
    $query = "SELECT COUNT(*) AS COUNTER, Tipo FROM UTENTE WHERE Username = :lab1 AND Passwordd = :lab2";

    $result = $con->prepare($query);
    $result->bindValue(":lab1", $username);
    $result->bindValue(":lab2", $password);
    
    $result->execute();
 
    //MongoDB
    $insertOneResult = $collection->insertOne([
        'TimeStamp' 		=> time(),
        'User'				=> $_SESSION['username'],
        'OperationType'		=> 'SELECT',
        'InvolvedTable'	    => 'UTENTE'
    ]);

    $row = $result->fetch(); // Return tutte le righe della query

    if ($row["COUNTER"] > 0) {
        if ($row["Tipo"] == "AMMINISTRATORE") {
            header('Location: admin_operations/Admin.php');
        } else if ($row["Tipo"] == "SPEAKER") {
            header('Location: speaker_operations/Speaker.php');
        } else if ($row["Tipo"] == "PRESENTER") {
            header('Location: presenter_operations/Presenter.php');
        } else {
            header('Location: users_operations/User.php');
        }
    } else {
        header('Location: login.html');
    }

    $con = null;
} catch (PDOException $e) {
    echo ("[ERRORE]" . $e->getMessage());
    exit();
}
