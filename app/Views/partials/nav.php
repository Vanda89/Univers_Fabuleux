<div class="full-header container-fluid d-flex flex-column justify-content-around col-12 my-5">
  <h1 class="home-title d-flex justify-content-center mb-5">
    <a href="" class="title-link d-flex flex-column justify-content-center align-items-lg-center align-items-md-between">
      <img src="<?= $basePath; ?>/images/title/title-mobile.png" class="title-mobile col-12" alt="">
      <img src="<?= $basePath; ?>/images/title/title.png" class="full-title" alt="">
    </a>
  </h1>

  <nav class="row navbar navbar-expand-md navbar-light d-flex justify-content-center">
    <button class="btn-hamburger-menu navbar-toggler mb-5" type="button" data-toggle="collapse" data-target="#navbarToggler"
      aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <img src="<?= $basePath; ?>/images/icons/hamburger-menu.png" alt="" id="hamburger-menu">
    </button>

    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav  d-flex flex-row flex-wrap flex-md-nowrap justify-content-center justify-content-md-around col-md-12"
        id="menu">
        <li class="nav-item active d-flex flex-column align-items-center col-4 col-md p-0">
          <a href="<?= $router->generate('main_home'); ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn ">
            <img src="<?= $basePath; ?>/images/icons/home.png" alt="" class="nav-icon">
            <h2 class="nav-title home">accueil</h2>
          </a>
        </li>

        <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
          <a href="<?= $router->generate('game_game').'?id=1'; ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/paint-palette.png" alt="" class="nav-icon">
            <h2 class="nav-title paint">dessin</h2>
          </a>
        </li>

        <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
          <a href="<?= $router->generate('game_game').'?id=2'; ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/cards.png" alt="" class="nav-icon">
            <h2 class="nav-title memory">memory</h2>
          </a>
        </li>

        <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
          <a href="<?= $router->generate('game_game').'?id=3'; ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/abc.png" alt="" class="nav-icon">
            <h2 class="nav-title letters">tape-lettre</h2>
          </a>
        </li>

        <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
          <a href="<?= $router->generate('game_game').'?id=4'; ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/mystery-image.png" alt="" class="nav-icon">
            <h2 class="nav-title mystery">image mystère</h2>
          </a>
        </li>

        <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
          <a href="<?= $router->generate('game_game').'?id=5'; ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/bubbles.png" alt="" class="nav-icon">
            <h2 class="nav-title bubbles">éclate-bulle</h2>
          </a>
        </li>

        <?php if ($connectedUser === false) : ?>
        <li class="nav-item d-flex flex-column align-items-center col-6 col-md p-0">
          <a href="<?= $router->generate('user_login'); ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/connection.png" alt="" class="nav-icon">
            <h2 class="nav-title connection">connexion</h2>
          </a>
        </li>
        <li class="nav-item d-flex flex-column align-items-center col-6 col-md p-0">
          <a href="<?= $router->generate('user_signup'); ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/registration.png" alt="" class="nav-icon">
            <h2 class="nav-title inscription">inscription</h2>
          </a>
        </li>
        <?php else : ?>
        <li class="nav-item d-flex flex-column align-items-center col-6 col-md p-0">
          <a href="<?= $router->generate('user_profile'); ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/profile.png" alt="" class="nav-icon">
            <h2 class="nav-title profile">profil</h2>
          </a>
        </li>
        <li class="nav-item d-flex flex-column align-items-center col-6 col-md p-0">
          <a href="<?= $router->generate('user_logout'); ?>" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
            <img src="<?= $basePath; ?>/images/icons/exit.png" alt="" class="nav-icon">
            <h2 class="nav-title disconnection">déconnexion</h2>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</div>