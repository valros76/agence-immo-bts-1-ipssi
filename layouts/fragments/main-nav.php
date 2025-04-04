
<nav class="main-nav">
  <a href="/" class="main-menu-links">
    
  </a>

  <a href="/about" class="main-menu-links">
    
  </a>

  <?php 
    if(isset($_SESSION["user_id"])):
  ?>
  <a href="/user/profile" class="main-menu-links">
    
  </a>
  <a href="/user/disconnect" class="main-menu-links">
    
  </a>
  <?php else: ?>
  <a href="/user/inscription" class="main-menu-links">
    
  </a>

  <a href="/user/connexion" class="main-menu-links">
    
  </a>
  <?php 
    endif;
  ?>
</nav>