<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <title>Associazione Presenter</title>
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
                <h1>Associazione Presenter alla Presentazione di un Articolo</h1>
              </div>
            </div>

            <form form name="frmContact" method="post" action="PresenterAssociationLogic.php" autocomplete="off">

              <div style="padding: 1em 0 1em 0">
                <hr>
              </div>

              <label for="time" style="margin-bottom: 10px;"><b>Scegli Presenter:</b></label>
              <div class="form-outline mb-4">
                <select name="username_presenter">
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
                </select>
              </div>

              <label for="time" style="margin-bottom: 10px;"><b>Scegli Articolo:</b></label>
              <div class="form-outline mb-4">
                <select name="codice_presentazione_articolo">
                <?php          
                  // Connection to database
                  $pdo = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
                  $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $pdo -> exec('SET NAMES "utf8"');

                  // Select all CodicePresenetazione from ARTICOLO to populate the dropdown list. 
                  $query = ('SELECT CodicePresentazione FROM ARTICOLO AS A, PRESENTAZIONE AS P WHERE A.CodicePresentazione = P.Codice');
                  
                  $result = $pdo -> prepare($query);
                  $result -> execute();               
                  
                  while($row = $result -> fetch()){
                    echo "<option>" . $row['CodicePresentazione'] . "</option>";
                  }
                  
                  $con = null;
                  ?>
                </select>
              </div>

              <div class="text-center text-lg-start mt-5 pt-2">
                <button class="btn btn-dark btn-lg mb-2" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn" type="submit">Associa</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>