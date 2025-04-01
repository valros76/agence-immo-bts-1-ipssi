<?php
$mainTitle = "À propos de PHP Immo";
$pageTitle = "📖";
ob_start();
?>
<sections class="main-sections">
  <article class="main-articles">
    <h2 class="main-articles-title">
      L'Origine d'une Vision d'Exception
    </h2>
    <p>
      Notre agence est née d'une ambition : offrir une expérience de location haut de gamme à ceux qui recherchent bien plus qu'un simple logement à Paris. Passionnés par l'immobilier de prestige et le raffinement à la française, nous avons bâti notre expertise en sélectionnant des résidences d'exception dans les quartiers les plus prisés de la capitale. Chaque propriété que nous proposons est choisie avec le plus grand soin pour offrir une combinaison parfaite entre élégance, confort et services exclusifs.
    </p>
  </article>

  <article class="main-articles">
    <h2 class="main-articles-title">
      Un Savoir-Faire au Service de l'Excellence
    </h2>
    <p>
      Fort d'années d'expérience et d'un réseau prestigieux, notre agence s'est imposée comme une référence incontournable dans la location de biens de luxe à Paris. Nous travaillons en étroite collaboration avec des propriétaires exigeants, des designers d'intérieur et des partenaires de confiance pour garantir à nos clients une offre unique et sur-mesure. Chaque détail est pensé pour répondre aux attentes d'une clientèle internationale, habituée aux standards les plus élevés.
    </p>
  </article>

  <article class="main-articles">
    <h2 class="main-articles-title">
      Une Expérience Unique, Taillée pour Vous
    </h2>
    <p>
      Notre mission ne se limite pas à la mise à disposition de résidences prestigieuses. Nous mettons un point d'honneur à offrir un accompagnement discret et personnalisé, répondant aux besoins spécifiques de chaque client. De la sélection du bien parfait à la mise en place de services haut de gamme - conciergerie privée, personnel de maison, chauffeurs - nous créons des séjours d'exception, où chaque instant se vit dans le confort et la sérénité. Parce que choisir Paris, c'est choisir le luxe à la française, nous faisons de chaque location une expérience inoubliable.
    </p>
  </article>
</sections>
<?php
$mainContent = ob_get_clean();
