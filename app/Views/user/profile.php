<?php $this->layout('layout', ['title' => 'Espace personnel']); ?>

<main class="row mt-2 mb-5">
  <section class="container d-flex flex-column align-items-center justify-content-between col-xs-12 col-md-10 col-xl-7 my-5 ">
    <header class="section-header row d-flex justify-content-center align-self-center mt-5 mb-3">
      <h2 id="profile-title" class="section-title text-center text-capitalize font-weight-bold">espace personnel</h2>
    </header>

    <div id="errors" class="alert errors-hide row text-center px-2" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="errorsContent d-flex align-items-center justify-content-center text-center pt-2 pl-1"></div>
    </div>

    <form action="" method="post" id="saveProfile" class="form row d-flex flex-column align-items-center justify-content-around mb-5">
      <input type="hidden" name="id" value="<?= $connectedUser->getId(); ?>">

      <div class="form-group container d-flex flex-column align-items-center justify-content-center mb-5">
        <h3 class="title-category row my-5">Profil</h3>

        <div class="form-row row d-flex justify-content-center col-12 p-0 ">
          <div class="form-inline d-flex flex-column justify-content-between col-xs-10 col-md-12 mb-4 pl-0">
            <p class="form-label text-capitalize font-weight-bold mb-2">Portrait :</p>
            <div class="avatar-container d-flex justify-content-around align-items-around flex-wrap">
              <?php foreach ($avatarList as $index => $avatar) : ?>
              <div class="avatar d-flex flex-column align-items-center justify-content-center">
                <label for="avatar<?= $index; ?>" class="d-flex justify-content-center mb-1">
                  <?= $avatar['picture']; ?></label>
                <input type="radio" class="form-control" name="avatar" value="<?= $avatar['id']; ?>" id="avatar<?= $index; ?>"
                  class="avatar-input" <?=$avatar['isChecked']; ?>>
              </div>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 my-4">
            <label for="firstname" class="form-label text-capitalize font-weight-bold mb-2">prénom :</label>
            <input type="text" class="form-control text-capitalize col-md-6" name="firstname" id="firstname" value="<?= $connectedUser->getFirstname(); ?>"
              required="required">
          </div>

          <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
            <label for="birthday" class="form-label font-weight-bold mb-2">Date de naissance :</label>
            <input type="date" class="form-control col-md-6" name="birthday" id="birthday" value="<?= $connectedUser->getBirthday(); ?>"
              required="required">
          </div>

          <div class="form-inline d-flex justify-content-between text-capitalize col-xs-10 col-md-12 mb-4">
            <label for="wallpaper" class="form-label font-weight-bold mb-2">thème préféré :</label>
            <select class="form-control col-md-6" name="theme" id="theme" required>
              <?php foreach ($themeList as $index => $theme) : ?>
              <option value="<?= $theme['id']; ?>" class="" <?=$theme['isSelect']; ?>>
                <?= $theme['name']; ?>
              </option>
              <?php endforeach; ?>

            </select>
          </div>
          <div class="form-row d-flex justify-content-center col-12 p-0 ">
            <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
              <label for="mail" class="form-label font-weight-bold mb-2">Adresse mail actuelle :</label>
              <input type="email" class="form-control col-md-6 " name="mail" id="mail" value="<?= $connectedUser->getMail(); ?>"
                required="required">
            </div>
          </div>
        </div>
      </div>




      <button type="submit" class="form-btn btn text-light btn-lg text-capitalize mb-4" name="profile-btn">enregistrer</button>
    </form>

    <div class="row d-flex flex-row align-items-center justify-content-center my-4">
      <!-- Button trigger modal -->
      <button type="button" id="changePasswordBtn" class="btn btn-light row" data-toggle="modal" data-target="#changePasswordModal">
        Modifier le mot de passe
      </button>

      <!-- Modal -->
      <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="changePasswordModalLabel">Modification de mot de passe</h5>
              <button type="button" class="close p-0" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="errors errors-hide alert alert-danger " role="alert">
              <button type="button" class="close " data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="errorsContent d-flex align-items-center justify-content-center text-center pl-1"></div>
            </div>

            <form action="" method="post" id="changePassword" class="form d-flex flex-column align-items-center justify-content-around">
              <input type="hidden" name="id" value="<?= $connectedUser->getId(); ?>">
              <div class="modal-body">

                <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
                  <label for="password" class="form-label font-weight-bold mb-2">Mot de passe actuel:</label>
                  <input type="password" class="form-control col-md-12" name="password" id="password">
                </div>

                <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
                  <label for="newPassword" class="form-label font-weight-bold mb-2">Nouveau mot de passe:</label>
                  <input type="password" class="form-control col-md-12" name="newPassword" id="newPassword">
                </div>

                <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
                  <label for="passwordConfirm" class="form-label font-weight-bold mb-2">Confirmer le mot de passe :</label>
                  <input type="password" class="form-control col-md-12" name="passwordConfirm" id="passwordConfirm">
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  <button type="submit" name="saveNewPassword" class="btn btn-success">Sauvegarder</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row align-self-center text-capitalize d-flex justify-content-center  mb-5">
      <h3 class="title-category  my-5">statistiques</h3>

      <div id="stats-container" class="container d-flex flex-column justify-content-center align-items-center ">
        <div class=" d-flex flex-column flex-md-row justify-content-xs-center justify-content-between align-items-center mb-5">
          <?php foreach ($gameList as $index => $game) : ?>
          <div class="row d-flex flex-row align-items-center justify-content-center col-xs-12 col-6">
            <h4 id="gameName" class="text-center pb-4"><?= $index; ?></h4>
            <div id="stats" class="d-flex flex-row justify-content-between align-items-center text-center w-100">
              <div class="d-flex flex-column">
                <h5 id="new-score" class="gameStats">Nouveau score </h5>
                <p class="score d-flex justify-content-center mb-0 p-2"><?= $game['newScore']['score']; ?><i class="starProfile align-self-center fas fa-star pl-2 pb-1"></i></p>
                <p class="time mb-0 p-2"><?= $game['newScore']['time']; ?></p>
              </div>
              <div class="d-flex flex-column ">
                <h5 id="best-score" class="gameStats">Meilleur score </h5>
                <p class="score d-flex justify-content-center mb-0 p-2"><?= $game['bestScore']['score']; ?><i class="starProfile align-self-center fas fa-star pl-2 pb-1"></i></p>
                <p class="time mb-0 p-2"><?= $game['bestScore']['time']; ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php $this->push('js'); ?>
<script src="<?= $basePath; ?>/js/app.js"></script>
<?php $this->end(); ?>