<?php

namespace univers_fabuleux\Models;

use univers_fabuleux\Utils\Database;
use PDO;

class StatsModel
{
    private $id;
    private $game_name;
    private $play_date;
    private $game_mode;
    private $score;
    private $game_time;
    private $user_id;

    /**
     * findAll.
     */
    public static function findAll()
    {
        $sql = '
            SELECT *
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
     * findBestScore.
     *
     * @param mixed $user_id
     */
    public static function findBestScore($game_name, $user_id)
    {
        $sql = '
            SELECT * 
            FROM stats
            WHERE game_name = :game_name AND user_id = :user_id 
            ORDER BY score DESC, game_time ASC 
            LIMIT 1
        ';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        // Association des valeurs aux champs de la bdd et paramètrage du retour
        $pdoStatement->bindValue(':game_name', $game_name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $pdoStatement->execute();

        return $pdoStatement->fetchObject(self::class);
    }

    /**
     * findNewScore.
     *
     * @param mixed $user_id
     */
    public static function findNewScore($game_name, $user_id)
    {
$sql = '
    SELECT * 
    FROM stats
    WHERE game_name = :game_name AND user_id = :user_id 
    ORDER BY id DESC 
    LIMIT 1
';
        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        // Association des valeurs aux champs de la bdd et paramètrage du retour
        $pdoStatement->bindValue(':game_name', $game_name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $pdoStatement->execute();

        return $pdoStatement->fetchObject(self::class);
    }

    /**
     * add.
     *
     * @param mixed $play_date
     * @param mixed $score
     * @param mixed $game_time
     */
    public function add()
    {
        $sql = '
            INSERT INTO stats (game_name, play_date, game_mode, score, game_time, user_id)
            VALUES (:game_name, :play_date, :game_mode, :score, :game_time, :user_id)
        ';

        // On récupère la connextion PDO à la DB
        $pdo = Database::dbConnect();
        // On prépare une requête à l'exécution et retourne un objet
        $pdoStatement = $pdo->prepare($sql);
        // Association des valeurs aux champs de la bdd et paramètrage du retour
        $pdoStatement->bindValue(':game_name', $this->game_name, PDO::PARAM_INT);
        $pdoStatement->bindValue(':play_date', $this->play_date, PDO::PARAM_STR);
        $pdoStatement->bindValue(':game_mode', $this->game_mode, PDO::PARAM_STR);
        $pdoStatement->bindValue(':score', $this->score, PDO::PARAM_STR);
        $pdoStatement->bindValue(':game_time', $this->game_time, PDO::PARAM_STR);
        $pdoStatement->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
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
     * Get the value of game_name.
     */
    public function getGame_name()
    {
        return $this->game_name;
    }

    /**
     * Set the value of game_name.
     *
     * @return self
     */
    public function setGame_name($game_name)
    {
        $this->game_name = $game_name;

        return $this;
    }

    /**
     * Get the value of play_date.
     */
    public function getPlay_date()
    {
        date_default_timezone_set('Europe/Paris');
        $datetime = null;
        $ts = strtotime($datetime.' GMT');

        return strftime($this->play_date, $datetime);
    }

    /**
     * Set the value of play_date.
     *
     * @return self
     */
    public function setPlay_date($play_date)
    {
        $this->play_date = $play_date;

        return $this;
    }

    /**
     * Get the value of game_mode.
     */
    public function getGame_mode()
    {
        return $this->game_mode;
    }

    /**
     * Set the value of game_mode.
     *
     * @return self
     */
    public function setGame_mode($game_mode)
    {
        $this->game_mode = $game_mode;

        return $this;
    }

    /**
     * Get the value of score.
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set the value of score.
     *
     * @return self
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get the value of game_time.
     */
    public function getGame_time()
    {
        return $this->game_time;
    }

    /**
     * Set the value of game_time.
     *
     * @return self
     */
    public function setGame_time($game_time)
    {
        $this->game_time = $game_time;

        return $this;
    }

    /**
     * Get the value of user_id.
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id.
     *
     * @return self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }
}
