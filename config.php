<?php

define("DB_SERVER", "localhost");
define("DB_USERNAME_RW", "uReadWrite");
define("DB_USERNAME_RO", "uReadOnly");
define("DB_PASSWORD", "");
define("DB_DATABASE", "biblioteca");
$dbw = mysqli_connect(DB_SERVER, DB_USERNAME_RW, DB_PASSWORD, DB_DATABASE);
$dbr = mysqli_connect(DB_SERVER, DB_USERNAME_RO, DB_PASSWORD, DB_DATABASE);
