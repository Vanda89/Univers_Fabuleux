<div id="hidden-header" class="hide container-fluid fixed-top d-flex flex-row justify-content-between align-items-center col-12 mb-5">
  <nav class="row navbar navbar-expand navbar-light d-flex col-12 ml-0 py-0">
    <ul id="menu" class="hidden-navbar-nav d-flex flex-row flex-nowrap justify-content-around col-12 mb-0">
      <li class="hidden-nav-item d-flex flex-column align-items-center p-0">
        <a href="<?= $router->generate('main_home'); ?>" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn ">
          <img src="<?= $basePath; ?>/images/icons/home.png" alt="" class="hidden-nav-icon">
          <h2 class="hidden-nav-title home">accueil</h2>
        </a>
      </li>

      <li class="hidden-nav-item d-flex flex-column align-items-center p-0">
        <a href="<?= $router->generate('game_game').'?id=1'; ?>" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
          <img src="<?= $basePath; ?>/images/icons/paint-palette.png" alt="" class="hidden-nav-icon">
          <h2 class="hidden-nav-title paint">dessin</h2>
        </a>
      </li>

      <li class="hidden-nav-item d-flex flex-column align-items-center  p-0">
        <a href="<?= $router->generate('game_game').'?id=2'; ?>" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
          <img src="<?= $basePath; ?>/images/icons/cards.png" alt="" class="hidden-nav-icon">
          <h2 class="hidden-nav-title memory">memory</h2>
        </a>
      </li>

      <li class="hidden-nav-item d-flex flex-column align-items-center  p-0">
        <a href="<?= $router->generate('game_game').'?id=3'; ?>" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
          <img src="<?= $basePath; ?>/images/icons/abc.png" alt="" class="hidden-nav-icon">
          <h2 class="hidden-nav-title letters">tape-lettre</h2>
        </a>
      </li>

      <li class="hidden-nav-item d-flex flex-column align-items-center  p-0">
        <a href="<?= $router->generate('game_game').'?id=4'; ?>" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
          <img src="<?= $basePath; ?>/images/icons/mystery-image.png" alt="" class="hidden-nav-icon">
          <h2 class="hidden-nav-title mystery">image mystère</h2>
        </a>
      </li>

      <li class="hidden-nav-item d-flex flex-column align-items-center  p-0">
        <a href="<?= $router->generate('game_game').'?id=5'; ?>" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
          <img src="<?= $basePath; ?>/images/icons/bubbles.png" alt="" class="hidden-nav-icon">
          <h2 class="hidden-nav-title bubbles">éclate-bulle</h2>
        </a>
      </li>
       <?php if ($connectedUser === false) : ?>
      <li class="hidden-nav-item d-flex flex-column align-items-center p-0">
        <a href="<?= $router->generate('user_login'); ?>" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
          <img src="<?= $basePath; ?>/images/icons/connection.png" alt="" class="hidden-nav-icon">
          <h2 class="hidden-nav-title connection">connexion</h2>
        </a>
      </li>
      <li class="hidden-nav-item d-flex flex-column align-items-center p-0">
        <a href="<?= $router->generate('user_signup'); ?>" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
          <img src="<?= $basePath; ?>/images/icons/registration.png" alt="" class="hidden-nav-icon">
          <h2 class="hidden-nav-title inscription">inscription</h2>
        </a>
      </li>
      <?php else : ?>
      <li class="hidden-nav-item d-flex flex-column align-items-center p-0">
        <a href="<?= $router->generate('user_profile'); ?>" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
          <img src="<?= $basePath; ?>/images/icons/profile.png" alt="" class="hidden-nav-icon">
          <h2 class="hidden-nav-title profile">profil</h2>
        </a>
      </li>
      <li class="hidden-nav-item d-flex flex-column align-items-center p-0">
        <a href="<?= $router->generate('user_logout'); ?>" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
          <img src="<?= $basePath; ?>/images/icons/exit.png" alt="" class="hidden-nav-icon">
          <h2 class="hidden-nav-title disconnection">déconnexion</h2>
        </a>
      </li>
      <?php endif; ?>
    </ul>
  </nav>
</div>