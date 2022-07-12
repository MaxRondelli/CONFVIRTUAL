<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../stile.css">

    <title>Registrazione Conferenza</title>
</head>

<body>
    <!-- Navbar Presenter -->
    <?php include("../presenter_operations/NavbarPresenter.php"); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="first">
                    <div class="myform form">
                        <div class="logo mb-2">
                            <div class="col-md-12 text-center">
                                <h1>Registrazione a una Conferenza</h1>
                            </div>
                        </div>

                        <form form name="frmContact" method="post" action="ConferenceRegistrationPresenterLogic.php" autocomplete="off">
                            <div style="padding: 1em 0 1em 0">
                                <hr>
                            </div>

                            <!-- Acronimo Conferenza -->
                            <label for="time" style="margin-bottom: 10px;"><b>Scegli l'Acronimo della Conferenza:</b></label>
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <select name="acronimo_conferenza">
                                        <?php
                                        // Connection to database
                                        $pdo = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $pdo->exec('SET NAMES "utf8"');

                                        // Select all UsernameUtente from SPEAKER to populate the dropdown list. 
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
                            </div>
                            <!-- Anno Edizione Conferenza -->
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="anno_edizione_conferenza" required placeholder="Anno Edizione">
                                </div>
                            </div>

                            <!-- Bottone per aggiungere presentazione-->
                            <div class="text-center text-lg-start mt-5 pt-2">
                                <button class="btn btn-dark btn-lg mb-2" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn" type="submit">Registrati</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>