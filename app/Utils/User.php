<?php

namespace P5universFabuleux\Utils;

use P5universFabuleux\Models\UserModel;

abstract class User
{
    /**
     * isConnected.
     */
    public static function isConnected(): bool
    {
        return
            // Si l'utilisateur est connecté
            array_key_exists('connected-user', $_SESSION) &&
            // Si l'utilisateur en session est un objet
            is_object($_SESSION['connected-user']) &&
            // Si l'ip de l'utilisateur n'a pas changé
            $_SESSION['connected-user-ip'] == $_SERVER['REMOTE_ADDR']
        ;
    }

    /**
     * getConnectedUser.
     */
    public static function getConnectedUser()
    {
        return $_SESSION['connected-user'];
    }

    /**
     * connect.
     *
     * @param UserModel $userModel
     */
    public static function connect(UserModel $userModel): bool
    {
        // Ajout le UserModel du user connecté en SESSION
        $_SESSION['connected-user'] = $userModel;
        // Je peux aussi stocker en session l'ip de l'utilisateur
        // afin d'éviter qu'un hacker usurpe sa session
        $_SESSION['connected-user-ip'] = $_SERVER['REMOTE_ADDR'];

        return true;
    }

    /**
     * disconnect.
     */
    public static function disconnect()
    {
        // Je vérifié déjà qu'il y ait un user connecté
        if (self::isConnected()) {
            // On supprime le user en SESSION
            unset($_SESSION['connected-user']);
            // Et on supprime aussi l'ip du user
            unset($_SESSION['connected-user-ip']);
        }
    }

    /**
     * isUser.
     */
    public static function isUser(): bool
    {
        if (array_key_exists('connected-user', $_SESSION) && is_object($_SESSION['connected-user'])) {
            return self::getConnectedUser()->getIs_user() == 1 ? true : false;
        } else {
            return false;
        }
    }
}
