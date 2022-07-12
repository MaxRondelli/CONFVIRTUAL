<?php
try {
    // Connection to database
    $con = new PDO('mysql:host=localhost;dbname=confvirtual', $user = 'root', $pass = '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec('SET NAMES "utf8"');

    // Number of registered conference
    $query1 = ('SELECT COUNT(*) AS Count FROM CONFERENZA');
    $result = $con->prepare($query1);
    $result->execute();
    $row = $result->fetch();
    $conferenze = $row["Count"];

    // Number of active conference
    $query2 = ('SELECT COUNT(*) AS Count FROM CONFERENZA WHERE Svolgimento = "Attiva"');
    $result = $con->prepare($query2);
    $result->execute();
    $row = $result->fetch();
    $conferenzeAttive = $row["Count"];

    // Number of users
    $query3 = ('SELECT COUNT(*) AS Count FROM UTENTE');
    $result = $con->prepare($query3);
    $result->execute();
    $row = $result->fetch();
    $utenti = $row["Count"];

    // Ranking
    $ranking = ('SELECT UsernameUtente, AVG(Voto) AS VotoMedio FROM Ranking GROUP BY UsernameUtente ORDER BY AVG(Voto) ');
    $result = $con->prepare($ranking);
    $result->execute();

    $row = $result->fetch();
    $rankingUsername = $row['UsernameUtente'];
    $rankingVoto = $row['VotoMedio'];
} catch (PDOException $e) {
    echo "Error: ", $e->getMessage();
}
?>

<div class="card text-center">
    <div class="card-body">
        <h3><b>STATISTICHE</b></h3>
    </div>
</div>
<div class="row row-cols-1 row-cols-md-3 g-4" class="card-group">
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title"><?php echo "{$conferenze}" ?></h5>
            <p class="card-text">Conferenze registrate</p>
        </div>
    </div>
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title"><?php echo "{$conferenzeAttive}" ?></h5>
            <p class="card-text">Conferenze attive</p>
        </div>
    </div>
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title"><?php echo "{$utenti}" ?></h5>
            <p class="card-text">Utenti Registrati</p>
        </div>
    </div>

    <div class="card text-center">
        <div class="card-body">
            <h3 class="card-title">Classifica Voti Utenti</h3>
            <form form name="frmContact" autocomplete="off">
                <table class="table table-bordered">
                    <tr>
                        <th>Username</th>
                        <th>Voto</th>
                        <?php
                        $result = $con->prepare($ranking);
                        $result->execute();
                        while ($row = $result->fetch()) {
                            echo "<tr>";
                            echo "<td>" . $row['UsernameUtente'] . "</td>";
                            echo "<td>" . $row['VotoMedio'] . "</td>";
                            echo "</tr>";
                        }

                        $con = null;
                        ?>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
</div>