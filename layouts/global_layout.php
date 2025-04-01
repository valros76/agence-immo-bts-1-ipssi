<?php
  $actualDate = new DateTime();
  $actualDate = $actualDate->format("Y");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $mainTitle ?? "Agence immo" ?></title>
  <meta name="description" content="Agence immobilière - Projet d'entraînement PHP">
  <link rel="stylesheet" href="/sources/css/init.css?v=<?= filemtime("sources/css/init.css") ?>">
</head>
<body>
  <header class="main-head">
    <h1 class="main-head-title">
      <?= $pageTitle ?? "PHP Immo" ?>
    </h1>
  </header>

  <?php include_once "layouts/fragments/main-nav.php" ?>

  <main class="main-content">
    <?= $mainContent ?? "Erreur de chargement des données"?>
  </main>

  <footer class="main-foot">
    <p class="copyright">
      © Webdevoo - <?= $actualDate === "2025" ? $actualDate : "2025 à {$actualDate}" ?>
    </p>
  </footer>

  <?= $addScripts ?? null ?>
</body>
</html>