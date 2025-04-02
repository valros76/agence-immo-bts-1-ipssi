<?php
$mainTitle = "Connexion utilisateur - PHP Immo";
$pageTitle = "Connexion";
ob_start();
?>
  <section class="main-sections">
  <form action="/user/connect" method="POST">
    <label for="pseudo">
      Pseudo
    </label>
    <input type="text" name="pseudo" id="pseudo" required />

    <label for="password">
      Mot de passe
    </label>
    <input type="password" name="password" id="password" required />

    <button type="submit">
      Se connecter
    </button>
  </form>
</section>
<?php
$mainContent = ob_get_clean();