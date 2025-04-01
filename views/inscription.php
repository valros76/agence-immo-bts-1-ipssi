<?php
$mainTitle = "Inscription utilisateur - PHP Immo";
$pageTitle = "Inscription";
ob_start();
?>

<section class="main-sections">
  <form action="/user/add" method="POST">
    <label for="pseudo">
      Pseudo
    </label>
    <input type="text" name="pseudo" id="pseudo" required />

    <label for="password">
      Mot de passe
    </label>
    <input type="password" name="password" id="password" required />

    <button type="submit">
      S'inscrire
    </button>
  </form>
</section>

<?php
$mainContent = ob_get_clean();
