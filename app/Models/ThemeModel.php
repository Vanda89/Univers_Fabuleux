<?php

namespace P5universFabuleux\Models;

use P5universFabuleux\Utils\Database;
use PDO;

class ThemeModel
{
    private $id;
    private $name;
    private $style;

    /**
     * findAll.
     */
    public static function findAll(): array
    {
        $sql = '
            SELECT *
            FROM theme
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();

        // On exécute la requête
        $pdoStatement = $pdo->query($sql);

        // Récupération des résultats sous forme de tableau d'objet UserModel
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);

        // On retourne les résultats
        return $results;
    }

    /**
     * findAllName.
     */
    public static function findAllName(): array
    {
        $sql = '
            SELECT name
            FROM theme
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();

        // On exécute la requête
        $pdoStatement = $pdo->query($sql);

        // Récupération des résultats sous forme de tableau d'objet UserModel
        $results = $pdoStatement->fetchAll(PDO::FETCH_COLUMN);

        // On retourne les résultats
        return $results;
    }

    /**
     * findAllStyle.
     */
    public static function findAllStyle(): array
    {
        $sql = '
            SELECT style
            FROM theme
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();

        // On exécute la requête
        $pdoStatement = $pdo->query($sql);

        // Récupération des résultats sous forme de tableau d'objet UserModel
        $results = $pdoStatement->fetchAll(PDO::FETCH_COLUMN);

        // On retourne les résultats
        return $results;
    }

    /**
     * find.
     *
     * @param mixed $id
     */
    public static function find(int $id)
    {
        $sql = '
            SELECT *
            FROM theme
            WHERE id = (:id)
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        // Association des valeurs aux champs de la bdd et paramètrage du retour
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();

        // Récupération du résultat sous forme d'objet FQCN
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
