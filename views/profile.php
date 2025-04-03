<?php
$mainTitle = "Profil - PHP Immo";
$pageTitle = "Profil";
ob_start();
?>
<section class="main-sections">
  <article class="main-articles">
    <h2 class="main-articles-title">
      Profil de <?= $user->pseudo ?>
    </h2>
    <p>
      ID : <?= $user->id ?>
    </p>
    <p>
      Inscrit depuis le <?= $user->inscription_date ?>
    </p>

    <?php 
      if(isset($_SESSION["error"])):
    ?>
    <aside class="error-banner">
      <header>
        <p><strong>Erreur</strong></p>
      </header>
      <p><?= $_SESSION["error"] ?? null ?></p>
      <footer>
        <p><small>Gravité : Moyenne</small></p>
      </footer>
    </aside>
    <?php 
      unset($_SESSION["error"]);
      endif;
    ?>

    <details>
      <summary>
        Modifier toutes les informations du profil
      </summary>

      <form action="/user/modify" method="POST">
        <label for="pseudo">
          Pseudo
        </label>
        <input type="text" value="<?= $user->pseudo ?>" name="pseudo" id="pseudo"  />

        <label for="password">
          Mot de passe
        </label>
        <input type="password" name="password" id="password" required />

        <input type="hidden" value="<?= $user->id ?>" name="id" />

        <button type="submit">
          Modifier les informations
        </button>
      </form>
    </details>

    <details>
      <summary>
        Modifier le pseudo
      </summary>
      <form action="/user/modify/pseudo" method="POST">
        <label for="pseudo">
          Pseudo
        </label>
        <input type="text" value="<?= $user->pseudo ?>" name="pseudo" id="pseudo" required />

        <input type="hidden" value="<?= $user->id ?>" name="id" />

        <button type="submit">
          Modifier
        </button>
      </form>
    </details>
  </article>
</section>
<?php
$mainContent = ob_get_clean();
