<?php
session_start();
try {
  $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "SELECT COUNT(*) AS COUNTER, Tipo FROM UTENTE WHERE Username = :lab1";

  $result = $con->prepare($query);
  $result->bindValue(":lab1", $_SESSION['username']);
  $result->execute();
} catch (PDOException $e) {
  echo ("[ERRORE]" . $e->getMessage());
  exit();
}
?>

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

  <!-- Navbar -->
  <?php
  $row = $result->fetch(); // Return tutte le righe della query

  if ($row["COUNTER"] > 0) {
    if ($row["Tipo"] == "AMMINISTRATORE") {
      include("../admin_operations/NavbarAdmin.php");
    } else if ($row["Tipo"] == "SPEAKER") {
      include("../speaker_operations/NavbarSpeaker.php");
    } else if ($row["Tipo"] == "PRESENTER") {
      include("../presenter_operations/NavbarPresenter.php");
    } else {
      include("../users_operations/NavbarUser.php");
    }
  }
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-5 mx-auto">
        <div id="first">
          <div class="myform form">
            <div class="logo mb-2">
              <div class="col-md-12 text-center">
                <h1>Chat Sessione</h1>
              </div>
            </div>
            <form form name="frmContact" method="post" action="ChatLogic.php" autocomplete="off">

              <div style="padding: 1em 0 1em 0">
                <hr>
              </div>

              <label for="time" style="margin-bottom: 10px;"><b>Scegli la Sessione in cui scrivere un messaggio:</b></label>
              <div class="form-outline mb-4">
                <select name="sessione">
                  <?php
                  // Connection to database
                  $pdo = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $pdo->exec('SET NAMES "utf8"');

                  $sessione = ('SELECT Codice, Titolo, OraInizio, OraFine FROM SESSIONE');
                  $result = $pdo->prepare($sessione);
                  $result->execute();

                  while ($row = $result->fetch()) {
                    echo "<option>" . $row['Titolo'] . "</option>";
                  }

                  $con = null;
                  ?>
                </select>
              </div>

              <label for="time" style="margin-bottom: 10px;"><b>Scrivi il messaggio:</b></label>
              <div class="form-outline mb-4">
                <textarea name="chat_area" rows="6" cols="45"></textarea>
              </div>

              <div class="text-center text-lg-start mt-5 pt-2">
                <button class="btn btn-dark btn-lg mb-2" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn" type="submit">Scrivi</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>