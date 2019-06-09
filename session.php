<?php
include("config.php");
session_start();

if (!empty($_SESSION["login_user"])) {

    $name = mysqli_real_escape_string($dbr, $_SESSION["login_user"]);

    $sql = "SELECT * FROM books WHERE prestito ='$name'";
    $result = mysqli_query($dbr, $sql);

    $numlibri = mysqli_num_rows($result);
} else {
    $numlibri = 0;
}
