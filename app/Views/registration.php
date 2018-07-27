<main class="row my-5">
  <section class="registration-container container d-flex flex-column align-items-center justify-content-between col-xs-12 col-md-10 col-lg-9 col-xl-7 my-5">
    <header class="registration-form-header row justify-content-center align-self-center my-5">
      <h2 class="registration-form-title text-center font-weight-bold">Formulaire d'Inscription</h2>
    </header>
    <form action="" method="post" id="registrationForm" class="registration-form row d-flex flex-column justify-content-around align-items-center p-0">
      <div class="errors-container row d-none">
        <div id="errors" class="alert alert-danger errors-hide" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>

      <div class="container d-flex flex-column justify-content-around align-items-center">
        <div class="form-group form-row col-xs-10 col-md-12 mt-3 mb-5">
          <label for="name" class="form-label font-weight-bold">Prénom :</label>
          <input type="text" class="name form-control form-control-lg" name="name" id="name" required="required">
        </div>

        <div class="form-group form-row col-xs-10 col-md-12 col-md-8 mb-5">
          <label for="age" class="form-label font-weight-bold">Date de naissance :</label>
          <input type="date" class="age form-control form-control-lg" name="age" id="age" required="required">
        </div>

        <div class="form-group d-flex flex-row justify-content-between col-10 col-md-8 mb-5">
          <div class="form-inline form-check d-flex flex-row justify-content-between">
            <input type="radio" class="sex form-check-input" name="sex" id="sexF" value="F" checked>
            <label for="sexF" class="form-label form-check-label">Fille</label>
          </div>
          <div class="form-inline form-check d-flex flex-row justify-content-between">
            <input type="radio" class="sex form-check-input" name="sex" id="sexG" value="H">
            <label for="sexG" class="form-label form-check-label">Garçon</label>
          </div>
        </div>

        <div class="form-group form-row col-xs-10 col-md-12 mb-5">
          <label for="mail" class="form-label font-weight-bold">Adresse mail :</label>
          <input type="email" class="mail form-control form-control-lg" name="mail" id="mail" required="required">
        </div>

        <div class="form-group form-row col-xs-10  col-md-12 mb-5">
          <label for="pswd" class="form-label font-weight-bold">Mot de passe :</label>
          <input type="password" class="pswd form-control form-control-lg" name="pswd" id="pswd" required="required">
        </div>

        <div class="form-group form-row col-xs-10 col-md-12 mb-5">
          <label for="confirm-pswd" class="form-label font-weight-bold">Confirmer le mot de passe :</label>
          <input type="password" class="confirm-pswd form-control form-control-lg" name="confirm-pswd" id="confirm-pswd" required="required">
        </div>
      </div>
      <button type="submit" class="registration-form-btn btn btn-dark btn-lg mt-2 mb-5" name="registration-validation-btn">Valider</button>
    </form>
  </section>
</main>