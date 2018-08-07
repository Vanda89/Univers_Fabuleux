<?php

namespace P5universFabuleux\Controllers;

use P5universFabuleux\Models\UserModel;
use P5universFabuleux\Utils\User;

class UserController extends CoreController
{
    public function signup()
    {
        $this->show('user/registration');
    }

    public function signupSubmit()
    {
        // Tableau contenant toutes les erreurs
        $errorList = [];

        // formulaire soumis
        if (!empty($_POST)) {
            //dump($_POST);exit;
            // Je récupère les données
            $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
            $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
            $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
            $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $passwordConfirm = isset($_POST['passwordConfirm']) ? $_POST['passwordConfirm'] : '';

            // Je traite les données si besoin
            $firstname = trim($firstname);
            $birthday = trim($birthday);
            $mail = trim($mail);
            $password = trim($password);
            $passwordConfirm = trim($passwordConfirm);

            // Je valide les données => je cherche les erreurs
            if (empty($firstname) || empty($birthday) || empty($sex) || empty($mail) || empty($password) || empty($passwordConfirm)) {
                $errorList[] = 'Tous les champs sont obligatoires.';
            }

            if (filter_var($mail, FILTER_VALIDATE_EMAIL) === false) {
                $errorList[] = 'Adresse mail invalide';
            }

            if (strlen($password) < 8) {
                $errorList[] = 'Le mot de passe doit faire au moins 8 caractères';
            }

            if (!empty($mail) && UserModel::findByMail($mail)) {
                $errorList[] = 'Cette adresse email existe déjà !';
            }

            if ($password != $passwordConfirm) {
                $errorList[] = 'Les 2 mots de passe sont doivent être identiques';
            }

            // Si tout est ok (aucune erreur)
            if (empty($errorList)) {
                // Je hash/encode le mot de passe
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                // On insert en DB
                $newUserModel = new UserModel();
                $newUserModel->setFirstname($firstname);
                $newUserModel->setBirthday($birthday);
                $newUserModel->setSex($sex);
                $newUserModel->setMail($mail);
                $newUserModel->setPassword($hashedPassword);
                $newUserModel->setIs_user(1);
                $newUserModel->add();

                // Sauvegarde en Session de l'user
                User::connect($newUserModel);
                // On envoie un JSON avec l'url du home pour la redirection
                $this->sendJson([
                     'code' => 1,
                        'redirect' => $this->router->generate('main_home'),
                        'errorList' => $errorList,
                        'type' => 'signup',
                ]);
            }

            // Envoi du JSON avec la liste des erreurs
            $this->sendJson([
            'code' => 2,
            'errorList' => $errorList,
            'type' => 'signup',
            ]);
        }
    }

    public function login()
    {
        // Exécute la view
        $this->show('user/connection');
    }

    public function loginSubmit()
    {
        // Tableau contenant toutes les erreurs
        $errorList = [];

        // formulaire soumis
        if (!empty($_POST)) {
            //dump($_POST);exit;

            // Je récupère les données
            $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            // Je traite les données si besoin
            $mail = trim($mail);
            $password = trim($password);

            // Je valide les données => je cherche les erreurs
            if (filter_var($mail, FILTER_VALIDATE_EMAIL) === false || strlen($password) < 8) {
                $errorList[] = 'Identifiant ou mot de passe incorrect.';
            }

            if (empty($mail) || empty($password)) {
                $errorList[] = 'Tous les champs sont obligatoires.';
            }

            // Si tout est ok (aucune erreur)
            if (empty($errorList)) {
                // On va cherche le user pour l'email fourni
                $userModel = UserModel::findByMail($mail);
                // dump($userModel);exit;

                // Si l'email existe
                if ($userModel !== false) {
                    // Alors, on va tester le password
                    if (password_verify($password, $userModel->getPassword())) {
                        // Je connecte l'utilisateur, peut importe comme cela est fait
                        User::connect($userModel);

                        // On envoie un JSON avec l'url du home pour la redirection
                        $this->sendJson([
                        'code' => 1,
                        'redirect' => $this->router->generate('main_home'),
                        'errorList' => $errorList,
                        'type' => 'login',
                        ]);
                    } else {
                        $errorList[] = 'Identifiants/mot de passe non reconnus';
                    }
                } else {
                    $errorList[] = 'Email non reconnu';
                }
            }

            // Envoi du JSON avec la liste des erreurs
            $this->sendJson([
            'code' => 2,
            'errorList' => $errorList,
            'type' => 'login',
            ]);
        }
    }

