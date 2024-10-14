<?php

namespace Config;

use MongoDB\Driver\Manager;
use MongoDB\Driver\Exception\Exception;

class Database
{
    static function getConnection()
    {
        try {
            // Crée un gestionnaire MongoDB pour la connexion locale par défaut (ou modifiez l'URI selon vos besoins)
            $mongo = new Manager("mongodb://localhost:27017");
        } catch (Exception $e) {
            // En cas d'erreur, affiche un message et arrête l'exécution du script
            die('Erreur : ' . $e->getMessage());
        }
        // Retourne l'objet Manager pour l'utiliser dans les opérations MongoDB
        return $mongo;
    }
}
