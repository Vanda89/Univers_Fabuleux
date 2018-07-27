<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Jeu pour enfant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Fichier Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
  <!-- Fichiers CSS -->
  <link rel="stylesheet" href="../../public/css/style.css" type="text/css">
  <!-- Favicon -->
  <!-- <link rel="icon" href="/images/favicon.png" type="image/x-icon"> -->
  <!-- Fichier Fontawesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
</head>

<body>
  <div class="main-wrapper container flex-column justify-content-between col-12">
    <header class="row d-flex justify-content-center align-items-center my-5">
      <div class="full-header container-fluid d-flex flex-column justify-content-around col-12 my-5">
        <h1 class="home-title d-flex justify-content-center mb-5">
          <a href="" class="title-link d-flex flex-column justify-content-center align-items-lg-center align-items-md-between">
            <img src="../../public/images/title-mobile.png" class="title-mobile col-12" alt="">
            <img src="../../public/images/title.png" class="full-title" alt="">
          </a>
        </h1>

        <nav class="row navbar navbar-expand-md navbar-light d-flex justify-content-center">
          <button class="btn-hamburger-menu navbar-toggler mb-5" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <img src="../../public/images/icons/hamburger-menu.png" alt="" id="hamburger-menu">
          </button>

          <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav  d-flex flex-row flex-wrap flex-md-nowrap justify-content-center justify-content-md-around col-md-12"
              id="menu">
              <li class="nav-item active d-flex flex-column align-items-center col-4 col-md p-0">
                <a href="" class="nav-link text-uppercase d-flex flex-column align-items-center btn ">
                  <img src="../../public/images/icons/home.png" alt="" class="nav-icon">
                  <h2 class="nav-title home">accueil</h2>
                </a>
              </li>

              <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
                <a href="" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
                  <img src="../../public/images/icons/paint-palette.png" alt="" class="nav-icon">
                  <h2 class="nav-title paint">dessin</h2>
                </a>
              </li>

              <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
                <a href="" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
                  <img src="../../public/images/icons/cards.png" alt="" class="nav-icon">
                  <h2 class="nav-title memory">memory</h2>
                </a>
              </li>

              <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
                <a href="" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
                  <img src="../../public/images/icons/abc.png" alt="" class="nav-icon">
                  <h2 class="nav-title letters">tape-lettre</h2>
                </a>
              </li>

              <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
                <a href="" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
                  <img src="../../public/images/icons/mystery-image.png." alt="" class="nav-icon">
                  <h2 class="nav-title mystery">image mystère</h2>
                </a>
              </li>

              <li class="nav-item d-flex flex-column align-items-center col-4 col-md p-0">
                <a href="" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
                  <img src="../../public/images/icons/bubbles.png" alt="" class="nav-icon">
                  <h2 class="nav-title bubbles">éclate-bulle</h2>
                </a>
              </li>

              <li class="nav-item d-flex flex-column align-items-center col-6 col-md p-0">
                <a href="" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
                  <img src="../../public/images/icons/connection.png" alt="" class="nav-icon">
                  <h2 class="nav-title connection">connexion</h2>
                </a>
              </li>

              <li class="nav-item d-flex flex-column align-items-center col-6 col-md p-0">
                <a href="" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
                  <img src="../../public/images/icons/registration.png" alt="" class="nav-icon">
                  <h2 class="nav-title inscription">inscription</h2>
                </a>
              </li>

              <li class="nav-item d-flex flex-column align-items-center col-6 col-md p-0">
                <a href="" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
                  <img src="../../public/images/icons/profile.png" alt="" class="nav-icon">
                  <h2 class="nav-title profile">profil</h2>
                </a>
              </li>

              <li class="nav-item d-flex flex-column align-items-center col-6 col-md p-0">
                <a href="" class="nav-link text-uppercase d-flex flex-column align-items-center btn">
                  <img src="../../public/images/icons/exit.png" alt="" class="nav-icon">
                  <h2 class="nav-title disconnection">déconnexion</h2>
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <div class="hidden-tag"></div>
      </div>

      <div id="hidden-header" class="hide container-fluid fixed-top d-flex flex-row justify-content-between align-items-center col-12 mb-5">
        <nav class="row navbar navbar-expand navbar-light d-flex col-12 ml-0 py-0">
          <ul id="menu" class="hidden-navbar-nav d-flex flex-row flex-nowrap justify-content-around col-12 mb-0">
            <li class="hidden-nav-item d-flex flex-column align-items-center p-0">
              <a href="" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn ">
                <img src="../../public/images/icons/home.png" alt="" class="hidden-nav-icon">
                <h2 class="hidden-nav-title home">accueil</h2>
              </a>
            </li>

            <li class="hidden-nav-item d-flex flex-column align-items-center p-0">
              <a href="" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
                <img src="../../public/images/icons/paint-palette.png" alt="" class="hidden-nav-icon">
                <h2 class="hidden-nav-title paint">dessin</h2>
              </a>
            </li>

            <li class="hidden-nav-item d-flex flex-column align-items-center  p-0">
              <a href="" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
                <img src="../../public/images/icons/cards.png" alt="" class="hidden-nav-icon">
                <h2 class="hidden-nav-title memory">memory</h2>
              </a>
            </li>

            <li class="hidden-nav-item d-flex flex-column align-items-center  p-0">
              <a href="" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
                <img src="../../public/images/icons/abc.png" alt="" class="hidden-nav-icon">
                <h2 class="hidden-nav-title letters">tape-lettre</h2>
              </a>
            </li>

            <li class="hidden-nav-item d-flex flex-column align-items-center  p-0">
              <a href="" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
                <img src="../../public/images/icons/mystery-image.png." alt="" class="hidden-nav-icon">
                <h2 class="hidden-nav-title mystery">image mystère</h2>
              </a>
            </li>

            <li class="hidden-nav-item d-flex flex-column align-items-center  p-0">
              <a href="" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
                <img src="../../public/images/icons/bubbles.png" alt="" class="hidden-nav-icon">
                <h2 class="hidden-nav-title bubbles">éclate-bulle</h2>
              </a>
            </li>

            <li class="hidden-nav-item d-flex flex-column align-items-center p-0">
              <a href="" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
                <img src="../../public/images/icons/connection.png" alt="" class="hidden-nav-icon">
                <h2 class="hidden-nav-title connection">connexion</h2>
              </a>
            </li>

            <li class="hidden-nav-item d-flex flex-column align-items-center p-0">
              <a href="" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
                <img src="../../public/images/icons/registration.png" alt="" class="hidden-nav-icon">
                <h2 class="hidden-nav-title inscription">inscription</h2>
              </a>
            </li>

            <li class="hidden-nav-item d-flex flex-column align-items-center p-0">
              <a href="" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
                <img src="../../public/images/icons/profile.png" alt="" class="hidden-nav-icon">
                <h2 class="hidden-nav-title profile">profil</h2>
              </a>
            </li>

            <li class="hidden-nav-item d-flex flex-column align-items-center p-0">
              <a href="" class="hidden-nav-link text-uppercase d-flex flex-column align-items-center btn">
                <img src="../../public/images/icons/exit.png" alt="" class="hidden-nav-icon">
                <h2 class="hidden-nav-title disconnection">déconnexion</h2>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </header>

    <!-- Contenu -->

      <footer class="page-footer row d-flex flex-column py-4 mt-4">
        <div class="footer-copyright text-light text-center font-weight-bold py-3">&COPY; 2018 Copyright</div>
      </footer>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>
  <!-- TinyMCE -->
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=hmscwtpg68ho7mn32oduih8w3n468kjklku6hu56wd8t69lz"></script>
  <!-- Fichier JS -->
  <script src="../../public/js/app.js"></script>
</body>

</html>