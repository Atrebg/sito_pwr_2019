<?php include("session.php"); ?>
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
$name = $password = $password2 = false;
$nameerr = $passworderr = "";
$utentecreato = false;

// VARIE REGEX
// USERNAME: solo LETTERE/NUMERI o %, deve iniziare con 
// % o LETTERA, lungo minimo 6 caratteri con almeno un numero ed una non lettera
$username_regex = "/^[a-zA-Z%]{1}[a-zA-Z0-9%]{5,}$/";
// PASSWORD: solo caratteri ALFABETICI tra 4 ed 8 caratteri con almeno una MAIUSCOLA ed una MINUSCOLA
$password_regex = "/^(?=.*[a-z])(?=.*[A-Z]).{4,8}/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameerr = "Devi inserire uno username!";
    } else {
        if (preg_match($username_regex, $_POST["name"])) {
            $name = true;
        } else {
            $nameerr = "Lo username non rispetta i parametri.";
        }
    }
    if (empty($_POST["password"])) {
        $passworderr = "Devi inserire una password!";
    } else {
        if (empty($_POST["password2"])) {
            $passworderr = "Devi ripetere la password!";
        } else {
            if ($_POST["password"] === $_POST["password2"] && preg_match($password_regex, $_POST["password"])) {
                $password = true;
            } else {
                $passworderr = "Le due password non coincidono o la password non rispetta i parametri.";
            }
        }
    }

    if ($password === true && $name === true) {
        $password = mysqli_real_escape_string($dbw, $_POST["password"]);
        $name = mysqli_real_escape_string($dbw, $_POST["name"]);

        $sql = "SELECT username FROM users WHERE username=$name";
        $usernameresult = mysqli_query($dbw, $sql);
        if (mysqli_num_rows($usernameresult) > 0) {
            $nameerr = "Utente già presente nel sistema.";
        } else {
            $sql = "INSERT INTO users (username, pwd) VALUES ('$name', '$password')";
            mysqli_query($dbw, $sql);
            $utentecreato = true;
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
            <a class="active" href="new.php">Registrazione</a>
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

        <div class="content">
            <div class="login">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    Username: <input type="text" name="name" placeholder="Inserisci uno username.."><span class="error">
                        <?php echo $nameerr; ?>
                    </span><br><br>
                    Password: <input type="password" style="width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block;
    border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" name="password" placeholder="Inserisci una password.."><span class="error">
                        <?php echo $passworderr; ?>
                    </span><br><br>
                    Ripeti la Password: <input type="password" style="width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block;
    border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" name="password2" placeholder="Ripeti la password.."><span class="error">
                        <?php echo $passworderr; ?>
                    </span><br><br>
                    <input type="submit" value="REGISTRAMI">
                    <input type="reset" value="PULISCI">
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