<?php include("session.php") ?>
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

<body>
    <main class="grid-container">

        <div class="topnav">
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
        </div>
        <?php if (!empty($_SESSION["login_user"])) echo '<div class="usermenu">Benvenuto 
    ' . $_SESSION["login_user"] . '! Attualmente hai 0 libri in prestito.</div>';
        else echo
            '<div class="usermenu">Benvenuto 
    ANONIMO! Attualmente hai 0 libri in prestito.</div>' ?>

        <div class="centrato">
            Per accedere alla sezione Libri è necessario il Login.
            <br><br>
            <form>
                <a class="continua" href="login.php">Continua</a>
            </form>
        </div>

        <div class="footer">
            <div class="sinistra"><?php echo basename($_SERVER['PHP_SELF']); ?></div>
            <div class="destra">Massaglia Tommaso</div>

        </div>
    </main>

</body>

</html>