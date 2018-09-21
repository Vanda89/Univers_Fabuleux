<div class="full-header container-fluid d-flex flex-column justify-content-around col-12 my-5">
  <h1 id="main-title" class="d-flex justify-content-center mb-5">
    <a href="" class="title-link d-flex flex-column justify-content-center align-items-lg-center align-items-md-between">
      <img src="<?= $basePath; ?>/images/title/title-mobile.png" id="title-mobile" class="col-12" alt="nom du site affiché sur petite résolution">
      <img src="<?= $basePath; ?>/images/title/title.png" id="full-title" alt="nom du site affiché sur grande résolution">
    </a>
  </h1>

  <nav class="row navbar navbar-expand-md navbar-light d-flex justify-content-center">
    <button class="btn-hamburger-menu navbar-toggler mb-5" type="button" data-toggle="collapse" data-target="#navbarToggler"
      aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <img src="<?= $basePath; ?>/images/icons/hamburger-menu.png" alt="icône pour menu rétractable" id="hamburger-menu">
    </button>

    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav  d-flex flex-row flex-wrap flex-md-nowrap justify-content-around justify-content-md-around col-md-12"
        id="menu">
        <li class="nav-item active d-flex flex-column align-items-center col-4 col-md p-0">
          <a href="<?= $router->generate('main_home'); ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn ">
            <img src="<?= $basePath; ?>/images/icons/home.png" alt="icône en forme de maison pour l'accueil" class="nav-icon">
            <h2 id="home-icon" class="nav-title">accueil</h2>
          </a>
        </li>

        <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
          <a href="<?= $router->generate('game_game').'?id=1'; ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/cards.png" alt="icone de maison pour l'accueil" class="nav-icon">
            <h2 id="memory-icon" class="nav-title">memory</h2>
          </a>
        </li>

        <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
          <a href="<?= $router->generate('game_game').'?id=2'; ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/abc.png" alt="icône de carte à jouer pour le jeu memory" class="nav-icon">
            <h2 id="letters-icon" class="nav-title">tape-lettre</h2>
          </a>
        </li>

        <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
          <a href="<?= $router->generate('game_game').'?id=3'; ?>" class="disabled nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/mystery-image.png" alt="icône d'image avec bloc dessus pour le jeu image-mystère" class="nav-icon">
            <h2 id="mystery-icon" class="nav-title">image mystère</h2>
          </a>
        </li>

        <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
          <a href="<?= $router->generate('game_game').'?id=4'; ?>" class="disabled nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/bubbles.png" alt="icône de bulles pour le jeu éclate-bulle" class="nav-icon">
            <h2 id="bubbles-icon" class="nav-title">éclate-bulle</h2>
          </a>
        </li>

        <?php if ($connectedUser === false) : ?>
        <li class="nav-item d-flex flex-column align-items-center col-6 col-md mr-0 p-0">
          <a href="<?= $router->generate('user_login'); ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/connection.png" alt="icône de tête de garçon et fille pour le formulaire de connexion" class="nav-icon">
            <h2 id="connection-icon" class="nav-title">connexion</h2>
          </a>
        </li>
        <li class="nav-item d-flex flex-column align-items-center col-6 col-md mr-0   p-0">
          <a href="<?= $router->generate('user_signup'); ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/registration.png" alt="icône de garçon avec crayon pour le formulaire d'inscription" class="nav-icon">
            <h2 id="inscription-icon" class="nav-title">inscription</h2>
          </a>
        </li>
        <?php else : ?>
        <li class="nav-item d-flex flex-column align-items-center col-6 col-md mr-0  p-0">
          <a href="<?= $router->generate('user_profile'); ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/profile.png" alt="icône d'engrenages pour la page de profil" class="nav-icon">
            <h2 id="profile-icon" class="nav-title">profil</h2>
          </a>
        </li>
        <li class="nav-item d-flex flex-column align-items-center col-6 col-md mr-0 p-0">
          <a href="<?= $router->generate('user_logout'); ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/exit.png" alt="icône de porte avec bonhomme pour la déconnexion" class="nav-icon">
            <h2 id="disconnection-icon"class="nav-title">déconnexion</h2>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</div>