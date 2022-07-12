<?php session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../stile.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Presentazione Favorite</title>
</head>

<body>
    <!-- Navbar admin -->
    <?php include("../presenter_operations/NavbarPresenter.php"); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="first">
                    <div class="myform form">
                        <div class="logo mb-2">
                            <div class="col-md-12 text-center">
                                <h1>Presentazioni Favorite</h1>
                            </div>
                        </div>

                        <form form name="frmContact" method="post" action="FavouritePresentationPresenterLogic.php" autocomplete="off">

                            <div style="padding: 1em 0 1em 0">
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-sm-80">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Inserisci Presentazione Favorita</h3>
                                            <label for="time" style="margin-bottom: 10px;"><b>Scegli Presentazione:</b></label>
                                            <div class="form-outline mb-4">
                                                <select name="codice_presentazioni">
                                                    <?php
                                                    // Connection to database
                                                    $pdo = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
                                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                    $pdo->exec('SET NAMES "utf8"');

                                                    // Select all CodicePresenetazione from ARTICOLO to populate the dropdown list. 
                                                    $query = ('SELECT CodicePresentazione FROM ARTICOLO AS A, PRESENTAZIONE AS P WHERE A.CodicePresentazione = P.Codice');

                                                    $result = $pdo->prepare($query);
                                                    $result->execute();

                                                    while ($row = $result->fetch()) {
                                                        echo "<option>" . $row['CodicePresentazione'] . "</option>";
                                                    }
                                                    $con = null;
                                                    ?>
                                                    </select>
                                            </div>
                                            <div class="text-center text-lg-start mt-5 pt-2">
                                                <button class="btn btn-dark btn-lg mb-2" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn" type="submit">Inserisci</button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-80">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3 class="card-title">Presentazioni Favorite</h3>
                                                <?php
                                                try {
                                                    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
                                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                    $con->exec('SET NAMES "utf8"');

                                                    $query = ("SELECT * FROM FAVORITE");
                                                } catch (PDOException $e) {
                                                    echo "Error: ", $e->getMessage();
                                                }
                                                ?>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Codice Presentazione</th>
                                                    </tr>
                                                    <?php
                                                    $result = $con->prepare($query);
                                                    $result->execute();

                                                    while ($row = $result->fetch()) {
                                                        if ($row['UsernameUtente'] == $_SESSION['username']) {
                                                            echo "<tr>";
                                                            echo "<td>" . $row['CodicePresentazione'] . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>