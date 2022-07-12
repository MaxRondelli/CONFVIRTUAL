<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Inserisci Risorse Aggiuntive</title>
    <link rel="stylesheet" href="../stile.css">
</head>

<body>
    <!-- Navbar Presenter -->
    <?php include("../speaker_operations/NavbarSpeaker.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="first">
                    <div class="myform form">
                        <div class="logo mb-2">
                            <div class="col-md-12 text-center">
                                <h1>Inserisci Risorse Aggiuntive Tutorial</h1>
                            </div>
                        </div>

                        <form form name="frmContact" method="post" action="UpdateResourcesSpeakerLogic.php" autocomplete="off">

                            <div style="padding: 1em 0 1em 0">
                                <hr>
                            </div>

                            <!-- Modifica Link Risorsa Aggiuntiva -->
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="link_risorsa_aggiuntiva" required placeholder="Link Risorsa Aggiuntiva">
                                </div>
                            </div>

                            <!-- Modifica Descrizione Risorsa Aggiuntiva -->
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="descrizione_risorsa_aggiuntiva" required placeholder="Descrizione Risorsa Aggiuntiva">
                                </div>
                            </div>

                            <label for="time" style="margin-bottom: 10px;"><b>Scegli Tutorial:</b></label>
                            <div class="form-outline mb-4">
                                <select name="titolo_tutorial">
                                    <?php
                                    // Connection to database
                                    $pdo = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $pdo->exec('SET NAMES "utf8"');

                                    // Select all CodicePresenetazione from TUTORIAL to populate the dropdown list. 
                                    $query = ('SELECT CodicePresentazione, Titolo FROM TUTORIAL AS T, PRESENTAZIONE AS P WHERE T.CodicePresentazione = P.Codice');
                                    $result = $pdo->prepare($query);
                                    $result->execute();

                                    while ($row = $result->fetch()) {
                                        echo "<option>" . $row['CodicePresentazione'] . " - " . $row['Titolo'] . "</option>";
                                    }
                                    
                                    $con = null;
                                    ?>
                                </select>

                                <div class="text-center text-lg-start mt-5 pt-2">
                                    <button class="btn btn-dark btn-lg mb-2" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn" type="submit">Inserisci Risorse Aggiuntive</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>