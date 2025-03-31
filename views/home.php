<?php
$mainContent = "Acceuil - Agence Immo";
$pageTitle = "Accueil";
ob_start();
?>

<section class="main-sections">
  <h2 class="main-sections-title">
    Hello world !
  </h2>

  <article class="main-articles">
    <h2 class="main-articles-title">
      Lorem
    </h2>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium facilis labore iure. Explicabo qui fugiat modi corrupti harum error cupiditate.
    </p>
  </article>
</section>

<?php
$mainContent = ob_get_clean();
