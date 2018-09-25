<?php

namespace P5universFabuleux\Models;

use P5universFabuleux\Utils\Database;
use PDO;

class AvatarModel
{
    private $id;
    private $avatar_picture;

    /**
     * findAll.
     */
    public static function findAll(): array
    {
        $sql = '
            SELECT id, avatar_picture
            FROM avatar
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();

        // On exécute la requête
        $pdoStatement = $pdo->query($sql);

        // Récupération des résultats sous forme de tableau d'objet UserModel
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

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
            FROM avatar
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
     * addAvatar.
     */
    public function addAvatar()
    {
        $sql = '
            INSERT INTO avatar (avatar_picture)
            VALUES (:avatar_picture)
        ';

        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        // Association des valeurs aux champs de la bdd et paramètrage du retour
        $pdoStatement->bindValue(':avatar_picture', $this->avatar_picture, PDO::PARAM_LOB);
        $pdoStatement->execute();
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
     * Get the value of avatar_picture.
     */
    public function getAvatar_picture()
    {
        return $this->avatar_picture;
    }

    /**
     * Set the value of avatar_picture.
     *
     * @return self
     */
    public function setAvatar_picture($avatar_picture)
    {
        $this->avatar_picture = $avatar_picture;

        return $this;
    }
}
