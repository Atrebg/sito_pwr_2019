<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>Registrati</title>
    <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
    <meta name="description" content="Sign Up della Bibilioteca Politecnica">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheet.css">
</head>

<?php
include("config.php");
$name = $password = $password2 = false;
$nameerr = $passworderr = "";
$utentecreato = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameerr = "Devi inserire uno username!";
    } else {
        if (preg_match("/^[a-zA-Z1-9]*$/", $_POST["name"])) {
            $name = true;
        } else {
            $nameerr = "Lo username deve essere composto solo di lettere e numeri.";
        }
    }
    if (empty($_POST["password"])) { //MANCA IL REGEXP SULLA PASSWORD E SULLO USERNAME
        $passworderr = "Devi inserire una password!";
    } else {
        if (empty($_POST["password2"])) {
            $passworderr = "Devi ripetere la password!";
        } else {
            if ($_POST["password"] === $_POST["password2"]) {
                $password = true;
            } else {
                $passworderr = "Le due password non coincidono";
            }
        }
    }

    if ($password === true && $name === true) {
        $password = mysqli_real_escape_string($dbw, $_POST["password"]);
        $name = mysqli_real_escape_string($dbw, $_POST["name"]);

        $sql = "INSERT INTO users (username, pwd) VALUES ('$name', '$password')";
        mysqli_query($dbw, $sql);
        $utentecreato = true;
    }
}

?>

<body>
    <main class="grid-container">
        <div class="topnav">
            <img src="img/logo.png" alt="LOGO.PNG" />
            <a href="home.php">Home</a>
            <a href="libri.php">Libri</a>
            <a class="active" href="new.php">Registrazione</a>
            <?php if (empty($_SESSION["login_user"])) echo '<a href="login.php">Login</a>';
            else echo '<span>Login</span>'; ?>
            <?php if (!empty($_SESSION["login_user"])) echo '<a href="logout.php">Logout</a>';
            else echo '<span>Logout</span>'; ?>
        </div>
        <?php if (!empty($_SESSION["login_user"])) echo '<div class="usermenu">Benvenuto 
    ' . $_SESSION["login_user"] . '! Attualmente hai 0 libri in prestito.</div>';
        else echo
            '<div class="usermenu">Benvenuto 
    ANONIMO! Attualmente hai ' . $numlibri . ' libri in prestito.</div>' ?>

        <div class="content">
            <div class="login">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    Username: <input type="text" name="name" placeholder="Inserisci uno username.."><span class="error">
                        <?php echo $nameerr; ?>
                    </span><br><br>
                    Password: <input type="text" name="password" placeholder="Inserisci una password.."><span class="error">
                        <?php echo $passworderr; ?>
                    </span><br><br>
                    Ripeti la Password: <input type="text" name="password2" placeholder="Ripeti la password.."><span class="error">
                        <?php echo $passworderr; ?>
                    </span><br><br>
                    <input type="submit">
                    <input type="reset">
                    <br>
                    <?php if ($utentecreato === true) {
                        echo "Utente " . $name . " creato con successo.";
                    } ?>
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