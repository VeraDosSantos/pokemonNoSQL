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

    public function getAll()
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
}
