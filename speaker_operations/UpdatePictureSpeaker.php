<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../stile.css">

    <title>Inserisci Foto Speaker</title>
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
                                <h1>Inserisci Foto Speaker</h1>
                            </div>
                        </div>
                        
                        <form form name="frmContact" method="post" action="UpdatePictureSpeakerLogic.php" autocomplete="off">

                        <div style="padding: 1em 0 1em 0">
                            <hr>
                        </div>

                        <!-- Modifica Foto -->
                        <label for="time" style="margin-bottom: 10px;"><b>Scegli Foto:</b></label>
                        <div class="form-outline mb-4">
                            <div class="input-group">
                                <input type="file" class="form-control form-control-lg" name="foto_speaker">
                            </div>
                        </div>

                        <div class="text-center text-lg-start mt-5 pt-2">
                            <button class="btn btn-dark btn-lg mb-2" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn" type="submit">Inserisci Foto</button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>