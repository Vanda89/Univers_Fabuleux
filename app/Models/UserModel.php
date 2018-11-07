<?php

namespace P5universFabuleux\Models;

use P5universFabuleux\Utils\Database;
use PDO;

class UserModel
{
    private $id;
    private $firstname;
    private $birthday;
    private $mail;
    private $password;
    private $is_admin;
    private $theme_id;
    private $avatar_id;

    /**
     * findAll.
     */
    public static function findAll(): array
    {
        $sql = '
            SELECT *
            FROM user
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
     * find.
     *
     * @param mixed $id
     */
    public static function find(int $id)
    {
        $sql = '
            SELECT *
            FROM user
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
     * findByMail.
     *
     * @param string $mail
     */
    public static function findByMail(string $mail)
    {
        $sql = '
            SELECT *
            FROM user
            WHERE mail = :mail
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':mail', $mail, PDO::PARAM_STR);
        $pdoStatement->execute();

        return $pdoStatement->fetchObject(self::class);
    }

    /**
     * findByFirstname.
     *
     * @param string $firstname
     */
    public static function findByFirstname(string $firstname)
    {
        $sql = '
            SELECT *
            FROM user
            WHERE firstname = :firstname
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $pdoStatement->execute();

        return $pdoStatement->fetchObject(self::class);
    }

    /**
     * add.
     */
    public function add()
    {
        $sql = '
            INSERT INTO user (firstname, birthday, mail, password, is_admin, avatar_id)
            VALUES (:firstname, :birthday, :mail, :password, :is_admin, :avatar_id)
        ';

        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        // Association des valeurs aux champs de la bdd et paramètrage du retour
        $pdoStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $pdoStatement->bindValue(':birthday', $this->birthday, PDO::PARAM_STR);
        $pdoStatement->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $pdoStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $pdoStatement->bindValue(':is_admin', $this->is_admin, PDO::PARAM_INT);
        $pdoStatement->bindValue(':avatar_id', $this->avatar_id, PDO::PARAM_INT);
        $pdoStatement->execute();
    }

    /**
     * updateInfos.
     *
     * @param mixed $firstname
     * @param mixed $birthday
     * @param mixed $theme
     * @param mixed $mail
     */
    public function updateInfos()
    {
        $sql = '
            UPDATE user
            SET firstname = :firstname, birthday = :birthday, mail = :mail, theme_id = :theme_id, avatar_id = :avatar_id
            WHERE id = :id
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect($sql);
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        // Association des valeurs aux champs de la bdd et paramètrage du retour
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $pdoStatement->bindValue(':birthday', $this->birthday, PDO::PARAM_STR);
        $pdoStatement->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $pdoStatement->bindValue(':theme_id', $this->theme_id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':avatar_id', $this->avatar_id, PDO::PARAM_INT);
        $pdoStatement->execute();

        // Contrôle pour vérifier si les données ont bien été modifiées
        $affectedRows = $pdoStatement->rowCount();

        return $affectedRows > 0;
    }

    /**
     * updatePassword.
     *
     * @param mixed $password
     */
    public function updatePassword($password)
    {
        $sql = '
            UPDATE user
            SET password = :password
            WHERE id = :id
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect($sql);
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        // Association des valeurs aux champs de la bdd et paramètrage du retour
        $pdoStatement->bindValue(':password', $password, PDO::PARAM_STR);
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
     * Get the value of firstname.
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname.
     *
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of birthday.
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set the value of birthday.
     *
     * @return self
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get the value of mail.
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail.
     *
     * @return self
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of password.
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password.
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of is_admin.
     */
    public function getIs_admin()
    {
        return $this->is_admin;
    }

    /**
     * Set the value of is_admin.
     *
     * @return self
     */
    public function setIs_admin($is_admin)
    {
        $this->is_admin = $is_admin;

        return $this;
    }

    /**
     * Get the value of theme_id.
     */
    public function getTheme_id()
    {
        return $this->theme_id;
    }

    /**
     * Set the value of theme_id.
     *
     * @return self
     */
    public function setTheme_id($theme_id)
    {
        $this->theme_id = $theme_id;

        return $this;
    }

    /**
     * Get the value of avatar_id.
     */
    public function getAvatar_id()
    {
        return $this->avatar_id;
    }

    /**
     * Set the value of avatar_id.
     *
     * @return self
     */
    public function setAvatar_id($avatar_id)
    {
        $this->avatar_id = $avatar_id;

        return $this;
    }
}
