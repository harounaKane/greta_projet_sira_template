<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/css/style.css">
  <title> <?= $title ?? "Agence" ?> </title>
</head>
<body>
  <header class="text-center text-white">
    <h1>Bienvenue à bord</h1>
    <h2>Location de véhicule</h2>
    <nav>
      <a class="btn btn-warning" href="index.php">Accueil</a>
      <?php if( isConnected() ): ?>
        <a class="btn btn-success" href="index.php?action=compte">Mon compte</a>

        <?php if( isAdmin() ): ?>
          <a class="btn btn-success" href="index.php?action=membre">Gestion Membre</a>
          <a class="btn btn-success" href="index.php">Gestion Véhicule</a>
          <a class="btn btn-success" href="index.php">Gestion Agence</a>
          <a class="btn btn-success" href="index.php">Gestion Commande</a>
        <?php endif; ?>
        <a class="btn btn-danger" href="index.php?action=logOut">Déconnexion</a>
      <?php else: ?>
          <a class="btn btn-success" href="index.php?action=inscription">Inscription</a>
          <a class="btn btn-success" href="index.php?action=connexion">Connexion</a>
      <?php endif; ?>
    </nav>
  </header>
  <main class="container-fluid">

    <?php if( isset($_SESSION['message']) ): ?>
      <div id="messageInfo" class="bg-success text-white p-3 text-center my-2">
          <?= $_SESSION['message'] ?>
          <?php unset($_SESSION['message']); ?>
      </div>
    <?php endif; ?>

    <?= $content; ?>

  </main>
  <footer class="bg-dark text-white p-3 text-center mt-5">

    &copy; <?= Date('Y'); ?> - PROJET SIRA - GRETA

  </footer>
  <script src="public/js/messageFlash.js"></script>
  <script src="public/js/redirect.js"></script>
</body>
</html>
