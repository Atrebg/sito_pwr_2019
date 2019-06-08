<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8" />
    <title>Home Biblioteca</title>
    <meta
      name="description"
      content="Pagina home della Bibilioteca Politecnica"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="stylesheet.css" />
  </head>

  <body>
    <main class="grid-container">
      <div class="topnav">
        <img src="img/logo.png" alt="LOGO.PNG" />
        <a class="active" href="#home">Home</a>
        <a href="#libri">Libri</a>
        <a href="#login">Login</a>
        <a href="#registrazione">Registrazione</a>
      </div>
      <div class="usermenu">Benvenuto Tommaso! Attualmente hai 0 libri in prestito.</div>

      <div class="content"></div>

      <div class="footer">
        <div class="sinistra"><?php echo basename($_SERVER['PHP_SELF']); ?></div>
        <div class="destra">Massaglia Tommaso</div>
      
      </div>
    </main>
  </body>
</html>
