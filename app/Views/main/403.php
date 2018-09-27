<?php $this->layout('layout', ['title' => 'Erreur 403']); ?>

<main class="row mt-2 mb-5">
  <section class="container d-flex flex-column align-items-center justify-content-between col-xs-12 col-md-10 col-xl-7 my-5 ">
    <header class="section-header row d-flex justify-content-center align-self-center mt-5 mb-3">
      <h2 id="error-title" class="section-title text-center text-capitalize font-weight-bold">erreur 403</h2>
    </header>

    <div id="403" class="row d-flex flex-column justify-content-between align-items-center text-center mt-5 mb-5 py-5">
     <h3 class="mb-4">Vous vous êtes trompés de chemin...</h3>
     <img src="../public/images/vector_errors/403.png" alt="vecteur d'une île déserte avec un soleil">
     <div class="d-flex flex-column justify-content-around mt-4">
        <h3 class="mb-4">...faites demi-tour en cliquant ici</h3>
        <a href="<?= $router->generate('main_home'); ?>" class="home-error btn btn-dark animated pulse infinite m-auto">Accueil</a>
      </div>
    </div>
  </section>
</main>