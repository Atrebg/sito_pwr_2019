<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
    <meta name="Restituisci" content="Restituisci alla Bibilioteca Politecnica">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheet.css">
</head>

<?php
include("session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT * FROM books";
    $resultlibri = mysqli_query($dbr, $sql);
    if (mysqli_num_rows($resultlibri) > 0) {
        while ($row = mysqli_fetch_assoc($resultlibri)) {
            if (!empty($_POST["" . $row["id"]])) {
                $sql = "UPDATE books
                SET prestito = '', DATA = 0, giorni=0
                WHERE id=" . $row['id'] . ";";
                mysqli_query($dbw, $sql);
            }
        }
    }
}

?>

<body>
    <main class="grid-container">

        <div class="topnav">
            <img src="img/logo.png" alt="LOGO.PNG" />
            <a href="home.php">Home</a>
            <a href="libri.php">Libri</a>
            <?php if (empty($_SESSION["login_user"])) echo '<a href="login.php">Login</a>';
            else echo '<span>Login</span>'; ?>
            <?php if (!empty($_SESSION["login_user"])) echo '<a href="logout.php">Logout</a>';
            else echo '<span>Logout</span>'; ?>
            <span>Logout</span>
        </div>
        <?php if (!empty($_SESSION["login_user"])) echo '<div class="usermenu">Benvenuto 
    ' . $_SESSION["login_user"] . '! Attualmente hai 0 libri in prestito.</div>';
        else echo
            '<div class="usermenu">Benvenuto 
    ANONIMO! Attualmente hai 0 libri in prestito.</div>' ?>

        <div class="centrato">
            Libri restituiti con successo.
            <br>
            <form>
                <a class="continua" href="libri.php">Continua</a>
            </form>
        </div>

        <div class="footer">
            <div class="sinistra"><?php echo basename($_SERVER['PHP_SELF']); ?></div>
            <div class="destra">Massaglia Tommaso</div>

        </div>
    </main>

</body>

</html>