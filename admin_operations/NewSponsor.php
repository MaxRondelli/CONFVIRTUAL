<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Nuovo Sponsor</title>
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
                                <h1>Nuovo Sponsor</h1>
                            </div>
                        </div>

                        <form form name="frmContact" method="post" action="NewSponsorLogic.php" autocomplete="off">

                            <div style="padding: 1em 0 1em 0">
                                <hr>
                            </div>

                            <!-- Nome Sponsor -->
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="nome_sponsor" required placeholder="Nome Sponsor">
                                </div>
                            </div>

                            <!-- Importo Sponsor -->
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="importo_sponsor" required placeholder="Importo Sponsor">
                                </div>
                            </div>

                            <!-- Logo -->
                            <label for="time" style="margin-bottom: 10px;"><b>Scegli logo:</b></label>
                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="file" class="form-control form-control-lg" name="logo_sponsor">
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