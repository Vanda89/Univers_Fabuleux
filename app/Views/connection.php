<main class="row my-5">
  <section class="connection-container container d-flex flex-column align-items-start justify-content-between col-xs-12 col-md-10 col-xl-7 my-5">
    <header class="connection-form-header row justify-content-center align-self-center my-5">
      <h2 class="connection-form-title text-center font-weight-bold">formulaire de connexion</h2>
    </header>
    <form action="" method="post" id="connectionForm" class="connection-form container d-flex flex-column justify-content-around align-items-center p-0">
      <div class="errors-container row d-none">
        <div id="errors" class="alert alert-danger errors-hide" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>

      <div class="container d-flex flex-column justify-content-around align-items-center">
        <div class="form-group form-row col-xs-10 col-md-8 mt-5 mb-4">
          <label for="mail" class="mail"></label>
          <input type="email" class="mail form-control form-control-lg" name="mail" id="mail" placeholder="Adresse mail">
        </div>

        <div class="form-group form-row col-xs-10 col-md-8 mb-2">
          <label for="pswd" class="pswd"></label>
          <input type="password" class="pswd form-control form-control-lg" name="pswd" id="pswd" placeholder="Mot de passe">
        </div>

        <div class="form-inline form-check row d-flex justify-content-between mt-2 mb-5">
          <input class="form-check-input" type="checkbox" id="rememberMe">
          <label class="form-check-label rememberMe ml-2" for="rememberMe">Se souvenir de moi</label>
        </div>
      </div>
      <button type="submit" class="connection-form-btn row btn btn-dark btn-lg mb-5" name="connection-btn">Connexion</button>
    </form>

  </section>
</main>