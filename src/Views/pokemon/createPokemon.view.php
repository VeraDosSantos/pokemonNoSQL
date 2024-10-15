<?php
require_once(__DIR__ . "/../partials/head.php");
?>
    <h1>Formulaire Pokemon</h1>
    <form method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" >
        <?php if (isset($this->arrayError['name'])) {
            ?>
            <p class='text-danger'><?= $this->arrayError['name'] ?></p>
            <?php
        } ?>
        <label for="type">Type :</label>
        <input type="text" id="type" name="type" >
        <?php if (isset($this->arrayError['type'])) {
            ?>
            <p class='text-danger'><?= $this->arrayError['type'] ?></p>
            <?php
        } ?>
        <label for="level">Niveau :</label>
        <input type="number" id="level" name="level" min="1" >
        <?php if (isset($this->arrayError['level'])) {
            ?>
            <p class='text-danger'><?= $this->arrayError['level'] ?></p>
            <?php
        } ?>
        <label for="description">Description :</label>
        <textarea id="description" name="description" rows="4"></textarea>
        <?php if (isset($this->arrayError['description'])) {
            ?>
            <p class='text-danger'><?= $this->arrayError['description'] ?></p>
            <?php
        } ?>
        <button type="submit">Ajouter le Pokémon</button>
    </form>
<?php
require_once(__DIR__ . "/../partials/footer.php");
?>