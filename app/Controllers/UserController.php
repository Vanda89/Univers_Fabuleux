<?php

namespace univers_fabuleux\Controllers;

use univers_fabuleux\Models\UserModel;
use univers_fabuleux\Models\ThemeModel;
use univers_fabuleux\Models\AvatarModel;
use univers_fabuleux\Models\StatsModel;
use univers_fabuleux\Utils\User;

class UserController extends CoreController
{
    /**
     * signup : méthode gérant l'affichage du formulaire d'inscription avec affichage des avatars.
     */
    public function signup()
    {
        $avatars = AvatarModel::findAll();
        $avatarList = [];

        foreach ($avatars as $key => $avatar) {
            $item = [
		'picture' => '<img src="/images/companion/'.$avatar->getAvatar_picture().'">',
                'id' => $key + 1,
            ];
            array_push($avatarList, $item);
        }

        $dataToViews = [
            'avatarList' => $avatarList,
        ];

        $this->show('user/registration', $dataToViews);
    }

    /**
     * signupSubmit : méthode traitant les données envoyées depuis le formulaire d'inscription et, après recherche d'éventuelles erreurs, permettant de les envoyer en bdd, sinon affichage de celles-ci pour l'utilisateur.
     */
    public function signupSubmit()
    {
        $errorList = [];

        if (!empty($_POST)) {
            $avatar = isset($_POST['avatar']) ? $_POST['avatar'] : '';
            $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
            $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
            $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $passwordConfirm = isset($_POST['passwordConfirm']) ? $_POST['passwordConfirm'] : '';

            $firstname = trim($firstname);
            $birthday = trim($birthday);
            $mail = trim($mail);
            $password = trim($password);
            $passwordConfirm = trim($passwordConfirm);

            if (empty($avatar) || empty($firstname) || empty($birthday) || empty($mail) || empty($password) || empty($passwordConfirm)) {
                $errorList[] = 'Tous les champs sont obligatoires.';
            }

            if (preg_match('#^([0-9]{2})([/-])([0-9]{2})\2([0-9]{4})$#', $birthday, $m) == 1 && checkdate($m[3], $m[1], $m[4])) {
                $errorList[] = 'Date non valide';
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
                $errorList[] = 'Les 2 mots de passe doivent être identiques';
            }

            if (empty($errorList)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $newUserModel = new UserModel();
                $newUserModel->setFirstname($firstname);
                $newUserModel->setBirthday($birthday);
                $newUserModel->setMail($mail);
                $newUserModel->setPassword($hashedPassword);
                $newUserModel->setIs_admin(2);
                $newUserModel->setTheme_id(1);
                $newUserModel->setAvatar_id($avatar);
                $newUserModel->add();

                User::connect($newUserModel);

                // JSON avec l'url du home pour la redirection
                $this->sendJson([
                     'code' => 1,
                        'redirect' => $this->router->generate('main_home'),
                        'errorList' => $errorList,
                        'type' => 'signup',
                ]);
            }

            // JSON avec la liste des erreurs
            $this->sendJson([
            'code' => 2,
            'errorList' => $errorList,
            'type' => 'signup',
            ]);
        }
    }

    /**
     * login.
     */
    public function login()
    {
        $this->show('user/connection');
    }

