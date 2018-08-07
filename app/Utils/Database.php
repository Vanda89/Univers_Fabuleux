<?php

namespace P5universFabuleux\Utils;

use PDO;

//Singleton
class Database
{
    /** @var PDO */
    private $dbh;
    private static $_instance;

    private function __construct()
    {
        // Récupération des données du fichier de config
        // la fonction parse_ini_file parse le fichier et retourne un array associatif
        $configData = parse_ini_file(__DIR__.'/../config.conf');

        try {
            $this->dbh = new PDO(
                "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};charset=utf8",
                $configData['DB_USERNAME'],
                $configData['DB_PASSWORD'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) // Affiche les erreurs SQL à l'écran
            );
        } catch (\Exception $exception) {
            echo 'Erreur de connexion...<br>';
            echo $exception->getMessage().'<br>';
            echo '<pre>';
            echo $exception->getTraceAsString();
            echo '</pre>';
            exit;
        }
    }

    // Création de la connexion à la Database si non existante
    public static function dbConnect()
    {
        if (empty(self::$_instance)) {
            self::$_instance = new Database();
        }

        return self::$_instance->dbh;
    }
}
