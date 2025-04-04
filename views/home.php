<?php
$mainContent = "Acceuil - Agence Immo";
$pageTitle = "Accueil Casino Royal";
if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 1000;
}
ob_start();
?>

<section class="main-sections">
  <h1 class="main-sections-title">
    CASINO ROYAL
  </h1>

  <article class="container">
    <div class="slot-container">
      <h2 class="main-articles-center">
        🤑BIG WIN🤑 SLOT MACHINE
      </h2>
      <h3 id="balance">
        Balance: <?= $_SESSION['balance'] ?>€
      </h3>
      <article class="slot-machine"> 
        <div class="reel" id="reel1">🍒</div> 
        <div class="reel" id="reel2">🍒</div> 
        <div class="reel" id="reel3">🍒</div> 
      </article> 
      <button id="spinButton">SPIN</button>
      <input type="number" id="mise" placeholder="Mise" value="10" min="1">
      <div id="result"></div>
    </div>
    <img src="/sources/img/Gamble-motivation.jpg" alt="Gamble-motivation-img" class="Gamble-motivation-img">
  </article>
</section>
<script src="/sources/js/SlotScrip.js"></script>
<?php
$mainContent = ob_get_clean();