    public function logout()
    {
        // Je déconnecte le user
        User::disconnect();

        // Je redirige vers la home
        $this->redirectToRoute('main_home');
    }

    public function profile()
    {
        $user = User::isConnected() ? User::getConnectedUser() : false;
        // dump($user);
        $sexList = [
            'Fille' => ($user->getSex() === 'Fille') ? 'selected' : '',

            'Garçon' => ($user->getSex() === 'Garçon') ? 'selected' : '',

            'Autre' => ($user->getSex() === 'Autre') ? 'selected' : '',
        ];

        $themeList = [
            'Arc-en-ciel' => ($user->getTheme() === 'Arc-en-ciel') ? 'selected' : '',

            'Plage' => ($user->getTheme() === 'Plage') ? 'selected' : '',

            'Ferme' => ($user->getTheme() === 'Ferme') ? 'selected' : '',

            'Château fleuri' => ($user->getTheme() === 'Château fleuri') ? 'selected' : '',

            'Jungle' => ($user->getTheme() === 'Jungle') ? 'selected' : '',

            'Espace' => ($user->getTheme() === 'Espace') ? 'selected' : '',

            'Mountain' => ($user->getTheme() === 'Mountain') ? 'selected' : '',
        ];

        $dataToViews = [
            'sexList' => $sexList,
            'themeList' => $themeList,
        ];

        // Exécute la view
        $this->show('user/profile', $dataToViews);
    }

    public function saveProfile()
    {
        // Tableau contenant toutes les erreurs
        $errorList = [];

        // formulaire soumis
        if (!empty($_POST)) {
            // dump($_POST);
            // exit;

            // Je récupère les données
            $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
            $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
            $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
            $theme = isset($_POST['theme']) ? $_POST['theme'] : '';
            $mail = isset($_POST['mail']) ? $_POST['mail'] : '';

            // Je traite les données si besoin
            $firstname = trim($firstname);
            $birthday = trim($birthday);
            $mail = trim($mail);

            // Je valide les données => je cherche les erreur
            if (empty($firstname) || empty($birthday) || empty($sex) || empty($theme) || empty($mail)) {
                $errorList[] = 'Tous les champs sont obligatoires.';
            }

            if (filter_var($mail, FILTER_VALIDATE_EMAIL) === false) {
                $errorList[] = 'Adresse mail invalide';
            }

            // Si tout est ok (aucune erreur)
            if ((empty($errorList)) && (isset($_POST['id']))) {
                // On insert en DB
                // dump('ok');

                $currentUserModel = UserModel::find($_POST['id']);
                $currentUserModel->setFirstname($firstname);
                $currentUserModel->setBirthday($birthday);
                $currentUserModel->setSex($sex);
                $currentUserModel->setTheme($theme);
                $currentUserModel->setMail($mail);
                dump($currentUserModel);
                $currentUserModel->updateInfos();
                User::connect($currentUserModel);

                // On envoie un JSON avec l'url du home pour la redirection
                $this->sendJson([
                     'code' => 1,
                        'redirect' => $this->router->generate('user_profile'),
                        'errorList' => $errorList,
                        'type' => 'saveProfile',
                ]);
            }

            // Envoi du JSON avec la liste des erreurs
            $this->sendJson([
            'code' => 2,
            'errorList' => $errorList,
            'type' => 'saveProfile',
            ]);
        }
    }
}
