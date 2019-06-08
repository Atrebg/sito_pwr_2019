<?php session_start(); ?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
    <meta name="description" content="Login alla Bibilioteca Politecnica">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheet.css">
</head>

<?php

include("config.php");
$name = $password = false;
$nameerr = $passworderr = $error = "";
$utentetrovato = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameerr = "Devi inserire uno username!";
    } else {
        $name == true;
    }
    if (empty($_POST["password"])) {
        $passworderr = "Devi inserire una password!";
    } else {
        $password == true;
    }

    $password = mysqli_real_escape_string($dbw, $_POST["password"]);
    $name = mysqli_real_escape_string($dbr, $_POST["name"]);

    $sql = "SELECT username, pwd FROM users WHERE username='$name' AND pwd='$password'";
    $result = mysqli_query($dbr, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //$active = $row['active'];

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION["login_user"] = $name;
        header("location: libri.php");
    } else {
        $error = "Il tuo username o la tua password non sono validi.";
    }
}

?>

<body>
    <main class="grid-container">
        <div class="topnav">
            <img src="img/logo.png" alt="LOGO.PNG" />
            <a href="home.php">Home</a>
            <a href="libri.php">Libri</a>
            <a href="new.php">Registrazione</a>
            <a class="active" href="login.php">Login</a>
            <span>Logout</span>
        </div>
        <?php if (!empty($_SESSION["login_user"])) echo '<div class="usermenu">Benvenuto 
    ' . $_SESSION["login_user"] . '! Attualmente hai 0 libri in prestito.</div>';
        else echo
            '<div class="usermenu">Benvenuto 
    ANONIMO! Attualmente hai 0 libri in prestito.</div>' ?>

        <div class="content">
            <div class="login">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    Username: <input type="text" name="name" placeholder="Inserisci il tuo username.."><span class="error">
                        <?php echo $nameerr; ?>
                    </span><br><br>
                    Password: <input type="text" name="password" placeholder="Inserisci la tua password.."><span class="error">
                        <?php echo $passworderr; ?>
                    </span><br><br>
                    <input type="submit">
                    <input type="reset">
                    <?php echo $error; ?>
                </form>

            </div>
        </div>

        <div class="footer">
            <div class="sinistra"><?php echo basename($_SERVER['PHP_SELF']); ?></div>
            <div class="destra">Massaglia Tommaso</div>

        </div>
    </main>
</body>

</html>