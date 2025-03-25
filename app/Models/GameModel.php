<?php

namespace univers_fabuleux\Models;

use univers_fabuleux\Utils\Database;
use PDO;

class GameModel
{
    private $id;
    private $name;
    private $style;

    /**
     * findAll.
     */
    public static function findAll()
    {
        $sql = '
            SELECT *
            ORDER BY name 
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();

        // On exécute la requête
        $pdoStatement = $pdo->query($sql);

        // Récupération des résultats sous forme de tableau d'objet
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);

        // On retourne les résultats
        return $results;
    }

    /**
     * find.
     *
     * @param mixed $id
     */
    public static function find($id)
    {
        $sql = '
            SELECT *
            FROM game
            WHERE id = (:id)
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        // Association des valeurs aux champs de la bdd et paramètrage du retour
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();

        return $pdoStatement->fetchObject(self::class);
    }

    /**
     * Get the value of id.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id.
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name.
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of style.
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set the value of style.
     *
     * @return self
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }
}
