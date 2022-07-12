<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../stile.css">

    <title>Aggiungi Presentazione</title>
</head>

<body>
    <!-- Navbar Presenter -->   
    <?php include("../users_operations/NavbarUser.php"); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="first">
                    <div class="myform form">
                        <div class="logo mb-2">
                            <div class="col-md-12 text-center">
                                <h1>Aggiungi Presentazione</h1>
                            </div>
                        </div>

                        <form form name="frmContact" method="post" action="" autocomplete="off">
                            <div style="padding: 1em 0 1em 0">
                                <hr>
                            </div>

                            <!-- Codice Presentazione -->
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="codice_presentazione" required placeholder="Codice Presentazione">
                                </div>
                            </div>

                            <!-- Numero Sequenza -->
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="numero_sequenza" required placeholder="Numero Sequenza">
                                </div>
                            </div>

                            <!-- Orario Inizio -->
                            <label for="time" style="margin-bottom: 20px;"><b>Orario Inizio:</b></label>
                            <div class="form-outline mb-4">
                                <input type="time" class="form-control form-control-lg" name="orario_inizio">
                            </div>

                            <!-- Orario Fine -->
                            <label for="time" style="margin-bottom: 20px;"><b>Orario Fine:</b></label>
                            <div class="form-outline mb-4">
                                <input type="time" class="form-control form-control-lg" name="orario_fine">
                            </div>


                            <!-- Bottone per aggiungere presentazione-->
                            <div class="text-center text-lg-start mt-5 pt-2">
                                <button class="btn btn-dark btn-lg mb-2" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn">Aggiungi Presentazione</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>