<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../stile.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Inserisci Sponsor</title>
</head>

<body>
    <!-- Navbar admin -->
    <?php include("../admin_operations/NavbarAdmin.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="first">
                    <div class="myform form">
                        <div class="logo mb-2">
                            <div class="col-md-12 text-center">
                                <h1>Nuovo Sponsor</h1>
                            </div>
                        </div>

                        <form form name="frmContact" method="post" action="InsertSponsorLogic.php" autocomplete="off">

                            <div style="padding: 1em 0 1em 0">
                                <hr>
                            </div>

                            <!-- Acronimo Conferenza -->
                            <label style="margin-bottom: 10px;"><b>Scegi Acronimo della Confenrenza:</b></label>
                            <div class="form-outline mb-4">
                                <select name="acronimo_conferenza">
                                    <?php
                                    // Connection to database
                                    $pdo = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $pdo->exec('SET NAMES "utf8"');

                                    $query = ('SELECT Acronimo FROM CONFERENZA');

                                    $result = $pdo->prepare($query);
                                    $result->execute();

                                    while ($row = $result->fetch()) {
                                        echo "<option>" . $row['Acronimo'] . "</option>";
                                    }
                                    $con = null;

                                    ?>
                                </select>
                            </div>

                            <!-- Nome Sponsor -->
                            <label style="margin-bottom: 10px;"><b>Scegi Nome dello Sponsor da associare:</b></label>
                            <div class="form-outline mb-4">
                                <select name="nome_sponsor">
                                    <?php
                                    // Connection to database
                                    $pdo = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $pdo->exec('SET NAMES "utf8"');

                                    $query = ('SELECT Nome FROM SPONSOR');

                                    $result = $pdo->prepare($query);
                                    $result->execute();

                                    while ($row = $result->fetch()) {
                                        echo "<option>" . $row['Nome'] . "</option>";
                                    }
                                    $con = null;

                                    ?>
                                </select>
                            </div>


                            <!-- Anno Edizione della Conferenza-->
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="anno_edizione" required placeholder="Anno Edizione Conferenza">
                                </div>
                            </div>

                            <div class="text-center text-lg-start mt-5 pt-2">
                                <button class="btn btn-dark btn-lg mb-2" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn" type="submit">Crea Sponsor</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>