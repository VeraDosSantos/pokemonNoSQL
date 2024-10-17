<?php
require_once(__DIR__ . "/partials/head.php");
?>
<h1 class="text-center text-warning fw-bold m-2">Bienvenue</h1>
<h2 class="text-center text-white fw-bold m-2 mb-5">Les pokemons</h2>
    <div class="container text-center">
        <div class="row justify-content-around">
            <?php
            if(!empty($pokemons)) {
                foreach($pokemons as $pokemon) {
            ?>
            <div class="col-4 mt-4 mb-4">
                <div class="card myCard" style="width: 18rem;">
                    <div class="card-body">
                        <h3 class="card-title text-center">Nom: <strong class="text-success"><?= $pokemon->getName() ?></strong></h3>
                        <p class="card-text d-flex justify-content-between">
                            <span>Type: <?= $pokemon->getType() ?></span>
                            <span>Level: <?= $pokemon->getLevel() ?></span>
                        </p>
                        <hr class="border border-success border-2 opacity-50">
                        <p class="card-text fw-lighter"><?= $pokemon->getDescription() ?></p>
                        <hr class="border border-success border-2 opacity-50">
                        <a href="/pokemon?id=<?= $pokemon->getId() ?>" class="btn btn-warning m-1">Voir ➕</a>
                        <a href="/updatePokemon?id=<?= $pokemon->getId() ?>" class="btn btn-danger m1">Modifier 🪄</a>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
<?php
require_once(__DIR__ . "/partials/footer.php");
?>