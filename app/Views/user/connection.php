<?php $this->layout('layout', ['title' => 'Connexion']); ?>

<main class="row mt-2 mb-5">
  <section class="connection-container container d-flex flex-column align-items-center justify-content-between col-xs-12 col-md-10 col-xl-7 my-5 p-0">
    <header class="form-header row justify-content-center align-self-center text-capitalize mt-5 mb-3">
      <h2 class="form-title text-center font-weight-bold">formulaire de connexion</h2>
    </header>

    <?php if (!empty($errorList)) : ?>
    <div class="errors-container row d-none">
      <div class="row">
        <div id="errors" class="alert alert-danger errors-hide" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="errorsContent"></div>
        </div>
      </div>
      <?php foreach ($errorList as $currentError) : ?>
      <?= $currentError; ?>
        <br>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <form action="" method="post" id="formLogin" class="connection-form row d-flex justify-content-around align-items-center p-0">
      <div class="container d-flex justify-content-around align-items-center p-0">
        <div class="row d-flex justify-content-around align-items-center col-md-7 p-0">
          <div class="form-group text-capitalize col-12 mt-3 mb-5">
            <label for="mail" class="mail"></label>
            <input type="email" class="mail form-control form-control-lg" name="mail" id="mail" placeholder="Adresse mail">
          </div>

          <div class="form-group col-12 mb-3">
            <label for="password" class="password"></label>
            <input type="password" class="password form-control form-control-lg" name="password" id="password" placeholder="Mot de passe">
          </div>

          <div class="form-inline form-check row d-flex justify-content-between mb-5">
            <input class="form-check-input" type="checkbox" id="rememberMe">
            <label class="form-check-label rememberMe ml-2" for="rememberMe">Se souvenir de moi</label>
          </div>
        </div>
      </div>
      <button type="submit" class="form-btn row btn btn-dark btn-lg mb-5" name="connection-btn">Connexion</button>
    </form>

  </section>
</main>