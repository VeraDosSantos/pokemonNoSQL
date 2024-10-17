<?php
require_once(__DIR__ . "/../partials/head.php");
?>
<h1 class="text-center text-white fw-bold"><?= $myPokemon->getName() ?></h1>
<div class="container text-center text-white ">
    <p><strong>Type :</strong> <?= $myPokemon->getType() ?></p>
    <p><strong>Niveau :</strong> <?= $myPokemon->getLevel() ?></p>
    <p><strong>Description :</strong> <?= $myPokemon->getDescription() ?></p>
</div>
<div class="mt-5 container">
    <div class="row justify-content-center">
        <a class="btn btn-warning col-2 m-2" href="/updatePokemon?id=<?= $myPokemon->getId() ?>">Modifier 🪄</a>
        <a class="btn btn-light col-2 m-2" href="/">Retour ◀️</a>
    </div>
</div>
<?php
require_once(__DIR__ . "/../partials/footer.php");
?>
