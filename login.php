<?php session_start(); ?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
    <meta name="Login" content="Login alla Bibilioteca Politecnica">
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
        $name = true;
    }
    if (empty($_POST["password"])) {
        $passworderr = "Devi inserire una password!";
    } else {
        $password = true;
    }

    if ($password == true && $name == true) {
        $password = mysqli_real_escape_string($dbw, $_POST["password"]);
        $name = mysqli_real_escape_string($dbr, $_POST["name"]);

        $sql = "SELECT username, pwd FROM users WHERE username='$name' AND pwd='$password'";
        $result = mysqli_query($dbr, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $cookie_name = "last_login";
            $_SESSION["login_user"] = $name;
            setcookie($cookie_name, $name, time() + (86400 * 2), "/");
            header("location: libri.php");
        } else {
            $error = "Il tuo username o la tua password non sono validi.";
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
                    Username: <input type="text" name="name" placeholder="Inserisci il tuo username.." value="<?php
                                                                                                                if (isset($_COOKIE["last_login"])) {
                                                                                                                    echo $_COOKIE["last_login"];
                                                                                                                }
                                                                                                                ?>"><span class="error">
                        <?php echo $nameerr; ?>
                    </span><br><br>
                    Password: <input type="password" style="width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block;
    border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" name="password" placeholder="Inserisci la tua password.."><span class="error">
                        <?php echo $passworderr; ?>
                    </span><br><br>
                    <input type="submit" value="OK">
                    <input type="reset" value="PULISCI">
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