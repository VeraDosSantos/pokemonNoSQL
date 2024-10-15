<?php

namespace App\Controllers;

use App\Models\Pokemon;
use App\Utils\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        // Créer une instance du modèle Pokémon
        $pokemon = new Pokemon(null, null, null, null, null);

        // Récupérer tous les Pokémon
        $pokemons = $pokemon->getAll();

        require_once(__DIR__ . '/../Views/home.view.php');
    }
}
