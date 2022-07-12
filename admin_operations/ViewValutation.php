<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../stile.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Visualizza Valutazioni</title>
</head>

<body>
    <?php include("../admin_operations/NavbarAdmin.php") ?>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="first">
                    <div class="myform form">
                        <div class="logo mb-2">
                            <div class="col-md-12 text-center">
                                <h1>Visualizza Valutazioni</h1>
                            </div>
                        </div>
                        <?php 
                        try{
                            $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');             
                            $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);             
                            $con -> exec('SET NAMES "utf8"');

                            $query = ("SELECT * FROM VALUTAZIONE");
                            
                        } catch(PDOException $e){
                            echo "Error: " , $e -> getMessage();
                        }
                        ?>
                        <form form name="frmContact" autocomplete="off">
                        <table class="table table-bordered">
                            <tr>
                                <th>Codice Presentazione</th>
                                <th>Voto</th>
                                <th>Note</th>
                            </tr>
                            <?php
                            $result = $con->prepare($query); 
                            $result -> execute();
                            while ($row = $result->fetch()) {
                            echo "<tr>";
                            echo "<td>".$row['CodicePresentazione']."</td>";
                            echo "<td>".$row['Voto']."</td>";
                            echo "<td>".$row['Note']."</td>";
                            echo "</tr>";
                            }

                            $con = null;
                            ?>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html> 