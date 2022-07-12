<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Valutazione Presentazioni</title>
    <link rel="stylesheet" href="../stile.css">
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
                                <h1>Valutazione Presentazioni</h1>
                            </div>
                        </div>

                        <form form name="frmContact" method="post" action="InsertValutationLogic.php" autocomplete="off">

                            <div style="padding: 1em 0 1em 0">
                                <hr>
                            </div>

                            <!-- Codice Presentazione -->
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="codice_presentazione" required placeholder="Codice Presentazione">
                                </div>
                            </div>

                            <!-- Voto Valutazione -->
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="voto_valutazione" required placeholder="Voto">
                                </div>
                            </div>

                            <!-- Note Valutazione -->
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="note_valutazione" required placeholder="Note">
                                </div>
                            </div>


                            <!-- Bottone per valutazione. -->
                            <div class="text-center text-lg-start mt-5 pt-2">
                                <button class="btn btn-dark btn-lg mb-2" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn" type="submit">Valuta</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>