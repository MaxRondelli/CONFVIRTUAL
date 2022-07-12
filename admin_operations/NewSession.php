<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  <title>Nuova Sessione</title>
  <script src="../admin_operations/NewSessionJS.js"></script>
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
                <h1>Nuova Sessione</h1>
              </div>
            </div>

            <form form name="frmContact" method="post" action = "NewSessionLogic.php" autocomplete="off">
              <div style="padding: 1em 0 1em 0">
                <hr>
              </div>

              <!-- Conferenze disponibili -->
              <label for="time" style="margin-bottom: 10px;"><b>Scegli Conferenza:</b></label>
              <div class="form-outline mb-4">
                <select id="conferenza_id" name="conferenza_sessione" >
                  <?php
                  // Connection to database
                  $pdo = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $pdo->exec('SET NAMES "utf8"');

                  // Select Nome, Acronimo, AnnoEdizione from CONFERENZA
                  $query = ('SELECT Nome, Acronimo, AnnoEdizione FROM CONFERENZA');

                  $result = $pdo->prepare($query);
                  $result->execute();

                  while ($row = $result->fetch()) {
                    echo "<option>" . $row['Nome'] . "</option>";
                  }
                  
                  $con = null;
                  ?>
                </select>
              </div>

              <!-- Date disponibili -->
              <label for="time" style="margin-bottom: 10px;"><b>Scegli Data:</b></label>
              <div class="form-outline mb-4">
                <select id="date_disponibili">
                  
                </select>
              </div>

              <!-- ID Programma -->
              <label for="time" style="margin-bottom: 10px;"><b>Id Programma Giornaliero:</b></label>
              <div class="form-outline mb-4"> 
                <!-- <select id="id_programma">

                </select>   
            
              -->
              <textarea id="id_programma" cols="30" rows="1" readonly></textarea>
              </div>
              

              <!-- Codice sessione -->
              <div class="form-outline mb-4">
                <div class="input-group">
                  <input type="text" class="form-control form-control-lg" name="codice_sessione"  placeholder="Codice Sessione">
                </div>
              </div>

              <!-- Link -->
              <div class="form-outline mb-4">
                <div class="input-group">
                  <input type="text" class="form-control form-control-lg" name="link_sessione"  placeholder="Link Sessione">
                </div>
              </div>

              <!-- Titolo sessione -->
              <div class="form-outline mb-4">
                <div class="input-group">
                  <input type="text" class="form-control form-control-lg" name="titolo_sessione"  placeholder="Titolo Sessione">
                </div>
              </div>

              <!-- Orario Inizio -->
              <label for="time" style="margin-bottom: 20px;"><b>Orario Inizio Sessione:</b></label>
              <div class="form-outline mb-4">
                <input type="time" class="form-control form-control-lg" name="orario_inizio_sessione">
              </div>

              <!-- Orario Fine -->
              <label for="time" style="margin-bottom: 20px;"><b>Orario Fine Sessione:</b></label>
              <div class="form-outline mb-4">
                <input type="time" class="form-control form-control-lg" name="orario_fine_sessione">
              </div>

              <div class="text-center text-lg-start mt-5 pt-2">
                <button class="btn btn-dark btn-lg mb-2" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn" type="submit" id="prova_bottone">Crea Sessione</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>