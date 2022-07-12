<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <title>Inserisci Presentazione</title>
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
                <h1>Inserisci Presentazione in una Sessione</h1>
              </div>
            </div>

            <form form name="frmContact" method="post" action="InsertPresentationLogic.php" autocomplete="off">

              <div style="padding: 1em 0 1em 0">
                <hr>
              </div>

              <label for="time" style="margin-bottom: 10px;"><b>Scegli Sessione:</b></label>
              <div class="form-outline mb-4">
                <select name="sessione">
                  <?php
                  // Connection to database
                  $pdo = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $pdo->exec('SET NAMES "utf8"');

                  // Select all UsernameUtente from SPEAKER to populate the dropdown list. 
                  $query = ('SELECT Codice, Titolo FROM SESSIONE');

                  $result = $pdo->prepare($query);
                  $result->execute();

                  while ($row = $result->fetch()) {
                    echo "<option>". $row['Titolo'] . "</option>";
                  }

                  $con = null;
                  ?>
                </select>
              </div>

              <label for="time" style="margin-bottom: 10px;"><b>Scegli Presentazione:</b></label>
              <div class="form-outline mb-4">
                <select id="selectArtTut" name="presentazione">
                  <option value="0">Articolo</option>
                  <option value="1">Tutorial</option>
                </select>
                <div id="formToFill">

                </div>
              </div>

              <script>
                document.addEventListener("DOMContentLoaded", (event) => {
                  const formToFill = document.getElementById("formToFill");
                  console.log(formToFill);
                  const selection = document.getElementById("selectArtTut");
                  var dynamicContent = '';
                  selection.addEventListener("change", () => {
                    if (selection.value === "0") {
                      dynamicContent = `<br> 
                      <select name="username_utente">
                      <?php          
                        // Connection to database
                        $pdo = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
                        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $pdo -> exec('SET NAMES "utf8"');

                        // Select all UsernameUtente from PRESENTER to populate the dropdown list. 
                        $query = ('SELECT UsernameUtente FROM PRESENTER');
                        
                        $result = $pdo -> prepare($query);
                        $result -> execute();               
                        
                        while($row = $result -> fetch()){
                          echo "<option>" . $row['UsernameUtente'] . "</option>";
                        }

                        $con = null;
                        ?>  
                      </select> <br>
                      <input type="text" name="codice_presentazione" required placeholder = "Codice Presentazione"> <br>
                      <input type="text" name="titolo" required placeholder = "Titolo Articolo"> <br>
                      <input type="text" name="numero_pagine" required placeholder = "Numero Pagine"> <br>
                      <input type="text" name="stato_svolgimento" required placeholder = "Stato Svolgimento"> <br>
                      <input type="text" name="parola_chiave" required placeholder = "Parola Chiave">
                      <input type="time" class="form-control form-control-lg" name="orario_inizio_presentazione">
                      <input type="time" class="form-control form-control-lg" name="orario_fine_presentazione">`;
                    } else {
                      dynamicContent = `<br>     
                      <select name="username_utente">
                      <?php          
                        // Connection to database
                        $pdo = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
                        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $pdo -> exec('SET NAMES "utf8"');

                        // Select all UsernameUtente from PRESENTER to populate the dropdown list. 
                        $query = ('SELECT UsernameUtente FROM SPEAKER');
                        
                        $result = $pdo -> prepare($query);
                        $result -> execute();               
                        
                        while($row = $result -> fetch()){
                          echo "<option>" . $row['UsernameUtente'] . "</option>";
                        }
                        
                        $con = null;
                        ?>  
                      </select> <br>             
                      <input type="text" name="codice_presentazione" required placeholder = "Codice Presentazione"> <br>
                      <input type="text" name="titolo" required placeholder = "Titolo Tutorial"> <br>
                      <input type="text" name="abstract_tutorial" required placeholder = "Abstract Tutorial">
                      <input type="time" class="form-control form-control-lg" name="orario_inizio_presentazione">
                      <input type="time" class="form-control form-control-lg" name="orario_fine_presentazione">`;
                    }
                    formToFill.innerHTML = dynamicContent;
                  });
                });
              </script>

              <div class="text-center text-lg-start mt-5 pt-2">
                <button class="btn btn-dark btn-lg mb-2" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn" type="submit">Inserisci</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



</body>

</html>