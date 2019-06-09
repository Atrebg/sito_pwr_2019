<?php include("session.php"); ?>
<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <title>Elenco Libri Biblioteca</title>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
  <meta name="description" content="Pagina Libri della Bibilioteca Politecnica">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheet.css">
</head>

<?php
if (empty($_SESSION["login_user"])) {
  header("Location: login.php");
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["checkbox"])) {
  if (count($_POST["checkbox"]) + $numlibri <= 3) {
    foreach ($_POST["checkbox"] as $selected) {
      if (isset($selected) && is_numeric($_POST["numgiorni"])) {
        $sql = "UPDATE books SET prestito = '" . $_SESSION["login_user"] . "',data=NOW(),giorni='" . $_POST["numgiorni"] . "'  WHERE id=$selected;";
        mysqli_query($dbw, $sql);
        header("Location: libri.php");
      } else {
        $error = "Selezionare dei libri e mettere un numero di giorni.";
      }
    }
  } else {
    $error = "Massimo 3 libri in prestito alla volta.";
  }
}

?>


<body>
  <main class="grid-container">
    <div class="topnav">
      <img src="img/logo.png" alt="LOGO.PNG" />
      <a href="home.php">Home</a>
      <a class="active" href="libri.php">Libri</a>
      <a href="new.php">Registrazione</a>
      <?php if (empty($_SESSION["login_user"])) echo '<a href="login.php">Login</a>';
      else echo '<span>Login</span>'; ?>
      <?php if (!empty($_SESSION["login_user"])) echo '<a href="logout.php">Logout</a>';
      else echo '<span>Logout</span>'; ?>
    </div>
    <?php if (!empty($_SESSION["login_user"])) echo '<div class="usermenu">Benvenuto 
    ' . $_SESSION["login_user"] . '! Attualmente hai ' . $numlibri . ' libri in prestito.</div>';
    else echo
      '<div class="usermenu">Benvenuto 
    ANONIMO! Attualmente hai 0 libri in prestito.</div>' ?>

    <div class="libricontent">
      <div class="tabella">
        <span class="titolo">Libri in prestito</span>
        <form method="post" action="<?php echo htmlspecialchars("restituisci.php"); ?>">
          <table>
            <tr>
              <th>Autore</th>
              <th>Titolo</th>
              <th>Prestito</th>
            </tr>
            <?php
            $sql = "SELECT * FROM books";
            $resultlibri = mysqli_query($dbr, $sql);
            if (mysqli_num_rows($resultlibri) > 0) {
              while ($row = mysqli_fetch_assoc($resultlibri)) {
                if ($row["prestito"] == $_SESSION["login_user"]) {
                  echo "<tr><td>" . $row["autori"] . "</td><td>" . $row["titolo"] . "</td>
                  <td style='text-align: center'><input class='restituisci' type='submit' name='" . $row["id"] . "'value='RESTITUISCI' formaction='restituisci.php'></td>";
                }
                echo "</tr>";
              }
            } ?>
          </table>
        </form>
        <div class="tabella">
          <span class="titolo">Elenco libri</span>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <table>
              <tr>
                <th>Autore</th>
                <th>Titolo</th>
                <th>Prestito</th>
              </tr>
              <?php
              $sql = "SELECT * FROM books";
              $resultlibri = mysqli_query($dbr, $sql);
              if (mysqli_num_rows($resultlibri) > 0) {
                while ($row = mysqli_fetch_assoc($resultlibri)) {
                  echo "<tr><td>" . $row["autori"] . "</td><td>" . $row["titolo"] . "</td>";
                  if ($row["prestito"] == $_SESSION["login_user"]) {
                    if (time() - strtotime($row["data"]) > $row["giorni"] * 60 * 60 * 24)
                      echo "<td style='text-align: center'>PRESTITO SCADUTO</td>";
                    else {
                      echo "<td style='text-align: center'>IN PRESTITO</td>";
                    }
                  } else if (!empty($row["prestito"])) {
                    echo "<td style='text-align: center'>NON DISPONIBILE</td>";
                  } else {
                    echo "<td style='text-align: center'><input type='checkbox' name='checkbox[]' value='" . $row["id"] . "'></input></td>";
                  }
                  echo "</tr>";
                }
              } ?>
            </table>
            <span class="info"><?php echo $error; ?></span>
            <input class="numgiorni" type="text" name="numgiorni" placeholder="Inserisci per quanti giorni">
            <input class="prestito" type="submit" value="PRESTITO">
          </form>
        </div>
      </div>
    </div>

    <div class="footer">
      <div class="sinistra"><?php echo basename($_SERVER['PHP_SELF']); ?></div>
      <div class="destra">Massaglia Tommaso</div>

    </div>
  </main>
</body>



</html>