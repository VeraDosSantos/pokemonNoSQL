<?php

namespace App\Controllers;

use App\Models\Pokemon;
use App\Utils\AbstractController;

class PokemonController extends AbstractController
{
    public function getPokemon(){
        if ($_GET['id']) {
            $idPokemon = $_GET['id'];
            $pokemon = new Pokemon($idPokemon, null, null, null, null);
            $myPokemon = $pokemon->getById();
            if ($myPokemon) {
                require_once __DIR__ . '/../Views/pokemon/pokemon.view.php';
            }else{
                $this->redirectToRoute('/');
            }
        }
    }

    public function addPokemon()
    {
        if(isset($_POST["name"])){
            $name = htmlspecialchars($_POST["name"]);
            $type = htmlspecialchars($_POST["type"]);
            $level = htmlspecialchars($_POST["level"]);
            $description = htmlspecialchars($_POST["description"]);

            $this->check('name', $name);
            $this->check('type', $type);
            $this->check('level', $level);
            $this->check('description', $description);

            if(empty($this->arrayError)){

                // Créer un objet Pokemon
                $pokemon = new Pokemon(null, $name, $type, $level, $description);

                // Enregistrer le Pokémon dans la base de données
                if ($pokemon->save()) {
                    // Redirection vers une page de succès ou afficher un message de succès
                    $this->redirectToRoute('/');
                } else {
                    echo "Erreur lors de l'ajout du Pokémon.";
                }
            }
        }
        require_once (__DIR__ . "/../Views/pokemon/createPokemon.view.php");
    }

    public function updatePokemon()
    {
        if ($_GET['id']) {
            $idPokemon = $_GET['id'];
            $pokemon = new Pokemon($idPokemon, null, null, null, null);
            $myPokemon = $pokemon->getById();

            if ($myPokemon) {
                if (isset($_POST['name'])) {
                    // Récupérer les données du formulaire
                    $name = $_POST['name'];
                    $type = $_POST['type'];
                    $level = $_POST['level'];
                    $description = $_POST['description'] ?? '';

                    // Valider les données (par exemple, vérifier que les champs ne sont pas vides)
                    $this->check('name', $name);
                    $this->check('type', $type);
                    $this->check('level', $level);

                    if (empty($this->arrayError)) {

                        // Créer une instance de Pokémon avec les données mises à jour
                        $pokemon = new Pokemon($idPokemon, $name, $type, $level, $description);
                        // Appeler la méthode update()
                        if ($pokemon->update()) {
                            // Rediriger ou afficher un message de succès
                            $this->redirectToRoute('/');
                        } else {
                            // Gérer l'erreur de mise à jour
                            echo "Erreur lors de la mise à jour du Pokémon.";
                        }
                    }
                }
                require_once __DIR__ . '/../Views/pokemon/updatePokemon.view.php';
            }
        }
    }

    public function deletePokemon()
    {
        if (isset($_POST['id'])) {
            $idPokemon = $_POST['id'];
            $pokemon = new Pokemon($idPokemon, null, null, null, null);

            // Appeler la méthode delete()
            if ($pokemon->delete()) {
                // Rediriger ou afficher un message de succès
                $this->redirectToRoute('/'); // Par exemple, redirige vers la liste
            } else {
                // Gérer l'erreur de suppression
                echo "Erreur lors de la suppression du Pokémon.";
            }
        }
    }
}
