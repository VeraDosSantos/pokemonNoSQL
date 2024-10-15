<?php
require_once(__DIR__ . "/partials/head.php");
?>
<h1>Bienvenue</h1>
<h2>Les pokemons</h2>
<?php
if(!empty($pokemons)) {
    foreach($pokemons as $pokemon) {
?>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Nom: <?= $pokemon->getName() ?></h5>
            <p class="card-text">Type: <?= $pokemon->getType() ?></p>
            <p class="card-text">Level: <?= $pokemon->getLevel() ?></p>
            <p class="card-text">description</p>
            <p class="card-text"><?= $pokemon->getDescription() ?></p>
        </div>
    </div>
<?php
    }
}
require_once(__DIR__ . "/partials/footer.php");
?>