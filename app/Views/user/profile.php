<?php $this->layout('layout', ['title' => 'Espace personnel']); ?>

<main class="row mt-2 mb-5">
  <section class="container container d-flex flex-column align-items-center justify-content-between col-xs-12 col-md-10 col-xl-7 my-5 ">
    <header class="form-header row d-flex justify-content-center align-self-center mt-5 mb-3">
      <h2 class="form-title text-center text-capitalize font-weight-bold">espace personnel</h2>
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

    <form action="" method="post" id="saveProfile" class="form row d-flex justify-content-center mb-5">
      <input type="hidden" name="id" value="<?= $connectedUser->getId(); ?>">
      <div class="form-group container d-flex justify-content-center">
        <div class="row d-flex justify-content-center col-11 p-0 ">
          <h3 class="title-category my-5">Profil de l'enfant</h3>
          <div class="form-row d-flex flex-row col-12 p-0">
            <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
              <label for="firstname" class="form-label text-capitalize font-weight-bold mb-2">prénom :</label>
              <input type="text" class="form-control col-md-6" name="firstname" id="firstname" value="<?= $connectedUser->getFirstname(); ?>" required="required">
            </div>

            <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
              <label for="birthday" class="form-label font-weight-bold mb-2">Date de naissance :</label>
              <input type="date" class="form-control col-md-6" name="birthday" id="birthday" value="<?= $connectedUser->getBirthday(); ?>" required="required">
            </div>

            <div class="form-inline d-flex justify-content-between text-capitalize col-xs-10 col-md-12 mb-4">
              <label for="sex" class="form-label font-weight-bold mb-2">sexe :</label>
              <select class="form-control col-md-6" name="sex" id="sex" required>
              <?php foreach ($sexList as $sex => $selected) : ?>
                <option value="<?= $sex; ?>" class="" <?= $selected; ?>><?= $sex; ?></option>
              <?php endforeach; ?>
              </select>
            </div>

            <div class="form-inline d-flex justify-content-between text-capitalize col-xs-10 col-md-12 mb-4">
              <label for="wallpaper" class="form-label font-weight-bold mb-2">thème préféré :</label>
              <select class="form-control col-md-6" name="theme" id="theme" required>
              <?php foreach ($themeList as $theme => $selected) : ?>
                <option value="<?= $theme; ?>" class="" <?= $selected; ?>><?= $theme; ?></option>
              <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group container d-flex justify-content-center ">
        <div class="row d-flex justify-content-center col-11 p-0">
          <h3 class="title-category my-5">Informations de compte</h3>
          <div class="form-row d-flex col-12 p-0">
            <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
              <label for="mail" class="form-label font-weight-bold mb-2">Adresse mail actuelle :</label>
              <input type="email" class="form-control col-md-6 " name="mail" id="mail" value="<?= $connectedUser->getMail(); ?>" required="required">
            </div>

            <div class="d-flex justify-content-center col-xs-10 col-md-12 mb-4">
              <input id="reset-pswd" class="form-control col-md-5 pl-1" type="button" value="Réinitialiser votre mot de passe" onclick="window.location.href='mailto:me@example.com'"/>
            </div>

            <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
              <label for="connectionTime" class="form-label font-weight-bold mb-2">Temps de connexion :</label>
              <input type="text" id="connectionTime" class="form-control col-md-6" value="<?= $connectedUser->getConnection_time(); ?>" readonly>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="form-btn row btn btn-dark btn-lg text-capitalize mb-5" name="profile-btn">enregistrer</button>
    </form>

    <div class="row align-self-center text-capitalize d-flex justify-content-center mb-5">
      <h3 class="title-category  my-5">statistiques</h3>
      <div class="container d-flex flex-column justify-content-center align-items-center align-items-lg-stretch col-lg-12">
        <div class="games-row row d-flex flex-column flex-md-row justify-content-around align-items-around ">
          <div id="game-1" class="stats-game d-flex flex-column justify-content-center align-items-center mb-3 mr-2">
            <p id="score-game-1" class="">score</p>
            <p id="time-game-1" class="">time</p>
          </div>

          <div id="game-2" class="stats-game d-flex flex-column justify-content-center align-items-center mb-3 mr-2">
            <p id="score-game-2" class="">score</p>
            <p id="time-game-2" class="">time</p>
          </div>

          <div id="game-3" class="stats-game d-flex flex-column justify-content-center align-items-center mb-3">
            <p id="score-game-3" class="">score</p>
            <p id="time-game-3" class="">time</p>
          </div>
        </div>

        <div class="games-row row d-flex flex-column flex-md-row justify-content-around align-items-around">
          <div id="game-4" class="stats-game d-flex flex-column justify-content-center align-items-center mb-3 mr-2">
            <p id="score-game-4" class="">score</p>
            <p id="time-game-4" class="">time</p>
          </div>

          <div id="game-5" class="stats-game d-flex flex-column justify-content-center align-items-center mb-3 mr-2">
            <p id="score-game-5" class="">score</p>
            <p id="time-game-5" class="">time</p>
          </div>
          
          <div id="game-6" class="stats-game d-flex flex-column justify-content-center align-items-center mb-3">
            <p id="score-game-6" class="">score</p>
            <p id="time-game-6" class="">time</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>