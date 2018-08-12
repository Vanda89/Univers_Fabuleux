<?php $this->layout('layout', ['title' => 'Inscription']); ?>

<main class="row mt-2 mb-5">
  <section class="registration-container container d-flex flex-column align-items-center justify-content-between col-xs-12 col-md-10 col-lg-9 col-xl-7 my-5">
    <header class="form-header row justify-content-center align-self-center text-capitalize mt-5 mb-3">
      <h2 class="form-title text-center font-weight-bold">formulaire d' inscription</h2>
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

    <form action="" method="post" id="formSignup" class="registration-form row d-flex flex-column justify-content-center align-items-center p-0">
      <div class="container d-flex flex-column justify-content-around align-items-center p-0">
        <div class="row d-flex justify-content-around align-items-center col-md-7 p-0">
          <div class="form-group text-capitalize col-12 mt-3 mb-5 ">
            <label for="firstname" class="form-label font-weight-bold">prénom :</label>
            <input type="text" class="name form-control form-control-lg" name="firstname" id="firstname" required="required">
          </div>

          <div class="form-group col-12 mb-5">
            <label for="birthday" class="form-label font-weight-bold">Date de naissance :</label>
            <input type="date" class="age form-control form-control-lg" name="birthday" id="birthday" required="required">
          </div>

          <div class="form-group text-capitalize col-12 mb-5">
            <label for="sex" class="form-label font-weight-bold mb-2">sexe :</label>
            <select class="form-control " name="sex" id="sex" required>
              <option value="Fille" class="">Fille</option>
              <option value="Garçon" class="">Garçon</option>
              <option value="Autre" class="">Autre</option>
            </select>
          </div>

          <div class="form-group col-12 mb-5">
            <label for="mail" class="form-label font-weight-bold">Adresse mail :</label>
            <input type="email" class="mail form-control form-control-lg" name="mail" id="mail" required="required">
          </div>

          <div class="form-group col-12 mb-5">
            <label for="password" class="form-label font-weight-bold">Mot de passe :</label>
            <input type="password" class="password form-control form-control-lg" name="password" id="password" required="required">
          </div>

          <div class="form-group col-12 mb-5">
            <label for="passwordConfirm" class="form-label font-weight-bold">Confirmer le mot de passe :</label>
            <input type="password" class="confirm-pswd form-control form-control-lg" name="passwordConfirm" id="passwordConfirm" required="required">
          </div>
        </div>
      </div>
      <button type="submit" class="form-btn btn btn-dark btn-lg text-capitalize  mt-2 mb-5" name="registration-validation-btn">valider</button>
    </form>
  </section>
</main>

<?php $this->push('js'); ?>
<script src="<?= $basePath; ?>/js/app.js"></script>
<?php $this->end(); ?>