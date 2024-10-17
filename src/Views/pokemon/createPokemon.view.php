<?php
require_once(__DIR__ . "/../partials/head.php");
?>
    <h1 class="text-center text-white">Formulaire Pokemon</h1>
    <form method="POST">
        <div class="col-md-4 mx-auto d-block mt-5">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold text-white">Nom :</label>
                <input type="text" id="name" name="name" class="form-control">
                <?php if (isset($this->arrayError['name'])) {
                    ?>
                    <p class='text-danger'><?= $this->arrayError['name'] ?></p>
                    <?php
                } ?>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label fw-bold text-white">Type :</label>
                <select class="form-select" id="type" name="type">
                    <option value="Feu">Feu</option>
                    <option value="Eau">Eau</option>
                    <option value="Plante">Plante</option>
                    <option value="Electrik">ElectriK</option>
                    <option value="Glace">Glace</option>
                    <option value="Poisson">Poisson</option>
                </select>
                <?php if (isset($this->arrayError['type'])) {
                    ?>
                    <p class='text-danger'><?= $this->arrayError['type'] ?></p>
                    <?php
                } ?>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label fw-bold text-white">Niveau :</label>
                <input type="number" id="level" name="level" class="form-control">
                <?php if (isset($this->arrayError['level'])) {
                    ?>
                    <p class='text-danger'><?= $this->arrayError['level'] ?></p>
                    <?php
                } ?>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold text-white">Description :</label>
                <textarea id="description" name="description" rows="4" class="form-control"></textarea>
                <?php if (isset($this->arrayError['description'])) {
                    ?>
                    <p class='text-danger'><?= $this->arrayError['description'] ?></p>
                    <?php
                } ?>
            </div>
            <button class="btn btn-light mt-5 mx-auto d-block fw-bold p-2" type="submit">✨Ajouter le Pokémon✨</button>
        </div>
    </form>
<?php
require_once(__DIR__ . "/../partials/footer.php");
?>