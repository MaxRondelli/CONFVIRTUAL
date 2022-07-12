<?php 
try{
    // Connection to database
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');             
    $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    $con -> exec('SET NAMES "utf8"');

    $dataValue = $_POST['value'];
    
    $acronimo = "SELECT Acronimo FROM CONFERENZA WHERE Nome = '$dataValue'";
    $result = $con -> prepare($acronimo);
    $result -> execute();
    $row = $result->fetch();

    $result = $con -> prepare("SELECT Data, IdProgramma FROM PROGRAMMA WHERE AcronimoProgramma = '$row[0]'");
    $result -> execute();
    $row = $result->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($row);
    
    $con = null;
} catch(PDOException $e){
    echo "Error: " , $e -> getMessage();
}
