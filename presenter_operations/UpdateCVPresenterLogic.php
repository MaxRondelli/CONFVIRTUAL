<?php
session_start();

try {
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec('SET NAMES "utf8"');

    //Connection to MongoDB
    require '../../../vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $conn->CONFVIRTUAL_log->log;

    $curriculumPresenter = $_POST['curriculum_presenter'];

    $query = "CALL inserimentoCVPRESENTER(:lab1, :lab2)";

    $result = $con->prepare($query);
    $result->bindValue(":lab1", $_SESSION['username']);
    $result->bindValue(":lab2", $curriculumPresenter);
    $result->execute();

    //MongoDB
    $DATA = array("UsernameUtente" => $_SESSION['username'], "Curriculum" => $curriculumPresenter);
    $insertOneResult = $collection->insertOne([
        'TimeStamp'         => time(),
        'User'                => $_SESSION['username'],
        'OperationType'        => 'UPDATE',
        'InvolvedTable'        => 'PRESENTER',
        'Input'                => $DATA
    ]);

    $con = null;
    header('Location: ../presenter_operations/Presenter.php');
} catch (PDOException $e) {
    echo "Error: ", $e->getMessage();
}
