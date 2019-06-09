<?php include("session.php"); ?>
<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8" />
  <title>Home Biblioteca</title>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
  <meta name="description" content="Pagina home della Bibilioteca Politecnica" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="stylesheet.css" />
</head>

<body>
  <script src="slideshow.js" defer></script>
  <main class="grid-container">
    <div class="topnav">
      <img src="img/logo.png" alt="LOGO.PNG" />
      <a class="active" href="home.php">Home</a>
      <a href="libri.php">Libri</a>
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

    <div class="homecontent">
      <div class="slideshow-container">
        <!-- Inserisco le immagini -->
        <div class="slide fade">
          <div class="numeroslide">1 / 3</div>
          <img src="img/img1.jpg" style="width:100%" alt="segnaposto">
          <div class="text"></div>
        </div>
        <div class="slide fade">
          <div class="numeroslide">2 / 3</div>
          <img src="img/img2.jpg" style="width:100%" alt="segnaposto">
          <div class="text"></div>
        </div>
        <div class="slide fade">
          <div class="numeroslide">3 / 3</div>
          <img src="img/img3.jpg" style="width:100%" alt="segnaposto">
          <div class="text"></div>
        </div>
        <!-- Bottoni -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>
      <br>
      <!-- Pallini -->
      <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
      </div>
      <div class="info">
        <div class="elenco"><span>Servizi disponibili:</span>
          <ul>
            <li>Stampante</li>
            <li>Wi-Fi</li>
            <li>Scanner</li>
            <li>Macchina foto</li>
            <li>Pc con connessione internet</li>
            <li>Servizio consultazione tesi</li>
          </ul>
        </div>
        <div class="testo"><span>Info sulla biblioteca:</span><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem voluptatum pariatur qui magnam possimus minima, expedita iure sequi consequuntur veniam omnis delectus unde, at harum quis, vitae aut? Fugit, nam?
          <br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque a soluta itaque in sint, facilis incidunt esse recusandae asperiores consequuntur distinctio, quibusdam dicta doloribus obcaecati dignissimos fugiat, nulla ab maiores!
          <br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, quia? Impedit cumque a ut temporibus nostrum dolorum aspernatur possimus molestiae? Officia doloribus recusandae illo minus soluta, explicabo consectetur voluptatem dolore.
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