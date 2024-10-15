<?php

namespace App\Models;

use Config\Database;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Exception\Exception;
use MongoDB\Driver\Query;

class Pokemon
{
    protected ?string $id;
    protected ?string $name;
    protected ?string $type;
    protected ?int $level;
    protected ?string $description;

    public function __construct(?string $id, ?string $name, ?string $type, ?int $level, ?string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->level = $level;
        $this->description = $description;
    }

    public function setId(?string $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;
        return $this;
    }
    public function setType(?string $type): static
    {
        $this->type = $type;
        return $this;
    }
    public function setLevel(?int $level): static
    {
        $this->level = $level;
        return $this;
    }
    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function getType(): ?string
    {
        return $this->type;
    }
    public function getLevel(): ?int
    {
        return $this->level;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function save(): bool
    {
        $mongo = Database::getConnection();
        $dataBase = "pokemon_db";
        $collection = "pokemons";

        // Préparer les données du Pokémon à insérer
        $data = [
            "name" => $this->name,
            "type" => $this->type,
            "level" => $this->level,
            "description" => $this->description
        ];

        //creation d'un objet
        $bulk = new BulkWrite();
        //insere le document dans la base
        $bulk->insert($data);

        try {
            //Executer la requete
            $mongo->executeBulkWrite($dataBase . "." . $collection, $bulk);
            return true;
        } catch (Exception $e){
            return false;
        }
    }

    public function getAll(): array
    {
        $mongo = Database::getConnection();
        $dataBase = "pokemon_db";
        $collection = "pokemons";

        // Préparer la requête pour récupérer tous les documents
        $query = new Query([]);
        $pokemons = [];

        try {
            // Exécuter la requête
            $cursor = $mongo->executeQuery($dataBase . "." . $collection, $query);

            // Récupérer les résultats
            $results = $cursor->toArray();

            foreach ($results as $data) {
                $pokemons[] = new Pokemon($data->_id, $data->name, $data->type, $data->level, $data->description);
            }

            return $pokemons;

        }catch (Exception $e){
            // Retourner un tableau vide en cas d'erreur
            return [];
        }
    }

    // Méthode pour récupérer un Pokémon par son ID
    public function getById(): ?Pokemon
    {
        $mongo = Database::getConnection();
        $dataBase = "pokemon_db";
        $collection = "pokemons";

        $id = $this->id;

        // Préparer la requête pour récupérer le document par ID
        $filter = ['_id' => new \MongoDB\BSON\ObjectID($id)];
        $query = new Query($filter);

        try {
            //Executer la requête
            $cursor = $mongo->executeQuery($dataBase . "." . $collection, $query);
            $result = $cursor->toArray();

            // Vérifier si un résultat a été trouvé
            if (!empty($result)) {
                return new Pokemon($result[0]->_id, $result[0]->name, $result[0]->type, $result[0]->level, $result[0]->description);
            }
            return null;

        } catch (Exception $e) {
            return null;
        }
    }

    // Méthode pour mettre à jour un Pokémon dans la base de données
    public function update(): bool
    {
        $mongo = Database::getConnection();
        $dataBase = "pokemon_db";
        $collection = "pokemons";

        // Préparer les données du Pokémon à mettre à jour
        $data = [
            'name' => $this->name,
            'type' => $this->type,
            'level' => $this->level,
            'description' => $this->description
        ];

        // Création d'un objet BulkWrite pour la mise à jour
        $bulk = new BulkWrite();

        // Spécifier le filtre pour trouver le document à mettre à jour par ID
        $filter = ['_id' => new \MongoDB\BSON\ObjectId($this->id)];

        // Spécifier l'opération de mise à jour
        $bulk->update($filter, ['$set' => $data]);

        try {
            // Exécuter la requête
            $mongo->executeBulkWrite($dataBase . "." . $collection, $bulk);
            return true; // Retourne true si la mise à jour a réussi
        } catch (Exception $e) {
            return false; // Retourne false en cas d'erreur
        }
    }

    // Méthode pour supprimer un Pokémon par son ID dans la base de données
    public function delete(): bool
    {
        $mongo = Database::getConnection();
        $dataBase = "pokemon_db";
        $collection = "pokemons";

        // Création d'un objet BulkWrite pour la suppression
        $bulk = new BulkWrite();

        // Spécifier le filtre pour trouver le document à supprimer par ID
        $filter = ['_id' => new \MongoDB\BSON\ObjectId($this->id)];

        // Ajouter l'opération de suppression
        $bulk->delete($filter);

        try {
            // Exécuter la requête
            $mongo->executeBulkWrite($dataBase . "." . $collection, $bulk);
            return true; // Retourne true si la suppression a réussi
        } catch (Exception $e) {
            return false; // Retourne false en cas d'erreur
        }
    }

}
