<?php 
try{
    // Connection to database
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');             
    $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    $con -> exec('SET NAMES "utf8"');

    $dataValue = $_POST['value'];
    
    $codiceSessione = "SELECT Codice FROM SESSIONE WHERE Titolo = '$dataValue'";
    $result = $con -> prepare($codiceSessione);
    $result -> execute();
    $row = $result->fetch();

    $result = $con -> prepare("SELECT * FROM MESSAGGIO WHERE CodiceSessione = '$row[0]'");
    $result -> execute();
    $row = $result->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($row);
    $con = null;
} catch(PDOException $e){
    echo "Error: " , $e -> getMessage();
}
?>