    /**
     * loginSubmit : méthode traitant les données envoyées depuis le formulaire de connexion et permettant, après recherche d'éventuelles erreurs, de se connecter, sinon affichage de celles-ci pour l'utilisateur.
     */
    public function loginSubmit()
    {
        $errorList = [];

        if (!empty($_POST)) {
            $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $mail = trim($mail);
            $password = trim($password);

            if (filter_var($mail, FILTER_VALIDATE_EMAIL) === false || strlen($password) < 8) {
                $errorList[] = 'Identifiant ou mot de passe incorrect.';
            }

            if (empty($mail) || empty($password)) {
                $errorList[] = 'Tous les champs sont obligatoires.';
            }

            // S'il n'y a pas d'erreur avant, on compare les données avec la bdd
            if (empty($errorList)) {
                $userModel = UserModel::findByMail($mail);

                if ($userModel !== false) {
                    if (password_verify($password, $userModel->getPassword())) {
                        User::connect($userModel);

                        // JSON avec l'url du home pour la redirection
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

            // JSON avec la liste des erreurs
            $this->sendJson([
            'code' => 2,
            'errorList' => $errorList,
            'type' => 'login',
            ]);
        }
    }

    /**
     * logout : déconnexion et redirection sur la page d'accueil.
     */
    public function logout()
    {
        User::disconnect();

        $this->redirectToRoute('main_home');
    }

    /**
     * profile : méthode affichant la page de profil de l'utilisateur avec ses préférences (thème, avatar) et ses informations personnelles.
     */
    public function profile()
    {
        $user = User::isConnected() ? User::getConnectedUser() : false;
        $isAdmin = User::isAdmin();

        //Si aucun utilisateur n'est pas connecté, protège la page profil avec une 403
        if (!$user) {
            $this->show('main/403');
        }

$themeId = $user->getTheme_Id();
$userTheme = ($themeId !== null) ? ThemeModel::find($themeId) : null;
        $themes = ThemeModel::findAllName();
        $themeList = [];
        foreach ($themes as $key => $theme) {
            $item = [
                'name' => $theme,
                // Rajoute un attribut HTML pour l'autosélection
                'isSelect' => (intval($user->getTheme_Id()) === $key + 1) ? 'selected' : '',
                'id' => $key + 1,
            ];
            array_push($themeList, $item);
        }

        $userAvatar = AvatarModel::find($user->getAvatar_id());
        $avatars = AvatarModel::findAll();
        $avatarList = [];
        foreach ($avatars as $key => $avatar) {
            $item = [
                // Insertion des images avec l'encodage en MIME
                'picture' => '<img src="/images/companion/'.$avatar->getAvatar_picture().'">',
                // Rajoute un attribut HTML pour l'autosélection
                'isChecked' => (intval($user->getAvatar_id()) === $key + 1) ? 'checked' : '',
                'id' => $key + 1,
            ];
            array_push($avatarList, $item);
        }

        // Remplissage des statistiques
        $newScoreMemory = StatsModel::findNewScore('Memory', $user->getId());
        if ($newScoreMemory === false) {
            $gameList['memory']['newScore']['score'] = 0;
            $gameList['memory']['newScore']['time'] = '00:00:00';
        } else {
            $gameList['memory']['newScore']['score'] = $newScoreMemory->getScore();
            $gameList['memory']['newScore']['time'] = $newScoreMemory->getGame_time();
        }

        $bestScoreMemory = StatsModel::findBestScore('Memory', $user->getId());
        if ($bestScoreMemory === false) {
            $gameList['memory']['bestScore']['score'] = 0;
            $gameList['memory']['bestScore']['time'] = '00:00:00';
        } else {
            $gameList['memory']['bestScore']['score'] = $bestScoreMemory->getScore();
            $gameList['memory']['bestScore']['time'] = $bestScoreMemory->getGame_time();
        }

        $newScoreTypeletter = StatsModel::findNewScore('Tape-lettre', $user->getId());
        if ($newScoreTypeletter === false) {
            $gameList['tape-lettre']['newScore']['score'] = 0;
            $gameList['tape-lettre']['newScore']['time'] = '00:00:00';
        } else {
            $gameList['tape-lettre']['newScore']['score'] = $newScoreTypeletter->getScore();
            $gameList['tape-lettre']['newScore']['time'] = $newScoreTypeletter->getGame_time();
        }

        $bestScoreTypeletter = StatsModel::findBestScore('Tape-lettre', $user->getId());
        if ($bestScoreTypeletter === false) {
            $gameList['tape-lettre']['bestScore']['score'] = 0;
            $gameList['tape-lettre']['bestScore']['time'] = '00:00:00';
        } else {
            $gameList['tape-lettre']['bestScore']['score'] = $bestScoreTypeletter->getScore();
            $gameList['tape-lettre']['bestScore']['time'] = $bestScoreTypeletter->getGame_time();
        }

        $dataToViews = [
            'themeList' => $themeList,
            'avatarList' => $avatarList,
            'gameList' => $gameList,
        ];

        // Affiche la page de profil correspondant au rôle de l'utilisateur
        if ($isAdmin === true) {
            $this->show('user/profileAdmin', $dataToViews);
        } elseif ($user != null) {
            $this->show('user/profile', $dataToViews);
        }
    }

    /**
     * saveProfile : méthode retraitant les données de la page de profil afin de modifier en bdd ce qui est différent.
     */
    public function saveProfile()
    {
        $errorList = [];

        if (!empty($_POST)) {
            $avatar = isset($_POST['avatar']) ? trim($_POST['avatar']) : '';
            $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
            $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
            $theme_id = isset($_POST['theme']) ? $_POST['theme'] : '';
            $mail = isset($_POST['mail']) ? trim($_POST['mail']) : '';

            if (empty($avatar) || empty($firstname) || empty($birthday) || empty($theme_id) || empty($mail)) {
                $errorList[] = 'Tous les champs sont obligatoires.';
            }

            if (filter_var($mail, FILTER_VALIDATE_EMAIL) === false) {
                $errorList[] = 'Adresse mail invalide';
            }

            // Si tout est ok (aucune erreur)
            if ((empty($errorList)) && (isset($_POST['id']))) {
                $currentUserModel = UserModel::find($_POST['id']);
                $currentUserModel->setFirstname($firstname);
                $currentUserModel->setBirthday($birthday);
                $currentUserModel->setMail($mail);
                $currentUserModel->setTheme_id($theme_id);
                $currentUserModel->setAvatar_id($avatar);
                $currentUserModel->updateInfos();
                User::connect($currentUserModel);

                // JSON avec l'url du home pour la redirection
                $this->sendJson([
                     'code' => 1,
                        'redirect' => $this->router->generate('user_profile'),
                        'errorList' => $errorList,
                        'type' => 'saveProfile',
                ]);
            }

            // JSON avec la liste des erreurs
            $this->sendJson([
            'code' => 2,
            'errorList' => $errorList,
            'type' => 'saveProfile',
            ]);
        }
    }

    /**
     * changePassword : méthode gérant uniquement le formulaire de modification de mot de passe tout en faisant les vérifications nécessaires et encodant le mot de passe.
     */
    public function changePassword()
    {
        $errorList = [];

        $user = User::isConnected() ? User::getConnectedUser() : false;

        $hash = $user->getPassword();

        if (!empty($_POST)) {
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : '';
            $passwordConfirm = isset($_POST['passwordConfirm']) ? $_POST['passwordConfirm'] : '';

            $password = trim($password);
            $newPassword = trim($newPassword);
            $passwordConfirm = trim($passwordConfirm);

            if (empty($password) || empty($newPassword) || empty($passwordConfirm)) {
                $errorList[] = 'Tous les champs sont obligatoires.';
            }

            if (password_verify($password, $hash) === false) {
                $errorList[] = 'Mot de passe actuel erroné';
            }

            if (strlen($newPassword) < 8) {
                $errorList[] = 'Le mot de passe doit faire au moins 8 caractères';
            }

            if ($newPassword != $passwordConfirm) {
                $errorList[] = 'Les 2 mots de passe doivent être identiques';
            }

            if ((empty($errorList)) && (isset($_POST['id']))) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $currentUserModel = UserModel::find($_POST['id']);
                $currentUserModel->setPassword($hashedPassword);
                $currentUserModel->updateInfos();
                User::connect($currentUserModel);

                // JSON avec l'url du home pour la redirection
                $this->sendJson([
                     'code' => 1,
                        'redirect' => $this->router->generate('user_profile'),
                        'errorList' => $errorList,
                        'type' => 'changePassword',
                ]);
            }

            // JSON avec la liste des erreurs
            $this->sendJson([
            'code' => 2,
            'errorList' => $errorList,
            'type' => 'changePassword',
            ]);
        }
    }

    /**
     * addContent : méthode pour l'ajout de contenu sur la page de profilAdmin, même principe que les autres.
     */
    public function addContent()
    {
        $errorList = [];

        if (!empty($_FILES)) {
            $newAvatar = isset($_FILES['newAvatar']) ? $_FILES['newAvatar'] : '';

            if (empty($newAvatar)) {
                $errorList[] = 'Fichier manquant';
            }

            if ($newAvatar['type'] != 'image/jpg' && $newAvatar['type'] != 'image/jpeg') {
                $errorList[] = 'Seulement les fichiers .jpg, .jpeg et .png sont autorisés.';
            }

            if ($newAvatar['size'] > 1048576) {
                $errorList[] = 'Fichier trop volumineux';
            }

            if (empty($errorList)) {
                $currentAvatarModel = new AvatarModel();
                $currentAvatarModel->setAvatar_picture(fopen(($newAvatar['tmp_name']), 'r'));
                $currentAvatarModel->addAvatar();

                // JSON avec l'url du home pour la redirection
                $this->sendJson([
                     'code' => 1,
                        'redirect' => $this->router->generate('user_profile'),
                        'errorList' => $errorList,
                        'type' => 'addContent',
                ]);
            }

            // JSON avec la liste des erreurs
            $this->sendJson([
            'code' => 2,
            'errorList' => $errorList,
            'type' => 'addContent',
            ]);
        }
    }

    public function setStats()
    {
        if (!empty($_POST)) {
            $game = isset($_POST['game']) ? $_POST['game'] : '';
            $mode = isset($_POST['mode']) ? $_POST['mode'] : '';
            $score = isset($_POST['score']) ? $_POST['score'] : '';
            $time = isset($_POST['time']) ? $_POST['time'] : '';
        }

        $date = date('Y-m-d H:i:s');

        \dump($_POST);
        $user = User::isConnected() ? User::getConnectedUser() : false;

        if (User::isConnected() === true) {
            $currentStatsModel = new StatsModel();
            $currentStatsModel->setUser_id($user->getId());
            $currentStatsModel->setGame_name($game);
            $currentStatsModel->setPlay_date($date);
            $currentStatsModel->setGame_mode($mode);
            $currentStatsModel->setScore($score);
            $currentStatsModel->setGame_time($time);
            $currentStatsModel->add();
        }

        dump($currentStatsModel);
    }
}
