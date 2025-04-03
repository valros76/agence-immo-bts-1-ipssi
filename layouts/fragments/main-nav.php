<nav class="main-nav">
  <a href="/" class="main-menu-links">
    Acceuil
  </a>

  <a href="/about" class="main-menu-links">
    À propos
  </a>

  <?php 
    if(isset($_SESSION["user_id"])):
  ?>
  <a href="/user/profile" class="main-menu-links">
    Mon profil
  </a>
  <a href="/user/disconnect" class="main-menu-links">
    Déconnexion
  </a>
  <?php else: ?>
  <a href="/user/inscription" class="main-menu-links">
    Créer un compte
  </a>

  <a href="/user/connexion" class="main-menu-links">
    Se connecter
  </a>
  <?php 
    endif;
  ?>
</nav>