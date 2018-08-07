<?php

namespace P5universFabuleux\Models;

use P5universFabuleux\Utils\Database;
use PDO;

class GameModel
{
    private $id;
    private $play_date;
    private $scores;
    private $game_time;

    /**
     * findAll.
     */
    public static function findAll()
    {
        $sql = '
            SELECT id, play_date, scores, game_time
            FROM stats
            ORDER BY play_date DESC
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();

        // On exécute la requête
        $pdoStatement = $pdo->query($sql);

        // Récupération des résultats sous forme de tableau d'objet
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        // On retourne les résultats
        return $results;
    }

    /**
     * findAllByPagination.
     *
     * @param mixed $page
     * @param mixed $nbPostByPage
     */
    public static function findAllByPagination($page, $nbPostByPage)
    {
        $start = ($page - 1) * $nbPostByPage;
        $sql = '
            SELECT id, play_date, scores, game_time
            FROM stats
            ORDER BY play_date DESC
            LIMIT '.$start.', '.$nbPostByPage.'
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();

        // On exécute la requête
        $pdoStatement = $pdo->query($sql);

        // Récupération des résultats sous forme de tableau d'objet
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

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
            SELECT id, play_date, scores, game_time
            FROM stats
            WHERE id = (:id)
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        // Association des valeurs aux champs de la bdd et paramètrage du retour
        $pdoStatement->bindValue(':idPost', $idPost, PDO::PARAM_INT);
        $pdoStatement->execute();

        return $pdoStatement->fetchObject(self::class);
    }

    /**
     * add.
     *
     * @param mixed $play_date
     * @param mixed $scores
     * @param mixed $game_time
     */
    public static function add($play_date, $scores, $game_time)
    {
        $sql = '
            INSERT INTO stats (play_date, scores, game_time)
            VALUES (NOW(), :scores, :game_time)
        ';

        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        // Association des valeurs aux champs de la bdd et paramètrage du retour
        $pdoStatement->bindValue(':play_date', $play_date, PDO::PARAM_STR);
        $pdoStatement->bindValue(':scores', $scores, PDO::PARAM_STR);
        $pdoStatement->bindValue(':game_time', $game_time, PDO::PARAM_STR);
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
     * Get the value of scores.
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * Set the value of scores.
     *
     * @return self
     */
    public function setScores($scores)
    {
        $this->scores = $scores;

        return $this;
    }

    /**
     * Get the value of games_time.
     */
    public function getGames_time()
    {
        return $this->games_time;
    }

    /**
     * Set the value of games_time.
     *
     * @return self
     */
    public function setGames_time($game_time)
    {
        $this->games_time = $game_time;

        return $this;
    }
}
